<!-- resources/views/posts/statistics.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>グラフ一覧</title>
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
        .chart-container {
            margin-bottom: 40px;
            max-width: 600px; /* 任意の固定幅を設定 */
            width: 100%; /* 幅を100%にすることで、親要素に合わせて調整 */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>営業管理サイト - グラフ一覧</h1>
        
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
        </div>
        
        <div class='footer'>
            <a href='/posts' class="btn btn-primary">トップページへ戻る</a>
        </div>
    </div>

    <script>
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var data1 = {!! json_encode($contractData) !!};
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
        var data2 = {!! json_encode($appointmentData) !!};
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
        var data3 = {!! json_encode($meetingData) !!};
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
