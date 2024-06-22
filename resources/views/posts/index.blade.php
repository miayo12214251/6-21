<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        #myChart1 {
            max-width: 800px; /* グラフの幅を固定 */
            max-height: 400px; /* グラフの高さを固定 */
        }
        #myChart2 {
            max-width: 800px; /* グラフの幅を固定 */
            max-height: 400px; /* グラフの高さを固定 */
        }
        #myChart3 {
            max-width: 800px; /* グラフの幅を固定 */
            max-height: 400px; /* グラフの高さを固定 */
        }
        
    </style>
</head>
<body>
    <h1>日報一覧</h1>
    <div class='footer'>
        <a href='/posts/create'>日報入力はこちら</a>
    </div>
    <h2>成約数ランキング</h2>
    <canvas id="myChart1"></canvas>

    <script>
        // Chart.jsを使ってグラフを描画する
        var ctx = document.getElementById('myChart1').getContext('2d');
        var data = {!! json_encode($contractData) !!}; // PHPのデータをJavaScriptに変換

        // データの加工
        var labels = data.map(function(item) {
            return item.name;
        });

        var contractData = data.map(function(item) {
            return item.total_contract;
        });

        // グラフの設定
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '成約数',
                    data: contractData,
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
    </script>
    
        <h2>アポ数ランキング</h2>
        <canvas id="myChart2"></canvas>

    <script>
        // Chart.jsを使ってグラフを描画する
        var ctx = document.getElementById('myChart2').getContext('2d');
        var data = {!! json_encode($appointmentData) !!}; // PHPのデータをJavaScriptに変換

        // データの加工
        var labels = data.map(function(item) {
            return item.name;
        });

        var appointmentData = data.map(function(item) {
            return item.total_appointment;
        });

        // グラフの設定
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'アポ数',
                    data: appointmentData,
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
    </script>
    
    <h2>商談数ランキング</h2>
    <canvas id="myChart3"></canvas>

    <script>
        // Chart.jsを使ってグラフを描画する
        var ctx = document.getElementById('myChart3').getContext('2d');
        var data = {!! json_encode($meetingData) !!}; // PHPのデータをJavaScriptに変換

        // データの加工
        var labels = data.map(function(item) {
            return item.name;
        });

        var meetingData = data.map(function(item) {
            return item.total_meeting;
        });

        // グラフの設定
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '商談数',
                    data: meetingData,
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

    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='created_at2'><a href="/posts/{{ $post->id }}">{{ $post->created_at2 }}</a></h2>
                <p class='name'>投稿者：{{ $post->name }}</p>
                <p class='appointment'>アポ数：{{ $post->appointment }}</p>
                <p class='meeting'>商談数：{{ $post->meeting }}</p>
                <p class='contract'>成約数：{{ $post->contract }}</p>
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
