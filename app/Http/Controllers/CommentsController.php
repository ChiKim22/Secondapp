<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index($postId){

        //select * from comments where post_id = ?
        //order by created_at desc;

        $comments = Comment::with('user')->where('post_id', $postId)->latest()->paginate(5); // user name 을 뽑기위해 서버에서 조인

        return $comments;

        // select * from comments where post_id = $post->id;
        // Post 클래스에 comments 함수가 구현된 경우.
        // return $post->comments;
        
    }

    public function update(Request $request, $comment_id){

        $request->validate(['comment' => 'required|min:3']);

        // update할 레코드를 먼저 찾고, 그 다음 update
        $comment = Comment::find($comment_id);
        //selest * from comment where id = ?

        $comment->update([
                'comment' => $request->input('comment'),
        ]);


        return $comment;

    }

    // Add Comment
    public function store(Request $request, $post_id){ 
       
        
        // 객체 생성 후 맴버변수(프로퍼티) 설정 후 save();
        // $comment = new Comment;
        // $comment->user_id = auth()->user()->id;
        // $comment->post_id = $post_id;
        // $comment->comment = $request->comment;
        // $comment->save();

        // validation check
        $request->validate(['comment' => 'required|min:3']); // ['required', 'min:3']
        // $this->validate($request, ['comment'=>'required']);

        // create 에 사용할 수 있는 칼럼들은
        // Eloquant 모델 클래스에 $fillable 에 명시해야함. Mass assignment
        $comment = Comment::create([
            'comment'=>$request->comment,
            'user_id'=>auth()->user()->id,
            'post_id'=>$post_id,
        ]);

        // return 'Success';
        return $comment; // create 에 의해 생겨난 레코드에 대응되는 eloquent 객체.
    }

    public function destroy($comment_id){
        // comments 테이블에서 id 가 일치하는 레코드를 삭제.
        // RAW query, DB Query Builder, Eloquent

        $comment = Comment::find($comment_id); // 정적 메소드.

        $comment->delete();
       
        return $comment;
    }
}
