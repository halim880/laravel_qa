<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Question;
class Answer extends Model
{
    protected $fillable = ['body'];
    
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }


    public function getStatusAttribute(){
        if($this->question->best_answer_id == $this->id){
            return 'answer-accepted';
        }
    }

    public function getIsBestAttribute(){
        if($this->question->best_answer_id == $this->id){
            return true;
        }
        return false;
    }

    public static function boot(){
        parent::boot();
        static::created(function ($answer){
            $answer->question->increment('answers_count');
        });
        static::deleted(function ($answer){
            $question = $answer->question;
            $question->decrement('answers_count');
            if ($question->best_answer_id == $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });
    }

    public function votes(){
        return $this->morphToMany(User::class, 'votable');
    }
    public function downVotes(){
        return $this->votes()->wherePivot('vote', -1);
    }
    public function upVotes(){
        return $this->votes()->wherePivot('vote', 1);
    }
}
