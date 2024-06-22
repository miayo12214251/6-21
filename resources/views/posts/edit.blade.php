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
                <p>投稿者：{{ $post->name }}</p> 
                <p>感想：{{ $post->body }}</p>  
                    <h2 class="title">返信内容</h2>
    <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='content__body'>
                <input type='text' name='post[reply]' value="{{ $post->reply}}">
            </div>
            <input type="submit" value="保存">
        </form>
    </div>
</body>
</html>
