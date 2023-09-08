<html>
    <head>
        <title>購物系統</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>