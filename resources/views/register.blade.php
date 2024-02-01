<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Supporter</title>
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

    </style>
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center py-5">
            <div class="col-12 col-sm-8 col-md-5 col-lg-5  ml-auto mr-auto">
                <!-- /.login-logo -->
                @if (session('info'))
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-triangle"></i></strong>
                        {{ session('info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body rounded">
                        <div class="w-25 text-center mr-auto ml-auto mb-3">
                            <img src="{{ asset('logo/logo_kekal.png') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <p class="font-weight-bold text-center h4 mb-4">
                            {{ Str::of('Registrasi Supporter')->upper() }}
                        </p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Re-Type Password</label>
                                    <input type="password" name="password_confirm" id="password_confirm"
                                        class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="">No Hp</label>
                                    <input type="number" name="nohp" id="nohp" class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*"
                                        onchange="loadFile(event)">
                                    <img id="output" class="img-fluid w-75 d-block mr-auto ml-auto p-3" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-border">Kembali
                                        Login</a>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <button type="submit" class="btn btn-secondary pull-right" id="register">
                                        <span class="btn-label">
                                            <i class="icon icon-login"></i>
                                        </span>
                                        Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
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
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function() {
            $("form").validate({
                rules: {
                    nama: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirm: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    level: {
                        required: true,
                    },
                    tanggal: {
                        required: true,
                    },
                    nohp: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                    foto: {
                        required: true,
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
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('register') }}",
                        type: "POST",
                        dataType: "JSON",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: new FormData(form),
                        success: function(response) {
                            if (response.status) {
                                swal({
                                    icon: 'success',
                                    title: response.message,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                }).then(function() {
                                    window.location.href = '../' + response.url +
                                        '';
                                });
                            } else {
                                swal({
                                    icon: 'error',
                                    title: response.message,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                }).then(function() {

                                });
                            }
                        },
                        error: function(response) {
                            swal({
                                icon: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            });
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
