<?php

namespace App\Models;

class Comment extends CoreModel
{
    protected $fillable = [
        'post_id',
        'user_name',
        'message',
        'to_comment_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
