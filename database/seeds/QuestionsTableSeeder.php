<?php

use Illuminate\Database\Seeder;
use App\Question;
class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Question::truncate();
        factory(Question::class, 10)->create();
    }
}
