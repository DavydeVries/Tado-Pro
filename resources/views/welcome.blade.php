<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>mijn tado&deg; Pro</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}
        <link href="/css/tado.css" rel="stylesheet">
    </head>
    <body class="h-full bg-grey-100">
        <div id="app" class="h-full">
            <router-view></router-view>
        </div>

        <script>
            @php
                echo file_get_contents('../public/js/app.js');
            @endphp
        </script>
    </body>
</html>
