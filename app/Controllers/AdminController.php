<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\PdfHelper;
use App\Libraries\Hash;
use App\Models\Category;
use App\Models\CategoryNominee;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Vote;
use Dompdf\Dompdf;

class AdminController extends BaseController
{
    /**
     * CONSTRUCTOR USED FOR OBJECT CREATION 
     * AND THIS IS WHERE I DEFINED THE ACCESS RIGHT
     */
    public function __construct()
    {

        if (session()->get('role') != 'admin') {
            echo 'Access Denied';
            exit;
        }

        helper(["url", "form"]);
    }
    /**
     * LANDING PAGE FOR ALL ADMINS
     * USED FOR SYSTEM MANAGEMENT
     */
    public function home()
    {
        return view("admin/dashboard");
    }
    /**
     * FROM ALL USERS IN THE SYSTEM  BASED ON THEIR AGE THEY
     * CAN BE NOMINATED TO STAND FOR ANY POSITION IN THE ELECTION
     */
    public function usernomination($userid)
    {
        if ($this->request->getMethod() === 'post') {

            $category_id = $this->request->getPost('category_id');

            $user_id = $this->request->getPost('user_id');


            $user = new User();
            // $category = new Category();


            $founduser = $user->find($userid);


            //  $foundcategory = $category->find($founduser->id);
            //echo var_dump($founduser);
            if ($founduser && $founduser->age >= 18) {
                $user = new User();


                // Check if a nominee with the same email already exists
                // if ($user->where('email', $founduser->email)->countAllResults() > 0 && $user->where('category_id', $founduser->category_id)->true) {
                //     return redirect()->to('User')->with('error', $founduser->name . ' Nominee Already exists');
                // } 
                if ($founduser->category_id == true) {
                    return redirect()->to('User')->with('error', $founduser->name . ' Nominee Already exists');
                } else {

                    $data = [
                        'name' => $founduser->name,
                        'email' => $founduser->email,
                        'phone' => $founduser->phone,
                        'avarta' => $founduser->avarta,
                        'age' => $founduser->age,
                        'category_id' => $category_id,
                        //  'user_id' => $user_id

                    ];

                    $user->where('user_id', $userid)->update($userid, $data);
                    $found = $user->find($userid);

                    //   $user->insert($data);


                    // return View('voting', $Viewdata);
                    return redirect()->to('User')->with('success', $founduser->name . ' has been nominated successfully ');
                }
            } else {
                return redirect()->back()->with('error', $founduser->name . ' You are not eligible to stand as {category[name]}');
            }
        }
    }
    /**
     * Registering new system user
     */
    public function createUser()
    {

        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'age' => 'required|numeric',
                'phone' => 'required|numeric',
                'password' => 'required|min_length[8]',
                'passwordconfirm' => 'required|matches[password]'

            ];

            $file = $this->request->getFile('avarta');

            if ($file->isValid() && $file->getError() < 0) {
                $destinationPath = WRITEPATH . 'images';

                $file->move($destinationPath);

            }
            $fileName = $file->getName();


            if ($this->validate($rules)) {
                // Validation passed, proceed with registration
                $name = $this->request->getPost('name');
                $email = $this->request->getPost('email');
                $age = $this->request->getPost('age');
                $phone = $this->request->getPost('phone');
                $password = $this->request->getPost('password');
                $passwordconfirm = $this->request->getPost('passwordconfirm');
                $role = $this->request->getPost('role');

                $data = [
                    'name' => $name,
                    'email' => $email,
                    'age' => $age,
                    'phone' => $phone,
                    'avarta' => $fileName,
                    'password' => Hash::encrypt($password),
                    'passwordconfirm' => Hash::encrypt($passwordconfirm),
                    'role' => $role
                ];

                //DAta storage

                $user = new User();
                $query = $user->insert($data);

                if (!$query) {
                    return redirect()->to("Admin/Registration")->with('error', 'creation failed');
                } else {
                    return redirect()->to("Admin/AllUsers")->with('success', 'Registration was successful');
                }

            } else {
                // Validation failed
                return view('admin/register', ['validation' => $validation]);
                // return view("admin/register", ["validation" => [$this->validator]]);
            }
        }
        return view('admin/register');
    }
    /**
     * DISPLAYS ALL USERS IN THE SYSTEM 
     */

    public function AllUsers()
    {
        $systemusers = new User();
        $category = new Category();

        $data = [
            "users" => $systemusers->findAll(),
            "categories" => $category->findAll(),
        ];

        return view('admin/systemusers', $data);
    }
    /**
     * A LIST OF ALL NOMINEES
     */
    public function Nominees()
    {

        //$nominees = new Nominee();
        // $Nominees = new CategoryNominee();
        $category = new Category();
        $user = new User();

        $data = [
            'users' => $user->findAll(),
            'categories' => $category->findAll(),
            //  'categoriesnominees' => $Nominees->findAll(),
            "images" => "images/brighton.jpg"
        ];

        return view("admin/nominees", $data);


    }
    /**
     * OBTAINS ELECTION RESULTS FROM DB AND SENDS 
     * THEM TO VIEW. 
     * 
     */
    public function voteResults()
    {

        // Assuming you have models for votes, nominees, and categories
        $voteModel = new Vote();
        $nomineeModel = new User();
        $categoryModel = new Category();

        // Query the database to get the vote counts for each nominee
        $results = $voteModel->select('user_id, COUNT(user_id) as vote_count')
            ->groupBy('user_id')
            ->findAll();

        // Fetch category details
        $categories = $categoryModel->findAll();
        $data = [
            'results' => $results,
            'categories' => $categories,
            'nomineeModel' => $nomineeModel
        ];

        // Pass the results and category details to the view
        return view('results', $data);
    }
    public function generatepdf()
    {
        $voteModel = new Vote();
        $nomineeModel = new User();
        $categoryModel = new Category();
        $pdf = new Dompdf();

        // Query the database to get the vote counts for each nominee
        $results = $voteModel->select('user_id, COUNT(user_id) as vote_count')
            ->groupBy('user_id')
            ->findAll();

        // Fetch category details
        $categories = $categoryModel->findAll();
        $data = [
            'results' => $results,
            'categories' => $categories,
            'nomineeModel' => $nomineeModel
        ];

        // Load the HTML view
        $html = view('results', $data);

        // Load HTML content into Dompdf
        $pdf->loadHtml($html);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        // Output PDF to the browser
        $pdf->stream('output.pdf', ['Attachment' => 0]);
    }

    public function deleteuser($userid)
    {
        $user = new User();

        $founduser = $user->find($userid);



        $user->where('user_id', $userid)->delete();
        return redirect()->to('Admin/AllUsers')->with('success', 'User has been deleted successfully');

    }

    public function edituser($userid)
    {
        if ($this->request->getMethod() === 'post') {
            return $this->processUpdate();
        } else {
            return $this->displayForm($userid);
        }
    }

    private function processUpdate()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'age' => 'required|numeric',
            'phone' => 'required|numeric',
            'password' => 'required|min_length[8]',
            'passwordconfirm' => 'required|matches[password]',
        ];

        if ($this->validate($rules)) {
            $userid = $this->request->getPost('user_id');
            $data = $this->getFormData();

            $user = new User();
            $user->where('user_id', $userid)->update($userid, $data);
            $found = $user->find($userid);

            return redirect()->to('Admin/AllUsers')->with('success', "User {$found->name} has been updated");
        } else {
            return $this->displayForm($this->request->getPost('user_id'));
        }
    }

    private function displayForm($userid)
    {
        $user = new User();
        $data['user'] = $user->find($userid);
        return view('admin/edituser', $data);
    }

    private function getFormData()
    {
        return [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'age' => $this->request->getPost('age'),
            'phone' => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];
    }


}
