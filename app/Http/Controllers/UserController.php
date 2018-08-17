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
    		 For example, let's imagine a user can have many roles and a role can have many users. To attach a role to a user by inserting a record in the intermediate table that joins the models.
    		 See:
    		 https://laravel.com/docs/5.6/eloquent-relationships
    		*/
    		 // following method in User model
    		$request->user()->following()->attach($user->id);
    	}
    	/*
			Sometimes you may wish to redirect the user to their previous location, such as when a submitted form is invalid. You may do so by using the global back helper function. Since this feature utilizes the session, make sure the route calling the back function is using the web middleware group or has all of the session middleware applied.
			See:
			https://laravel.com/docs/5.6/redirects
    	*/
    	return redirect()->back();
    }

    public function unfollow(Request $request, User $user)
    {
    	// check if can unfollow
    	if ($request->user()->canUnfollow($user))
    	{
    		// detach is the opposite to attach method
    		$request->user()->following()->detach($user->id);
    	}
    	return redirect()->back();
    }
}
