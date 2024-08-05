<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Login extends BaseController
{
   
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('pages/login', $data);
    }

    public function login()
    {
        
    
    }
}
