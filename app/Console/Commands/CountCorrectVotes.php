<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Vote;
use DB;

class CountCorrectVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:count-correct-votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $voter_id = 0;
        $votes_maded_today = Vote::votesMadedToday();

        $votes_maded_today
            ->orderBy('voter_id')
            ->each(function($vote) use ($voter_id, $votes_maded_today) {
                // check a new voter
                if ($vote->voter_id != $voter_id){
                    $voter_id = $vote->voter_id;
                    $correctAnswer = 0;
                    $points = 1;
                }

                if ($vote->isCorrect()){
                    $correctAnswer += 1;

                    if ($correctAnswer == 3) {
                        // first tree voters gain 1 point
                        $votes_maded_today
                            ->where('voted_id', $voter_id)
                            ->orderBy('created_at')
                            ->take(3)
                            ->increment('points');

                        // and the author lose 1 point
                        $vote->post->author->decrement('points');
                    }
                    // others correct awnsers gain the double of points
                    elseif($correctAnswer > 3) {
                        $points *= 2; 
                        DB::table('users')
                            ->where('id', $voter_id)
                            ->increment('points', $points);
                    }
                }
            });
    }
}
