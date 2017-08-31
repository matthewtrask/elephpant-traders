<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Twitter Card -->
    <meta name="twitter:site" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-center">Copyright {{ date('Y') }} Matthew Trask</p>
                    <p class="text-center">This project was inspired by <a href="https://twitter.com/colinodell">Colin O'Dell</a> and others in the community.</p>
                    <p class="text-center">This project is opened sourced at <a href="https://github.com/matthewtrask/elephpant-traders">Github</a>. Read more about that on our <router-link to="about">about page</router-link></p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//use.fontawesome.com/8213b5e9ce.js"></script>
</body>
</html>
