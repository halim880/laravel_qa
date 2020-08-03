<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Answer;

class VoteAnswerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer){
        $vote = (int) request()->vote;
        Auth::user()->voteAnswer($answer, $vote);
        return back();
    }
}
