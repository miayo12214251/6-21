<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='created_at2'><a href="/posts/{{ $post->id }}">{{ $post->created_at2 }}</a></h2>
                    <p class='name'>投稿者：{{ $post->name }}</p>
                    <p class='body'>感想：{{ $post->body }}</p>
                    <p class='reply'>返信：{{ $post->reply }}</p>
                    
                    <a href="/posts/{{ $post->id }}/edit">返信</a>
                    
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                    </form>
                    
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
         <div class='footer'>
            <a href='/posts/create'>create</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
