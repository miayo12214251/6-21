<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="created_at2">
             {{ $post->created_at2 }}
        </h1>
        <div class="content">
            <div class="content__post">
                <p>投稿者：{{  $post->name  }}</p> 
                <p>感想：{{ $post->body }}</p>  
                <p>返信：{{ $post->reply }}</p> 
            </div>
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">返信</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>