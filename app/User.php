<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Question;
use App\Answer;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute(){
        // return route('question.show', $this);
        return '#';
    }

    public function getAvatarAttribute(){
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favorites(){
        return $this->belongsToMany(Question::class, 'favorites')->withTimeStamps(); 
    }

    public function voteQuestions(){
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers(){
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote){
        $vq = $this->voteQuestions();
        if ($vq->where('votable_id', $question->id)->exists()) {
            $vq->updateExistingPivot($question, ['vote'=> $vote]);
        }
        else {
            $vq ->attach($question, ['vote'=>$vote]);
        }

        $question->load('votes');
        $uv = (int) $question->downVotes()->sum('vote');
        $dv = (int) $question->upVotes()->sum('vote');
        $question->votes_count = $dv + $uv;
        $question->save();
    }

    public function voteAnswer(Answer $answer, $vote){
        $va = $this->voteAnswers();
        if ($va->where('votable_id', $answer->id)->exists()) {
            $va->updateExistingPivot($answer, ['vote'=> $vote]);
        }
        else {
            $va ->attach($answer, ['vote'=>$vote]);
        }

        $answer->load('votes');
        $uv = (int) $answer->downVotes()->sum('vote');
        $dv = (int) $answer->upVotes()->sum('vote');
        $answer->votes_count = $dv + $uv;
        $answer->save();
    }
}
