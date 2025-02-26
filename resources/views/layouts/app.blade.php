<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Исторический архив Борисоглебской епархии</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.svg') }}">
        @include('components.head.tinymce-config')
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/template/chocolate/css/style.css') }}">
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </head>
    <body class="bg-chocolate-main">
        @include('components.forms.navbar')
        <div class="container">@yield('content')</div>
        @include('components.forms.footer')
    </body>
</html>
