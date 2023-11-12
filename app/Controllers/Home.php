<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;

class Home extends BaseController
{

    public function index()
    {
        return view("login");
    }


    public function voting(): string
    {
        $nominee = new Nominee();
        $category = new Category();

        $data = [
            "nominees" => $nominee->findAll(),
            'categories' => $category->findAll()
        ];
        return view('voting', $data);
    }


    public function image($filename)
    {
        $imagedata = [$filename];
        return view('admin/systemusers', ['imagedata' => $imagedata]);
    }


}
