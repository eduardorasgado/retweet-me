<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
	protected $fillable = [
		'body'
	];
	public function user()
	{
		// one post belongs to a user
		return $this->belongsTo(User::class);
	}
}
