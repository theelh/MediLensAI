<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Insight extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'type',
        'content',
        'summary',
        'confidence',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    // Pour accéder au patient depuis l’insight
    public function patient()
    {
        return $this->hasOneThrough(Patient::class, File::class, 'id', 'id', 'file_id', 'patient_id');
    }
}
