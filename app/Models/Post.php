<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //trait

    protected $fillable = [
        "title",
        "content",
        "user_id",
        "image",
        "comment",
    ];


    public function writer() {
        //유저와 포스트의 관계 1:다 관계
        //User는 HasMany Posts
        //Post는 belongs to a User

        return $this -> belongsTo(User::class, 'user_id');

        //select * from users u, posts p
        //inner join on u.id = p.writer_id
    }

    public function likes() {
        return $this->belongsToMany(User::class); // N:M 의 관계에서 사용 belongsToMany
    }

    // public function comments() {
    //     return $this->belongsToMany(Comment::class);
    // }
}
