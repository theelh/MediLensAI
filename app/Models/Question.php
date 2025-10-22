<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Answer;
use App\Models\Like;
use App\Models\ReportQuestion;

class Question extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'status','visibility'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
{
    return $this->hasMany(ReportQuestion::class);
}

    // ✅ Polymorphic relation for likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }



    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

