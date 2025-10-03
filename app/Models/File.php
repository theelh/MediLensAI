<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Patient;
use App\Models\Insight;

class File extends Model {
    use HasFactory;
    protected $fillable = ['patient_id','uploaded_by','filename','path','mime','size','status'];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function insights(){ return $this->hasMany(Insight::class); }
}

