<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
        .content__post {
            margin-bottom: 20px;
        }
        .edit,
        .footer {
            margin-top: 20px;
        }
        .btn {
            font-size: 14px;
            padding: 8px 16px;
        }
        .card-text {
            color: #6c757d;
            margin-bottom: 10px;
        }
        .card-title a {
            color: #343a40;
            text-decoration: none;
        }
        .card-title a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="created_at2">{{  date('Y年m月d日', strtotime($post->created_at2)) }}</h1>
        <div class="content">
            <div class="content__post">
                <p>投稿者：<a href="/person/{{ $post->person->id }}">{{ $post->person->name }}</a></p>
                <p>アポ数：{{ $post->appointment }}</p>
                <p>商談数：{{ $post->meeting }}</p>
                <p>成約数：{{ $post->contract }}</p>
                <p>感想：{{ $post->body }}</p>  
                <p>返信：{{ $post->reply }}</p> 
            </div>
            <div class="edit">
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">返信</a>
            </div>
            <div class="footer">
                <a href="/" class="btn btn-secondary">戻る</a>
            </div>
        </div>
    </div>
</body>
</html>
