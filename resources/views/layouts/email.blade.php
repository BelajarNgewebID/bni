<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <style>
        body {
            background-color: #ecf0f1;
            color: #444;
            font-family: Arial;
        }
        .content,.wrap { margin: 5%; }
        .container {
            background-color: #fff;
            border-radius: 6px;
            padding: 1px;
            box-shadow: 1px 1px 5px 1px #ddd;
        }
        p {
            font-size: 17px;
            line-height: 32px;
        }
        button {
            padding: 15px 25px;
            background: none;
            border: none;
            background-color: #095e6a;
            color: #fff;
            font-size: 17px;
        }
    </style>
</head>
<body>
    
<div class="content">@yield('content')</div>

</body>
</html>