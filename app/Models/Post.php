<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content']; // Include user_id

    public function comments()
    {
          return $this->hasMany(Comment::class); // Post can have many comments
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
