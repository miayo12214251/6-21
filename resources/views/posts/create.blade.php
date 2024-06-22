<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>
<body>
    <h1>日報</h1>
    <form action="/posts" method="POST">
        @csrf
        <div class="created_at2">
            <h2>入力日</h2>
            <input type="text" name="post[created_at2]" placeholder="〇〇年〇〇月〇〇日" required pattern="[0-9０-９]{1,4}年[0-9０-９]{1,2}月[0-9０-９]{1,2}日"/>
        </div>
        <div class="name">
            <h2>投稿者</h2>
            <select name="post[name]" required>
                <option value="">選択してください</option>
                @foreach ($persons as $id => $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
                <div class="appointment">
            <h2>アポ数</h2>
            <select name="post[appointment]" required>
                <option value="">選択してください</option>
                @for ($i = 0; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="meeting">
            <h2>商談数</h2>
            <select name="post[meeting]" required>
                <option value="">選択してください</option>
                @for ($i = 0; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="contract">
            <h2>成約数</h2>
            <select name="post[contract]" required>
                <option value="">選択してください</option>
                @for ($i = 0; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="body">
            <h2>感想</h2>
            <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。" required></textarea>
        </div>
        <input type="submit" value="store"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>
