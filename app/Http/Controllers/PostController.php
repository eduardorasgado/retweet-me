<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importing the namespace of Post model
use App\Post;

class PostController extends Controller
{
	public function index(Request $request, Post $post)
	{
		// it keeps all posts where actual user has a follow
		// relation with its following guys

		// The pluck method retrieves all of the values for a given key.
		// See: https://laravel.com/docs/5.6/collections#method-pluck

		// The push method appends an item to the end of the collection
		// See: https://laravel.com/docs/5.6/collections#method-push

		/*
		Here: We are querying the post where the user_id is
		all the users_id which belongs to the current 
		authenticated users following list.
		*We are plucking out each of the elements available in the collection, but just the id -> users.id
		Next thing is push the current authenticated user's posts
		*Last thing: including  all the user data in each element of the array created.
		
		*This includes all the following users but not the
		current user:
		user_id', $request
											->user()
											->following()
											->pluck('users.id')
		
		This is including the current authenticated user:
		push($request->user()->id)
		*/
		$allPosts = $post
									->whereIn('user_id', $request
											->user()
											->following()
											->pluck('users.id')
											->push($request->user()->id)
										)->with('user');
		// see all the posts it got
		dd($allPosts->count());
	}

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
