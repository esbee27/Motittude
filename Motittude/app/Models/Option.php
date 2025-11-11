<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Answer;



class Option extends Model
{
    protected $fillable = [
        'question_id',
        'option_text',
        'correct_answer' => 'boolean',
    ];
    
    //Relationship with questions
    public function question() 
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

}
