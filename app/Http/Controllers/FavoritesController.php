<?php

namespace App\Http\Controllers;
use illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Question;
class FavoritesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Question $question){
        $question->favorites()->attach(Auth::user()->id);
        return back();
    }
    public function destroy(Question $question){
        $question->favorites()->detach(Auth::user()->id);
        return back();
    }
}
