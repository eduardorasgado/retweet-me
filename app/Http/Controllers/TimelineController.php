<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TimelineController extends Controller
{
	public function index()
	{
		$following = Auth::user()->following;
		// dd($following);
		// compact to pass
		return view('home', compact('following'));
	}
}

