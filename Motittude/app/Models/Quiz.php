<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\User;


class Quiz extends Model
{
    //
    protected $fillable = [
        'name',
        'code',
        
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    
    }
    

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user', 'quiz_id', 'user_id')
                    ->withTimestamps();
    }

    // Quiz.php
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }


}
