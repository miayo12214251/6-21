<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>
<body>
    <h1>Blog Name</h1>
    <form action="/posts" method="POST">
        @csrf
        <div class="created_at2">
            <h2>Date</h2>
            <input type="text" name="post[created_at2]" placeholder="〇〇年〇〇月〇〇日" required pattern="[0-9０-９]{1,4}年[0-9０-９]{1,2}月[0-9０-９]{1,2}日"/>
        </div>
        <div class="name">
            <h2>Name</h2>
            <select name="post[name]" required>
                <option value="">選択してください</option>
                @foreach ($names as $id => $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="body">
            <h2>Body</h2>
            <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。" required></textarea>
        </div>
        <input type="submit" value="store"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>
