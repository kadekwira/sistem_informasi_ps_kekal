@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ $title }}</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route(auth()->user()->level) }}">Home</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $title }}</a>
                </li>
            </ul>
        </div>
        <div class="row h-100 justify-content-center align-items-center py-5">
            <div class="col-12 col-sm-8 col-md-7 col-lg-7  ml-auto mr-auto">
                <div class="card card-profile">
                    <div class="card-header"
                        style="background-image: url({{ asset('assets/img/bg-abstract.png') }}); border-radius: 8px 8px 0px 0px;">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                @if ($user->avatar == '')
                                    <i class="fa fa-user-circle fa-5x text-muted bg-white rounded-circle"
                                        aria-hidden="true"></i>
                                @else
                                    <img src="{{ asset('profile/' . $user->avatar) }}" alt=""
                                        class="avatar-img rounded-circle border border-white">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" id="modalForm" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            value="{{ $user->nama }}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">Re-Type Password</label>
                                        <input type="password" name="password_confirm" id="password_confirm"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            value="{{ $user->tanggal_lahir }}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6">
                                        <label for="">No Hp</label>
                                        <input type="number" name="nohp" id="nohp" class="form-control"
                                            value="{{ $user->nohp }}">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control"
                                            rows="5">{{ $user->alamat }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Foto</label>
                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*"
                                            onchange="loadFile(event)">
                                        <img id="output" class="img-fluid w-75 d-block mr-auto ml-auto p-3" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('assets/js/plugin/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function() {
            // tambah data
            var validator = $("#modalForm").validate({
                rules: {
                    nama: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password_confirm: {
                        required: function() {
                            return ($('form').find('#password').val() != "");
                        },
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
                        required: function() {
                            return ($('form').find('#id').val() == "");
                        },
                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group, .form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('profile.update') }}",
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
                                    window.location.href = "";
                                });
                            } else {
                                swal({
                                    icon: 'error',
                                    title: response.message,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                }).then(function() {
                                    window.location.href = "";
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
@endsection
