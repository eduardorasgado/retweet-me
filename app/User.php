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

    // see Customizing The Key Name
    // in: https://laravel.com/docs/5.6/routing
    public function getRouteKeyName()
    {
        // set to change default "id" await in Routing
        // this works for /users/{user}
        // in route in web.php
        // username instead of looking for id
        return 'username';
    }

    // to prevent not been following to user itself 
    public function isNotTheUser(User $user)
    {
        return $this->id !== $user->id;
    }

    // checkign if the user is already following
    public function isFollowing(User $user)
    {
        // returns if is or not following
        return (bool) $this->following
                            ->where('id', $user->id)
                            ->count();
    }

    // check that we can or not follow the user
    public function canFollow(User $user)
    {
        // check for user itself
        if (!$this->isNotTheUser($user))
        {
                return false;
        }
        // check if user is not been following
        return !$this->isFollowing($user);
    }

    public function canUnfollow(User $user)
    {
        return $this->isFollowing($user);
    }

    //
    public function following()
    {
        // the model and the table 
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follower_id');
    }

    // this  will return the followers from user given
    public function followers()
    {
        // the model and the table 
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'user_id');
    }
}
