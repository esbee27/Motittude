<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Quiz;
use App\Models\Answer;



class Participant extends Model
{
    //PArticipant Model
    protected $fillable = [
        'quiz_id',
        'name',
        'code',
        'user_id',
        'score',
        'joined_via',
        'start_time',
    
    ];

    public function quiz () 
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer() 
    {
        return $this->hasMany(Answer::class);
    }

    public function result() 
    {
        return $this->hasMany(Result::class);
    }

}
