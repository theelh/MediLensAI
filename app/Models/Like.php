<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
    ];

    /**
     * 🔗 Relation : un like appartient à une question
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function likeable() { return $this->morphTo(); }

    /**
     * 🔗 Relation : un like appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}