<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
        //mass assignment
         protected $fillable = [
        'body', 'user_id', 
    ];
    public function question(){

    	return $this->belongsTo(Question::class);
    }

    public function user(){

    	return $this->belongsTo(user::class);
    }

    public static function boot(){
    	//eloquant Event System
    	parent::boot();
    	static::created(function($answer){

    		$answer->question->increment ('answers_count'); //over ride
    		$answer->question->save();

    	});

        parent::boot();
        static::deleted(function($answer){
            $question = $answer->question;

            $question->decrement ('answers_count'); //over ride

            if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
          

        });



    }

    public function getStatusAttribute(){
            return $this->id = $this->question->best_answer_id ? 'vote-accept':'';
    }


    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);//parsedown concept
    }

    public function getCreateDateAttribute($value)
    {
        return $this->created_at->diffForHumans();//time format diffforHumans
        //eloquant accessore it can show your post time
    }

    public function getUrlAttribute(){

            return route('questions.show', $this->slug);
        }
       
}
