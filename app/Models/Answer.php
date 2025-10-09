<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Answer extends Model
{
    protected $fillable = ['question_id', 'doctor_id', 'body'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}

