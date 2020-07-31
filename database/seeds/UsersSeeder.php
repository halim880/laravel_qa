<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        factory(User::class, 20)->create()->each(function ($u){
            $u->questions()->saveMany(
                factory(Question::class, rand(1, 5))->make()
            )
            ->each(function ($q){
                $q->answers()->saveMany(factory(Answer::class, rand(0, 5))->make());
            });
        });
    }
}
