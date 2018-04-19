<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function create()
    {
//        echo '123';
//        exit;
        return view('login.index');
    }

    public function store()
    {
        
    }

}
