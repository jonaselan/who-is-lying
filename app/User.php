<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    TODO
//    public function votedPostsToday(){

//    public function votedPosts(){
//        return $this->hasManyThrough(Post::class, Vote::class);
//    }

    public function createdPosts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
