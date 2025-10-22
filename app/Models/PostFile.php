<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostFile extends Model
{
    protected $fillable = ['post_id', 'path', 'type'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

