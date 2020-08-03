<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;
class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->where('votable_type', 'App\Question')->delete();
        $users = User::all();
        $nu = $users->count();
        $vote = [-1, 1];

        foreach (Question::all() as $question) {
            for ($i=0; $i < rand(1, $nu); $i++) { 
                $user = $users[$i];
                $user->voteQuestion($question, $vote[rand(0,1)]); 
            }
        }
        foreach (Answer::all() as $answer) {
            for ($i=0; $i < rand(1, $nu); $i++) { 
                $user = $users[$i];
                $user->voteAnswer($answer, $vote[rand(0,1)]); 
            }
        }
    }
}
