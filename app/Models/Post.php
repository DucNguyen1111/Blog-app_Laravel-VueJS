<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    public $timestamps = true;
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comment::class, 'postid', 'postid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}
