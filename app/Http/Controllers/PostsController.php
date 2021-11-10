<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            게시글 리스트를 데이터베이스에서 읽어옴
            게시글 목록을 만들어주는 블레이드에 읽어진 데이터를 전달하고 실행.
        */

        $posts = Post::latest()->paginate(7);
        // dd($posts);

        return view('bbs.index', ['posts'=> $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("Haro!");

        return view('bbs.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'content'=>'required|min:3',
            'image'=>'image',
        ]);
        
        $fileName = null;

        if ($request->hasFile('image')) {
            $fileName =time().'_'.
                         $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs(
                'public/image',
                $fileName
            );
        }
        // strpos, strrpos
        $input = array_merge($request->all(), ["user_id" => Auth::user()->id]);

        if ($fileName) {
            $input = array_merge($input, ['image' => $fileName]);
        }
        // dd($request->all());

        Post::create($input);

        // return view('bbs.index', ['posts'=>Post::all()]);
        return redirect()->route('posts.index', ['posts' => Post::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $id 에 해당하는 포스트를 데이터베이스에서 인출.
        $post = Post::with('likes')->find($id); // with() => Eager Loding (즉시 로딩)

        // 나온 값을 상세보기 뷰로 전달.
        return view('bbs.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // 의존성 주입 DI (Dependency Injection)

        //id 에 해당하는 포스트를 수정할 수 있는 페이지를 반환
        $post = Post::find($id);
        $this->authorize('update', $post);

        return view ('bbs.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'content'=>'required|min:3',
            'image'=>'image',
        ]);

        $post = Post::find($id);
        $this->authorize('update', $post);

        // $post->title = $request->input['title']; // 1

        $post->title = $request->title;
        $post->content = $request->content; // 2
        // $request 객체 안에 이미지가 있으면,
        // 이 이미지를 게시글의 이미지로 변경.

        if($request->image){
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에 저장하고,
            // db 에 반영하기 전에 기존 이미지가 있다면, 그 이미지를 파일 시스템에서 삭제해줘야 한다.

            if($post->image){
                Storage::delete('public/image/'.$post->image);
            }
                $filename = time().'_'.
                    $request->file('image')->getClientOriginalName();
                $post->image = $filename;

                $request->image->storeAs('public/image', $filename);
        }
        $post->save();
        /* update posts set title= "New Value"($request->title),
                           content = $request->content,
                           image = $filename, // <= optional
                           updated_at = now(),
            where id = $id;
        */

        // $post->update(['title' => $request->title, // 3 
        // 'content' => $request->content]);

        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //DI, Dependency Injection, 의존성 주입
        // dd($request);

       $post =  Post::find($id);
       $this->authorize('delete', $post); // 삭제 권한 관리. 작성자만 가능하게

        //게시글에 이미지가 있으면 파일 시스템에서도 삭제해줘야 한다.
        
        if($post->image){
            Storage::delete('public/image/'.$post->image);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function deleteImage($id) {
        $post = Post::find($id);
        
        $this->authorize('delete', $post);

        Storage::delete('public/image', $post->image);
        $post->image = null;
        $post->save();

        return redirect()->route('posts.edit', ['post'=>$post->id]);
    }

}
