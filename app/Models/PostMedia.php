<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostMedia extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'path', 'type'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
