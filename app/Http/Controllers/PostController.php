<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
    }
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
     //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    public function create()
    {
        $names = Post::pluck('name', 'id'); // Posts テーブルの name フィールドを取得

        return view('posts.create', compact('names'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'post.created_at2' => ['required', 'string', 'regex:/^[0-9０-９]{1,4}年[0-9０-９]{1,2}月[0-9０-９]{1,2}日$/u'],
            'post.name' => 'required',
            'post.body' => 'required',
        ], [
            'post.created_at2.regex' => '日付は〇〇年〇〇月〇〇日の形式で入力してください。',
        ]);
    
        $input = $request->input('post');
        $post = new Post();
        $post->created_at2 = $input['created_at2'];
        $post->name = $input['name'];
        $post->body = $input['body'];
        $post->save();
    
        return redirect('/posts/' . $post->id);
    }
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}

}
