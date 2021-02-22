<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "users";
    public $timestamps = true;
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class, 'userid', 'userid');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, "userid", "userid");
    }
}
