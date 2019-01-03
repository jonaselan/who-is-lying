<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CountMissVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:count_miss_votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all wrongs votes made today';

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
                    $wrongAnswer = 0;
                    $points = 1;
                }

                if (!$vote->isCorrect()){
                    $wrongAnswer += 1;
                    $author = $vote->post->author; 

                    if ($wrongAnswer == 3) {
                        // first tree voters gain 1 point
                        $votes_maded_today
                            ->where('voted_id', $voter_id)
                            ->orderBy('created_at')
                            ->take(3)
                            ->descrement('points');

                        // and the author lose 1 point
                        $author->increment('points');
                    }elseif($wrongAnswer > 3) {
                        // author gain double
                        $points *= 2;    
                        $author->increment('points', $points);
                        // voter lose 1 point
                        DB::table('users')
                            ->where('id', $voter_id)
                            ->decrement('points');
                    }
                }
            });
    }
}
