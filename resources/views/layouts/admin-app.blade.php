<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">
        <title>
            SCE - Área administrativa
        </title>
        @routes
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.css') }}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    @yield('css')
</html>

<body class="g-sidenav-show   bg-gray-100">
    <div id="app">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <admin-navbar
            :navs='{!! json_encode([
                ["route" => route("admin.dashboard"), "icon" => "ni ni-tv-2", "name" => "Dashboard", "view" => true],
                ["route" => route("admin.categorias.index"), "icon" => "ni ni-archive-2", "name" => "Categorias", "view" => true],
                ["route" => route("admin.tipos-de-categorias.index"), "icon" => "ni ni-archive-2", "name" => "Tipos de Categorias", "view" => true],
                ["route" => route("admin.posts.index"), "icon" => "ni ni-bullet-list-67", "name" => "Posts", "view" => true],
                ["route" => route("admin.planos.index"), "icon" => "ni ni-bullet-list-67", "name" => "Planos", "view" => true],
                ["route" => route("admin.classificacao-indicativas.index"), "icon" => "ni ni-istanbul", "name" => "Classificação Indicativas", "view" => true],
                ["route" => route("admin.assinaturas.index"), "icon" => "ni ni-credit-card", "name" => "Assinatura", "view" => true],
                ["route" => route("admin.clientes.index"), "icon" => "ni ni-user-run", "name" => "Clientes", "view" => true],
                ["route" => "#", "icon" => "ni ni-badge", "name" => "Membros", "view" => true],
                ["route" => "#", "icon" => "ni ni-folder-17", "name" => "Logs", "view" => true],
                ["route" => "#", "icon" => "ni ni-settings-gear-65", "name" => "Permissões", "view" => true],
            ]) !!}'
        ></admin-navbar>
    
        <main class="main-content position-relative border-radius-lg ">
            <admin-header>
                @yield('breadcrumb')
            </admin-header>
            <div class="container-fluid py-4">
                @yield('content')
                <admin-footer></admin-footer>
            </div>
        </main>
    </div>
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
     <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/js/argon-dashboard.min.js') }}"></script>
</body>