<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap Css -->
    <link href="{{ url('bootstrap-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/album/font-awesome/font-awesome/css/font-awesome.min.css') }}" type="text/css">
    <title>傳送成功</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans');
        body {
            font-family: 'Open Sans', 'Microsoft JhengHei', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3">
            <br><br> <h2 style="color:#0fad00">訊息成功送出</h2>
            <i class="fa fa-check fa-3x text-success" aria-hidden="true"></i>
            <h3>太棒了!</h3>
            <p style="font-size:20px;color:#5C5C5C;">敝公司已收到您的反饋並盡快與您聯絡</p>
            <a href="javascript:history.back()" class="btn btn-success">     回前頁或在 <span id="second"></span> 秒後自動跳轉      </a>
            <br><br>
        </div>
	</div>
    <script>

        (function() {
            var total = 5;
            var tick = setInterval(function() {
                document.getElementById("second").innerHTML = total;
                total -= 1;
                if (total == 0) {
                    clearInterval(tick);
                    window.location.replace(document.referrer);
                }
            }, 1000);
        })();
        
    </script>
</div>
</body>
</html>