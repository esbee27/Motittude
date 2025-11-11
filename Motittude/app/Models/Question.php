<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Option;
use App\Models\Answer;



class Question extends Model
{

    protected $fillable = [
        'quiz_id',
        'question_text',
        
    ];

    //Option function
    public function options() 
    {
        return $this->hasMany(Option::class);
    }

    public function quiz() 
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers() 
    {
        return $this->hasMany(Answer::class);
    }
}
