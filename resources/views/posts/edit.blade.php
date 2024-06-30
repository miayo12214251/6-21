<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'M PLUS Rounded 1c', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .created_at2 {
            margin-bottom: 20px;
        }
        .content__post {
            margin-bottom: 20px;
        }
        .content__body {
            margin-bottom: 20px;
        }
        .title {
            margin-bottom: 20px;
        }
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="created_at2">{{ $post->created_at2 }}</h1>
        <div class="content">
            <div class="content__post">
                <p>投稿者：{{ $post->person->name }}</p> 
                <p>アポ数：{{ $post->appointment }}</p>
                <p>商談数：{{ $post->meeting }}</p>
                <p>成約数：{{ $post->contract }}</p>
                <p>感想：{{ $post->body }}</p> 
            </div>
            <h2 class="title">返信内容</h2>
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__body'>
                    <input type='text' name='post[reply]' value="{{ $post->reply }}">
                </div>
                <input type="submit" value="保存"/>
            </form>
        </div>
    </div>
</body>
</html>
