<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function audiences()
{
    return $this->hasManyThrough(
        Audience::class,        // Target model
        Article::class,         // Through model
        'author_id',            // Foreign key on intermediate (articles) table
        'article_id',           // Foreign key on target (audiences) table
        'id',                   // Local key on Author
        'id'                    // Local key on Article
    );
}

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}