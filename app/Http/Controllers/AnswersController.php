<?php

namespace App\Http\Controllers;
use illuminate\Support\Facades\Auth;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body'=> 'required',
        ]);
        $answer = new Answer;
        $answer->body = $request['body'];
        $answer->user_id = Auth::user()->id;
        
        $question->answers()->save($answer);

        return back()->with('success', "Your answer has been successfully Updated");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $request->validate([
            'body'=> 'required',
        ]);

        $answer->body = $request['body'];
        $answer->update();

        return redirect()->route('question.show', $question)->with('success', "Your answer has been successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();

        return back()->with('success', 'Your answer has been successfully deleted');
    }
}
