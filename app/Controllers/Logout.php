<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logout extends BaseController
{
    public function index()
    {
        $userData = [
            'name',
            'email',
            'logged_in'
        ];

        session()->remove($userData);

        return redirect()->to(base_url('login'));

    }
}
