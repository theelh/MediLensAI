<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Question;
use App\Models\User;

class ReportQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'reported_by',
        'reason',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
