<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>営業管理サイト</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- M PLUS Rounded 1cフォント -->
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'M PLUS Rounded 1c', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .footer {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
        .card-title a {
            color: #343a40;
            text-decoration: none;
        }
        .card-title a:hover {
            text-decoration: underline;
        }
        .card-text {
            color: #6c757d;
            margin-bottom: 10px;
        }
        .btn-primary, .btn-danger {
            font-size: 14px;
        }
        .paginate {
            margin-top: 20px;
        }
        .chart-container {
            margin-bottom: 40px;
            max-width: 600px; /* 任意の固定幅を設定 */
            width: 100%; /* 幅を100%にすることで、親要素に合わせて調整 */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>営業管理サイト</h1>
        <div class='footer'>
            <a href='/posts/create' class="btn btn-primary">日報入力はこちら</a>
        </div>
         <h2>名簿一覧</h2>
 <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>投稿者</th>
                        <th>所属チーム</th>
                        <th>所属部署</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($persons->sortBy('team') as $person)
                    <tr>
                        <td><a href="/person/{{ $person->id }}">{{ $person->name }}</a></td>
                        <td><a href="/team/{{ $person->team }}">{{ $person->team }}</a></td>
                        <td><a href="/department/{{ $person->id }}">{{ $person->department }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="chart-container">
            <h2>成約数ランキング</h2>
            <canvas id="myChart1"></canvas>
        </div>
        
        <div class="chart-container">
            <h2>アポ数ランキング</h2>
            <canvas id="myChart2"></canvas>
        </div>
        
        <div class="chart-container">
            <h2>商談数ランキング</h2>
            <canvas id="myChart3"></canvas>
                                    <a href='{{ route('posts.statistics') }}' class="btn btn-primary">グラフ一覧へ</a>
        </div>
       <h2>日報一覧</h2>
        
        <div class="posts">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title h4"><a href="/posts/{{ $post->id }}">{{ date('Y年m月d日', strtotime($post->created_at2)) }}</a></h2>
                        <p class="card-text">投稿者：<a href="/person/{{ $post->person->id }}">{{ $post->person->name }}</a></p>
                        <p class="card-text">所属チーム：<a href="/team/{{ $post->person->id }}">{{ $post->person->team }}</a></p>
                        <p class="card-text">所属部署：<a href="/department/{{ $post->person->id }}">{{ $post->person->department }}</a></p>
                        <p class="card-text">アポ数：{{ $post->appointment }}</p>
                        <p class="card-text">商談数：{{ $post->meeting }}</p>
                        <p class="card-text">成約数：{{ $post->contract }}</p>
                        <p class="card-text">感想：{{ $post->body }}</p>
                        <p class="card-text">返信：{{ $post->reply }}</p>
                        
                        <div class="d-flex">
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-primary me-2">返信</a>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})" class="btn btn-sm btn-danger">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </div>

    <script>
        function deletePost(id) {
            'use strict';
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }

        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var data1 = {!! json_encode($contractData) !!}; // PHPのデータをJavaScriptに変換
        var labels1 = data1.map(function(item) {
            return item.name;
        });
        var contractData1 = data1.map(function(item) {
            return item.total_contract;
        });
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels1,
                datasets: [{
                    label: '成約数',
                    data: contractData1,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var data2 = {!! json_encode($appointmentData) !!}; // PHPのデータをJavaScriptに変換
        var labels2 = data2.map(function(item) {
            return item.name;
        });
        var appointmentData2 = data2.map(function(item) {
            return item.total_appointment;
        });
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels2,
                datasets: [{
                    label: 'アポ数',
                    data: appointmentData2,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var data3 = {!! json_encode($meetingData) !!}; // PHPのデータをJavaScriptに変換
        var labels3 = data3.map(function(item) {
            return item.name;
        });
        var meetingData3 = data3.map(function(item) {
            return item.total_meeting;
        });
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: labels3,
                datasets: [{
                    label: '商談数',
                    data: meetingData3,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
