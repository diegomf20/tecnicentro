<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    </head>
    <body>
        <div id="app"></div>
        <script>
            var api_url="{{ asset('api') }}";
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
