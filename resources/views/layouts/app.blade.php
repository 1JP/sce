<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $companyName }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="author" content="">
        <meta name="keywords" content="">
        <meta name="description" content="{{ $companyDescription }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/jpeg" href="{{ asset('site/img/logo-favicon.jpeg') }}">
        @routes
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('site/css/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('site/icomoon/icomoon.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('site/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('site/css/style.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        @yield('css')
    </head>
    <body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
        <div id="app">
            <site-header 
                :name="'{{ $user->name ?? '' }}'"
                :is-role="{{ $isRole }}"
                :logo="'{{ asset('site/img/logo-sce.jpeg') }}'" >
            </site-header>
            <div class="py-5">
                <div class="container">
                    @include('partials.alert')
                </div>
            </div>
            @yield('content')
            <site-footer
                :logo="'{{ asset('site/img/logo-sce.jpeg') }}'"
                :user="{{ json_encode($user) }}"
                :email="'{{ $companyEmail }}'"
                :phone="'{{ $companyPhone }}'"
                :streets="'{{ $companyAddress }}'"
            >
            </site-footer>
        </div>
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>