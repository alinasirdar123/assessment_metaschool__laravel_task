<!DOCTYPE html>
<html lang="en">
    <head>
        <title>To Do App</title>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('public/css/fonts/fonts-stylesheet.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/fontawesome/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/bootstrap-select.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/css/core.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

        @yield('css')

        <script src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/app.js') }}" ></script>
        <script src="{{ asset('public/js/jquery.form.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/js/validator.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/js/core.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/js/bootstrap-select.min.js') }}" type="text/javascript"></script>

        @yield('js')
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>

        @yield('content')
    </body>
</html>