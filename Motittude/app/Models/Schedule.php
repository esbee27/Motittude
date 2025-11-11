<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //Shows questions at assigned time
    protected $fillable = [
        'subject_id',
        'question_ids',
        'date',
        'title',

    ];

    public function subject () {
        return $this->belongsTo(Subject::class);
    }

    public function question () {
        return $this->belongsToMany(Question::class, 'schedule_question');
    }
}
