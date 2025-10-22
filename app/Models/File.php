<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Patient;
use App\Models\Insight;
use App\Models\User;
use App\Models\FileComment;
use App\Models\FileLike;

class File extends Model {
    use HasFactory;
    protected $fillable = ['patient_id','uploaded_by','filename','path','mime','size','status', 'visibility',];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function user(){ return $this->belongsTo(User::class); }
    public function insights(){ return $this->hasMany(Insight::class); }

    public function likes() {
        return $this->hasMany(FileLike::class);
    }

    public function comments() {
        return $this->hasMany(FileComment::class);
    }
    
}

