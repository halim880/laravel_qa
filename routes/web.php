<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('question', 'QuestionsController');
Route::resource('question.answer', 'AnswersController')->only(['store', 'edit', 'update', 'destroy']);
Route::post('answer/{answer}/accept', 'AcceptAnswerController')->name('answer.accept');

Route::post('question/favorites/{question}', 'FavoritesController@store')->name('question.favorite');
Route::delete('question/favorites/{question}', 'FavoritesController@destroy')->name('question.unfavorite');
Route::post('question/vote/{question}', 'VoteQuestionController')->name('question.vote');
Route::post('answer/vote/{answer}', 'VoteAnswerController')->name('answer.vote');
