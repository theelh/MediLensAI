<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\User;

class Report extends Model
{
    protected $fillable = ['user_id', 'file_id', 'reason', 'status'];

    public function file() { return $this->belongsTo(File::class); }
    public function user() { return $this->belongsTo(User::class); }
}

