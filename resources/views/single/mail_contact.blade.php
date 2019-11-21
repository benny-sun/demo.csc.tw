<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Concepoint</title>
</head>
<body>
   <p>客戶: {{ $name }}</p>
   <p>聯絡方式: {{ $contacts }}</p>
   <p>職業: {{ $job }}</p>
   <p>訊息: {!! $msg !!}</p>
   <p>來源: {{ $catelog }}</p>
</body>
</html>