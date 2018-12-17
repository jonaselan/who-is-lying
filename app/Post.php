<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function author(){
        return $this->belongsTo(User::class);
    }

//    public function votedBy(){
//    }

}
