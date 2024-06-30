<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
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
        form {
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
        .button {
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
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 20px;
        }
        /* Styling for the "戻る" button to match show.blade.php */
        .btn-back {
            background-color: #6c757d;
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
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>日報入力画面</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="created_at2">
                <h2>入力日</h2>
                <input type="date" name="post[created_at2]" placeholder="〇〇年〇〇月〇〇日" required pattern="[0-9０-９]{1,4}年[0-9０-９]{1,2}月[0-9０-９]{1,2}日"/>
・            </div>
            <div class="name">
                <h2>投稿者</h2>
                <select name="post[person_id]" required>
                    <option value="">選択してください</option>
                    @foreach ($persons as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
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
            <input type="submit" value="保存" class="button"/>
        </form>
        <div class="footer">
            <a href="/" class="btn-back">戻る</a>
        </div>
    </div>
</body>
</html>
