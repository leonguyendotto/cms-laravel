<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Console Dashboard</title>

        <!--W3SCHOOL-->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{url('app.css')}}">

        <script src="{{url('app.js')}}"></script>

    </head>
    <body class="antialiased">

        <h1>CMS Admin Console</h1>

        @if (Auth::check())
            You are logged in as {{auth()->user()->first}} |
            <a href="/console/logout">Logout</a> |
            <a href="/console/dashboard">Dashboard</a> |
            <a href="/">Website Homepage </a>
        @else
            You are not logged in
            <a href="/">Return to my Portfolio</a>
        @endif


        <hr>

        @yield('content')
    </body>
</html>