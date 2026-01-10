<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['author_id', 'name', 'content'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function audiences()
    {
        return $this->hasMany(Audience::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}