<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Insight;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'gender',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    // Un patient appartient à un utilisateur (médecin/admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un patient peut avoir plusieurs fichiers uploadés
    public function files()
    {
        return $this->hasMany(File::class);
    }

    // Insights via les fichiers
    public function insights()
    {
        return $this->hasManyThrough(Insight::class, File::class);
    }
}