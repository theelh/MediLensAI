<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\User;

class FileComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'user_id',
        'body',
    ];

    /**
     * The file that this comment belongs to
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * The user who made the comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
