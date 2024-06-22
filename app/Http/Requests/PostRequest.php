<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
   public function store(Request $request)
    {
        $request->validate([
            'post.created_at2' => 'required|date_format:"Y年m月d日"',
            'post.name' => 'required',
            'post.body' => 'required',
        ]);
    
        $input = $request->input('post');
        $post = new Post();
        $post->created_at2 = $input['created_at2'];
        $post->name = $input['name'];
        $post->body = $input['body'];
        $post->save();
    
        return redirect('/posts/' . $post->id);
    }
}