<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function voter(){
        return $this->belongsTo(User::class, 'voter_id');
    }
}
