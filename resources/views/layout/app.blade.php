<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dist/css/flat-ui.min.css">
    <link rel="stylesheet" href="/dist/css/index.css">
    <script src="/dist/js/jquery-1.11.3.min.js"></script>

    <style>
        .row {
            margin-top: 20px;;
        }

        .center {
            text-align: center;
        }

        .card {
            margin-top: 10px;
        }

        #dropdown-menu li {
            padding-bottom: 10px;
            line-height: 30px;
        }
    </style>
    <script>
        $(function () {
            $('#myTabs li').click(function (e) {
                $(this).tab('show')
            });
        })
    </script>
</head>
<body>
@include('layout.header')

<div class="container">
    @yield('content')

    @include('layout.chat')
</div>

@include('layout.footer')

<script src="/dist/js/bootstrap.min.js"></script>
<script src="/dist/js/flat-ui.min.js"></script>
<script src="/dist/js/carousel.js"></script>
</body>
</html>
