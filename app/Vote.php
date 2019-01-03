<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vote extends Model
{
    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function voter(){
        return $this->belongsTo(User::class, 'voter_id');
    }

    public function isCorrect() 
    {
        return $this->post->truthful == $this->vote;
    }

    static public function votesMadedToday()
    {
        return Vote::whereDate('created_at', Carbon::today());
    }
}
