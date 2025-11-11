<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Quiz;



class Result extends Model
{
    //
    protected $fillable = [
        'id',
        'quiz_id',
        'answers',
    ];
    public function quiz() 
    {
        return $this->belongsTo(Quiz::class);
    }  
    
    public function participant() 
    {
        return $this->belongsTo(Participant::class);
    }

}
