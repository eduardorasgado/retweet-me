<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
		// this is called in web.php Route for profile showing
    public function index(User $user)
    {
    	// dd($user);
    	// looking for views folder then users folder and
    	// index.blade.php
    	// Compact creates an array containing variables and their values
    	return view('users.index', compact('user'));
    }
}
