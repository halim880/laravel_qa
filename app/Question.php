<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Answer;
use Illuminate\Support\Str;
class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute(){
        return route('question.show', $this);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return 'answered_accepted';
            }
            return 'answered';
        }
        else {
            return 'unanswered';
        }
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
