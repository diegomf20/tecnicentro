<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/sweet-alert.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/print.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    </head>
    <body>
        <div id="app"></div>
        <script>
            var api_url="{{ asset('api') }}";
        </script>
        {{-- <script src="js/sweet-alert.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
        c<script src="js/modernizr.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/main.js"></script> --}}
        <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>        
        <script src="{{ asset('js/modernizr.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        {{-- <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> --}}
        <script src="{{ asset('js/main.js') }} "></script>        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
