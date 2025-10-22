<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PostFile;
use App\Models\Like;
use App\Models\Comments;
use App\Models\PostMedia;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'visibility'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(PostFile::class);
    }


    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function media()
{
    return $this->hasMany(PostMedia::class);
}

}
