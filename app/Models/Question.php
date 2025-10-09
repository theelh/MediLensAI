<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Answer;

class Question extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

