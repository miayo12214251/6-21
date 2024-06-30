<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $posts[0]->person->name }}日報一覧</title>
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'M PLUS Rounded 1c', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .posts {
            margin-top: 20px;
        }
        .post {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .post h2 {
            margin-bottom: 10px;
        }
        .name, .appointment, .meeting, .contract, .body, .reply {
            color: #343a40; /* 一貫性のために調整した色 */
            margin-bottom: 10px;
        }
        
        .footer {
            margin-top: 20px;
        }
        .paginate {
            margin-top: 20px;
        }
        .paginate .pagination {
            justify-content: center;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: none;
        }
        .btn-primary, .btn-danger, .btn-secondary {
            font-size: 14px;
        }
        .btn-group {
            gap: 10px;
        }
        .chart-container {
            margin-bottom: 40px;
            max-width: 600px; /* 任意の固定幅を設定 */
            width: 100%; /* 幅を100%にすることで、親要素に合わせて調整 */
        }
    </style>
</head>
<body>
    <h1>{{ $posts[0]->person->name }} 専用ページ</h1>
    <div class="charts-container">
        <div class="chart-container">
            <h2>月別成約数推移</h2>
            <canvas id="contractsChart"></canvas>
        </div>
        
        <div class="chart-container">
            <h2>月別アポ数推移</h2>
            <canvas id="appointmentsChart"></canvas>
        </div>
        
        <div class="chart-container">
            <h2>月別商談数推移</h2>
            <canvas id="meetingsChart"></canvas>
        </div>
    </div>
    
    <h1>日報一覧</h1> <!-- $postsが空でないことを前提としています -->
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='created_at2'><a href="/posts/{{ $post->id }}">{{{ date('Y年m月d日', strtotime($post->created_at2)) }}}</a></h2>
                <p class='name'>投稿者：{{ $post->person->name }}</p>
                <p class='name'>所属チーム：{{ $post->person->team }}</p>
                <p class='name'>所属部署：{{ $post->person->department }}</p>
                <p class='appointment'>アポ数：{{ $post->appointment }}</p>
                <p class='meeting'>商談数：{{ $post->meeting }}</p>
                <p class='contract'>成約数：{{ $post->contract }}</p>
                <p class='body'>感想：{{ $post->body }}</p>
                <p class='reply'>返信：{{ $post->reply }}</p>
                
                <div class="btn-group">
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">返信</a>
                    
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})" class="btn btn-danger">削除</button> 
                    </form>
                </div>
            </div>
        @endforeach

        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        
        <div class="footer">
            <a href="/" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx1 = document.getElementById('appointmentsChart').getContext('2d');
            var appointmentsChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: {!! json_encode($appointmentsData->pluck('month_year')) !!},
                    datasets: [{
                        label: 'アポ数',
                        data: {!! json_encode($appointmentsData->pluck('total_appointment')) !!},
                        fill: false,
                        borderColor: 'rgba(54, 162, 235, 1)', // 青色
                        borderWidth: 2
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

            var ctx2 = document.getElementById('meetingsChart').getContext('2d');
            var meetingsChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: {!! json_encode($meetingsData->pluck('month_year')) !!},
                    datasets: [{
                        label: '商談数',
                        data: {!! json_encode($meetingsData->pluck('total_meeting')) !!},
                        fill: false,
                        borderColor: 'rgba(153, 102, 255, 1)', // 紫色
                        borderWidth: 2
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

            var ctx3 = document.getElementById('contractsChart').getContext('2d');
            var contractsChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: {!! json_encode($contractsData->pluck('month_year')) !!},
                    datasets: [{
                        label: '成約数',
                        data: {!! json_encode($contractsData->pluck('total_contract')) !!},
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)', // 緑色
                        borderWidth: 2
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
        });

        function deletePost(id) {
            'use strict';

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>
</html>
