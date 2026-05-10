<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SCE</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="author" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
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
            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="footer-item">
                                <div class="company-brand">
                                    <img src="{{ asset('site/img/logo-sce.jpeg') }}" alt="logo" class="footer-logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="footer-menu">
                                <h5>Obras</h5>
                                <ul class="menu-list">
                                    <li class="menu-item">
                                        <a href="#">Mais votadas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="footer-menu">
                                <h5>Minha conta</h5>
                                <ul class="menu-list">
                                    <li class="menu-item">
                                        <a href="#">Sign In</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Minha conta</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="footer-menu">
                                <h5>Contato</h5>
                                <ul class="menu-list">
                                    <li class="menu-item">
                                        <a href="#">colocar meu link</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">colocar o meu e-mail</a>
                                    </li>						
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <div id="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>© 2022 All rights reserved. Free HTML Template by <a
                                                href="https://www.templatesjungle.com/" target="_blank">TemplatesJungle</a></p>
                                    </div>
                                    <div class="col-md-6">
                                        <site-social-links 
                                            :links='{!! json_encode([
                                                ["route" => '#', "icon" => "icon icon-facebook", "name" => "Facebook"],
                                            ]) !!}'
                                            :class-item="'align-right'"
                                        >
                                        </site-social-links>
                                    </div>
                                </div>
                            </div><!--grid-->
                        </div><!--footer-bottom-content-->
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>