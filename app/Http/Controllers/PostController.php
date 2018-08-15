<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importing the namespace of Post model
use App\Post;

class PostController extends Controller
{
		// we are using Post model too
    public function create(Request $request, Post $post)
    {
    	// CREATE POST
    	// looking for user in Post model
    	// looking for posts function in User model
    	// to take the relation user-posts
    	$createdPost = $request->user()->posts()->create([
    		'body' => $request->body,
    	]);

    	// RETURN A RESPONSE
    	// loking for thw owner of the post
    	// in the function user of Post model which
    	// it finds a user with id in post saved in $createdPost
    	return response()
    					->json(
    							$post->with('user')
    											->find(
    												$createdPost
    														->id)
    						);
    }
}
