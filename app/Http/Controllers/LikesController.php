<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /*
        로그인 된 사용자의 Like / Unlike 요청 처리
    */

    public function store(Post $post) {
        // $post => Post::find($postId) 위의 타입힌트로 굳이 find 해줄 필요가 없음.

        return $post->likes()->toggle(auth()->user());

    }
}
