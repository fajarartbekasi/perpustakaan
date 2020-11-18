<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Perpustakaan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.partials.nav')

        <main role="main" class="mb-3">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="text-center" style="margin-top: -100px">SDN JATIMULYA 08</h1>
                </div>
            </div>
            <div class="container">
                @yield('content')
            </div>
        </main>
        <footer class="footer  mt-auto py-3 pt-3">
            <div class="container">
                <span>© 2020 Youre Name. All Rights Reserved.</span>
            </div>
        </footer>
    </body>
</html>
