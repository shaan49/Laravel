<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{		
	//mass assignment
		 protected $fillable = [
        'title', 'body', 
    ];
    		//one to many relationship
    public function user(){
    	return $this->belongsTo(User::class);
    }
        public function getUrlAttribute(){

            return route('questions.show', $this->slug);
        }


     //slug  concept
    public function SetTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    public function getCreateDateAttribute($value)
    {
        return $this->created_at->diffForHumans();//time format diffforHumans
        //eloquant accessore it can show your post time
    }
    public function getStatusAttribute(){

        if($this-> answers_count > 0){
            if($this-> best_answer_id){

                return'answered-accepted';
            }

            return'answered';
        }
        return'unanswered';
    }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);//parsedown concept
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}


