<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TimelineController extends Controller
{
	public function index()
	{
		$following = Auth::user()->following;
		$followers = Auth::user()->followers;
		// dd($following);
		// dd($followers);
		// compact to pass
		return view('home', compact('following', 'followers'));
	}
}

