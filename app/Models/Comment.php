<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    public $timestamps = true;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'postid', 'postid');
    }
}
