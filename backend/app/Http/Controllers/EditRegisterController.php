<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function editRegister()
    {
    }
}
