<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Vote;

class VotersController extends BaseController
{
    public function __construct()
    {

        helper(["url", "form"]);
    }

    public function login()
    {
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [

                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',

            ];
            if ($this->validate($rules)) {
                // Validation passed, proceed with login

                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');


                $data = [
                    'email' => $email,
                    'password' => Hash::encrypt($password),
                ];

                $user = new User();
                $query = $user->where('email', $email)->first();

                // $userid = $query->first()->user_id;
                $this->sessionvalues($query);


                if ($query && password_verify($password, $query->password)) {
                    // $loggedinuserid = session()->set('userid', $query->user_id);
                    if ($query->role == "admin") {
                        return redirect()->to("Admin")->with('success', 'Login was successfull');
                    } else if ($query->role == 'user') {
                        return redirect()->to("User")->with('success', 'Login was successfull');
                    }

                } else {
                    return redirect()->to('login')->with('error', 'login failed');
                    //$userid;

                }

            } else {
                return view('login', ['validation' => $validation]);
            }
        }

        return view('login');

    }

    function sessionvalues($user)
    {
        $data = [
            'user_id' => $user->user_id,
            'name' => $user->name,
            'email' => $user->email,
            'age' => $user->age,
            'isloggedin' => true,
            'phone' => $user->phone,
            'role' => $user->role,
        ];

        session()->set($data);
    }

    public function vote()
    {
        $nominee = new User();
        $category = new Category();
        $data = [
            "nominees" => $nominee->findAll(),
            'categories' => $category->findAll()
        ];
        // Check if the form was submitted
        if ($this->request->getMethod() === 'post') {
            // Get the submitted votes from the POST data
            $votes = $this->request->getPost('votes');
            $user_id = $this->request->getPost("user_id");

            // Process the selected votes
            foreach ($votes as $categoryId => $selectedNomineeId) {
                // $categoryId is the ID of the category, and $selectedNomineeId is the ID of the selected nominee

                // Ensure that the $selectedNomineeId is an array
                if (!is_array($selectedNomineeId)) {
                    // If it's not an array, convert it to an array for consistency
                    $selectedNomineeId = [$selectedNomineeId];
                }

                // Iterate through the selected nominees for this category
                foreach ($selectedNomineeId as $selectedUserId) {
                    // You can now save this vote in your database or perform any other required actions
                    // For example, using a model to insert the vote
                    $voteModel = new Vote();

                    $voteModel->insert([
                        'category_id' => $categoryId,
                        'user_id' => $selectedUserId,
                    ]);
                    $nominee->voted = true;
                }
            }






            $this->logout();
            return redirect()->to('login')->with('success', 'Vote was cast successfully');


            // After processing the votes, you can redirect to a success page or show a success message
            // For example, you can redirect to a success page or set a success flash message
            // return redirect()->to('success')->with('message', 'Votes submitted successfully');
        }
        return view('voting', $data);
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'logout successful');
    }
}


