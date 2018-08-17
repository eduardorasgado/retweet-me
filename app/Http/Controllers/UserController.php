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

    public function follow(Request $request, User $user)
    {
    	// dump the currently authenticatated user and the
    	// user to follow
    	// dd($request->user()->username, $user->username);
    	if ($request->user()->canFollow($user)) 
    	{
    		/*
    		 For example, let's imagine a user can have many roles and a role can have many users. To attach a role to a user by inserting a record in the intermediate table that joins the models
    		 See:
    		 https://laravel.com/docs/5.6/eloquent-relationships
    		*/
    		 // following method in User model
    		$request->user()->following()->attach($user->id);
    	}
    	return redirect()->back();
    }
}
