<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('logo/logo_kekal.png') }}" type="image/x-icon">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
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
                urls: ['../../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <style>
        body,
        html {
            height: 100%;
        }

        .bg-danger {
            background: #003197;
        }

        .btn-danger {
            background: #003197 !important;
            border-color: #003197 !important;
        }

        .carousel .carousel-item {
            height: 500px;
        }

        .carousel-item img {
            position: absolute;
            object-fit: cover;
            top: -15em;
            left: 0;
            min-height: 500px;
        }

        .navbar .navbar-nav .nav-item .nav-link:focus,
        .navbar .navbar-nav .nav-item .nav-link:hover {
            background: none !important;
        }

        @media screen and (max-width: 600px) {
            .text-d {
                display: none;
            }

            .text-mb {
                display: inline-block !important;
            }

            .carousel .carousel-item {
                height: 200px;
            }

            .carousel-item img {
                position: absolute;
                object-fit: cover;
                top: -5em;
                left: 0;
                min-height: 200px;
            }
        }

    </style>
</head>

<body class="bg-primary">
    {{-- navigasi --}}
    <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom p-0">
        <div class="container">
            <a class="navbar-brand text-dark font-weight-bold" href="#"> <img src="{{ asset('logo/logo_kekal.png') }}"
                    alt="" width="80" height="80">
                <span class="text-d">{{ Str::of('Sistem Informasi Online PS. Kesiman Kertalangu')->upper() }}</span>
                <span class="text-mb d-none">{{ Str::of('PS. Kesiman Kertalangu')->upper() }}</span>
            </a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-sm navbar-light bg-primary">
        <div class="container">
             {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler d-lg-none text-white" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                {{-- <span class="navbar-toggler-icon"></span> --}}
                <i class="fa fa-bars fa-1x" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Berita Terkini</a>
                        @if (count($berita))
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                @php
                                    $t = count($berita);
                                @endphp
                                @foreach ($berita as $no => $item)
                                    <a class="dropdown-item" href="{{ $item->link }}">{{ $item->text }}</a>
                                    @if ($no + 1 != $t)
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                        @endif
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Jadwal Bulan Ini</a>
                        @if (count($jadwal))
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                @php
                                    $t = count($jadwal);
                                @endphp
                                @foreach ($jadwal as $no => $item)
                                    <a class="dropdown-item">{{ Carbon\Carbon::parse($item->jadwal)->translatedFormat('M d | H:i')  }} |
                                        <img src="{{ asset('jadwal/' . $item->logo1) }}" class="avatar rounded-circle" alt="" style="width: 50px;height: auto;"> {{ $item->team1 }}
                                        VS
                                        <img src="{{ asset('jadwal/' . $item->logo2) }}" class="avatar rounded-circle" alt="" style="width: 50px;height: auto;"> {{ $item->team2 }}</a>
                                    @if ($no + 1 != $t)
                                        <div class="dropdown-divider"></div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- slider --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/foto_1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/foto_2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/foto_3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- konten --}}
    <div class="container">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-12">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-bullhorn pr-2" aria-hidden="true"></i>
                            Pengumuman
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($pengumuman))
                            <ol class="activity-feed">
                                @foreach ($pengumuman as $item)
                                    <li class="feed-item feed-item-info">
                                        <time class="date"
                                            datetime="9-25">{{ date('M d', strtotime($item->jadwal)) }} |
                                            {{ date('H:i', strtotime($item->jadwal)) }}</time>
                                        <div class="row h-100">
                                            <div class="col-12 col-md-12 text my-auto">
                                                <p class="font-weight-bold">{{ $item->text }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="alert alert-warning">
                                <strong>Belum ada jadwal pengumuman</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-4  ml-auto mr-auto mt-5">
                <!-- /.login-logo -->
                @if (session('info'))
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-triangle"></i></strong>
                        {!! session('info') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body rounded">
                        <h3 class="font-weight-bold">{{ Str::of('Login')->upper() }}</h3>
                        <hr>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    value="">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="icon-envelope-open icons"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                    <a href="{{ route('register') }}"
                                        class="btn btn-primary btn-block btn-border">Daftar
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                    <button type="submit" class="btn btn-danger text-white btn-block pull-right"
                                        id="login">
                                        <span class="btn-label">
                                            <i class="icon icon-login"></i>
                                        </span>
                                        Sign In
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-8  ml-auto mr-auto mt-5">
                <div class="text-white">
                    <h1 class="font-weight-bold mb-4">{{ Str::of('PS. Kesiman Kertalangu')->upper() }}</h1>
                    <p>
                        {{ $info->text ?? null}}
                    </p>
                    <p>
                        Sosial Media Kami
                    </p>
                    <p class="demo">
                        <a href="https://www.facebook.com/persatuan.kertalangu" class="btn btn-white mr-1 ml-1"
                            target="_blank">
                            <span class="btn-label">
                                <i class="fab fa-facebook" aria-hidden="true"></i>
                            </span>
                            Facebook
                        </a>
                        <a href="https://www.instagram.com/ps.kekal/?hl=id"
                            class="btn btn-white mr-1 ml-1" target="_blank">
                            <span class="btn-label">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </span>
                            Instagram
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('assets/js/plugin/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $.validator.setDefaults({
            submitHandler: function() {
                var email = $("#email").val();
                var password = $("#password").val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    data: {
                        "email": email,
                        "password": password,
                        "_token": token
                    },
                    beforeSend: function() {
                        var login = $('#login');
                        login.attr('disabled', true);
                        login.html(
                            '<i class="spinner-border spinner-border-sm" id="loading" role="status"></i> Loading...'
                        );
                    },
                    success: function(response) {
                        if (response.success) {
                            swal('info', {
                                    icon: 'success',
                                    text: response.message,
                                    timer: 1000,
                                    buttons: false
                                })
                                .then(function() {
                                    window.location.href = response.level;
                                });
                        } else {
                            swal('info', {
                                icon: 'error',
                                text: response.message
                            });
                        }
                        var login = $('#login');
                        login.attr('disabled', false);
                        login.html('Login');
                    },
                    error: function(response) {
                        swal({
                            icon: 'error',
                            title: 'Opps!',
                            text: 'server error!'
                        });
                        console.log(response);
                        var login = $('#login');
                        login.attr('disabled', false);
                        login.html('Login');
                    }

                });
            }
        });

        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 2000
            });
            $("form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: "Please enter a valid email address",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
</body>

</html>
