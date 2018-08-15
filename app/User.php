<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // the accesor needs to pass the element here in
    // lower case to appends, to return it too when
    // a response needs to be done with User model
    protected $appends = ['avatar'];

    public function posts()
    {
        // one user has many posts
        return $this->hasMany(Post::class);
    }

    public function getAvatar()
    {
        // a easy way to access to a user picture
        // if the user has a gravatar linked to his
        // email
        return 'https://gravatar.com/avatar/' . md5($this->email) . '/?s=45&d=mm';
    }

    // this is called a: Accessor by Eloquent
    // https://stackoverflow.com/questions/35701538/how-to-always-append-attributes-to-laravel-eloquent-model
    public function getAvatarAttribute()
    {
        return $this->getAvatar();
    }
}
