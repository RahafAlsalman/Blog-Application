<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'comment']; // Fillable attributes

    public function user()
    {
        return $this->belongsTo(User::class); // Define relationship with User
    }

    public function post()
    {
        return $this->belongsTo(Post::class); // Define relationship with Post
    }
}
