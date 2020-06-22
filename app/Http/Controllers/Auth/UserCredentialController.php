<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCredentialController extends Controller
{
    public function index()
    {
        return view('auth.home');
    }
    public function userGuide()
    {
        return view('credential_form.user-guide');
    }
    public function halamanHelp()
    {
        return view('credential_form.home');
    }
}
