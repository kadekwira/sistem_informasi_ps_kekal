<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title') | PS. KESIMAN KERTALANGU </title>
    <link rel="icon" href="{{ asset('logo/logo_kekal.png') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <style>
        .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a {
            background: #ffffff !important;
        }

        .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a .caret,
        .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a i,
        .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a p,
        .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a span {
            color: #1572e8 !important;
        }

    </style>
    @yield('css')
</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        @include('layouts.sidebar')

        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <!-- ./wrapper -->
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Atlantis JS -->
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#logout').click(function(e) {
                e.preventDefault();
                swal({
                    title: 'Peringatan!',
                    text: 'Apakah Anda yakin untuk keluar?',
                    icon: 'info',
                    buttons: ["Batal", "Ya"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = "{{ route('logout') }}";
                    }
                });

            });
        });
    </script>
    @yield('script')
</body>

</html>
