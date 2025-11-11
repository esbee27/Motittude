<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Participant;



class Answer extends Model
{
    //
    protected $fillable = [
        'participant_id',
        'quiz_id',
        'question_id',
        'option_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }


    
}

