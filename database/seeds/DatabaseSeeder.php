<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = \App\User::create(['name' => 'user1', 'email' => 'user1@email.com', 'password' => bcrypt('123123')]);
        $user2 = \App\User::create(['name' => 'user2', 'email' => 'user2@email.com', 'password' => bcrypt('123123')]);

        $post1 = \App\Post::create(['truthful' => true, 'description' => 'Eu sou bonito', 'author_id' => $user1->id]);
        $post2 = \App\Post::create(['truthful' => false, 'description' => 'Eu sei programar', 'author_id' => $user2->id]);

        \App\Vote::create(['voter_id' => $user2->id, 'post_id' => $post2->id, 'vote' => true]);
        \App\Vote::create(['voter_id' => $user1->id, 'post_id' => $post1->id, 'vote' => false]);
    }
}
