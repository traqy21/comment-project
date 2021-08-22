<?php

namespace App\Models;

class Post extends CoreModel
{
    protected $fillable = [
        'title',
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
