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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (auth()->user()->level == 'admin')
                            <button class="btn btn-primary btn-sm" id="tambah">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Tambah Galeri
                            </button>
                        @endif
                        <div class="card-group row mt-3" id="galeri" style="position: relative">
                            @if (count($galeri) > 0)
                                @include('galeri.load')
                            @else
                                <div class="alert alert-info col-12" role="alert">
                                    <span class="h3"><i class="flaticon-error text-danger"></i> Tidak ada galeri</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="modalForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nama</label>
                                <input type="text" name="judul" id="judul" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
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
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                $('#galeri .card').css('opacity', '0.2');
                $('#galeri').append(
                    '<img style="position: absolute;left: 50%;top: 50%;right: 50%;z-index: 100000;transform: translate(-50%, -50%);" src="../assets/img/loading.gif" />'
                );
                var url = $(this).attr('href');
                getGaleri(url);
                window.history.pushState("", "", url);
            });

            function getGaleri(url = null) {
                if (url == null) {
                    window.history.pushState("", "", "galeris");
                    $.ajax({
                        url: "{{ url('galeris') }}",
                        data: {
                            'page': 1
                        },
                    }).done(function(data) {
                        $('#galeri').html(data);
                    }).fail(function() {
                        alert('Galeri could not be loaded.');
                    });
                } else {
                    $.ajax({
                        url: url,
                    }).done(function(data) {
                        $('#galeri').html(data);
                    }).fail(function() {
                        alert('Galeri could not be loaded.');
                    });
                }
            }
            // open modal tambah
            $('#tambah').click(function(e) {
                e.preventDefault();
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Tambah');
            });

            // reset all input in form after clicking modal
            $('#modal').on('hidden.bs.modal', function(e) {
                validator.resetForm();
                $("#modalForm").find('.is-invalid').removeClass('is-invalid');
                $(this)
                    .find("input,textarea,select")
                    .not('#id,input[name="_token"]')
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                $('#modal form').find('#id').val('');
                $('#modal form').find('#output').attr('src', '');
            });

            // focus input
            $('#modal').on('shown.bs.modal', function() {
                $(this).find('#nama_paket').focus();
            });

            // delete data
            $('#galeri').on("click", "#hapus", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: 'Anda yakin untuk menghapus ini ?',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: "{!! url('galeris/delete/"+id+"') !!}",
                            type: "GET",
                            dataType: "JSON",
                            cache: false,
                            success: function(response) {
                                if (response.status) {
                                    swal({
                                        icon: 'success',
                                        title: response.message,
                                    }).then(function() {
                                        getGaleri();
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
            // tambah data
            var validator = $("#modalForm").validate({
                rules: {
                    judul: {
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
                    var id = $(form).find('#id').val();
                    if (id == "") {
                        $.ajax({
                            url: "{{ route('galeri') }}",
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
                                    }).then(function() {
                                        $('#modal').modal('hide');
                                        getGaleri();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                    }).then(function() {
                                        getGaleri();
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
                }
            });
        });
    </script>
@endsection
