<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
    	// CREATE POST
    	// looking for user in Post model
    	// looking for posts function in User model
    	// to take the relation user-posts
    	$request->user()->posts()->create([
    		'body' => $request->body,
    	]);

    	// RETURN A RESPONSE
    	
    }
}
