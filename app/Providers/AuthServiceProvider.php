<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Question::class => App\Policies\QuestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // \Gate::define('edit-question', function($user, $question){
        //     return $user->id == $question->user_id;
        // });

        // \Gate::define('delete-question', function($user, $question){
        //     return $user->id == $question->user_id;
        // });
    }
}
