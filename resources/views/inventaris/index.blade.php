@extends('layouts.app')

@section('title', $title)
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/datepicker/bootstrap-datepicker.min.css') }}">
@endsection
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
                                Tambah Inventaris
                            </button>
                        @endif
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th>Keadaan</th>
                                        <th>Sumber</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
                                <label for="">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="">Tahun</label>
                                <input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Keadaan</label>
                                <select name="keadaan" id="keadaan" class="form-control">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="baik">Baik</option>
                                    <option value="tidakbaik">Tidak Baik</option>
                                    <option value="sedangdiperbaiki">Sedang Diperbaiki</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Sumber</label>
                                <input type="text" name="sumber" id="sumber" class="form-control">
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
    <!-- DatePicker -->
    <script src="{{ asset('assets/js/plugin/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function() {
            $("#tahun_masuk").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            }).on('changeDate', function(e) {
                $(this).datepicker('hide');
            });

            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('inventaris') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'tahun_masuk',
                        name: 'tahun_masuk'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'keadaan',
                        name: 'keadaan'
                    },
                    {
                        data: 'sumber',
                        name: 'sumber'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            var btn = '<div class="btn-group" role="group">';
                            btn += '<button data-id="' + row.id +
                                '" class="btn btn-round btn-icon btn-success btn-sm" id="edit"><i class="fa fa-edit"></i></button>';
                            btn += '<button data-id="' + row.id +
                                '" class="btn btn-round btn-icon btn-danger btn-sm" id="hapus"><i class="fa fa-trash"></i></button>';
                            btn += '</div>';

                            return btn;
                        },
                    },
                ]
            });

            if ("{{ auth()->user()->level }}" != "admin") {
                table.column(6).visible(false);
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

            // open modal edit
            table.on("click", "#edit", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Edit');
                $('#modal form').find('#id').val(id);
                $.ajax({
                    url: "{{ url('inventaris/edit') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        $('#modal form').find('#nama_barang').val(data.nama_barang);
                        $('#modal form').find('#tahun_masuk').val(data.tahun_masuk);
                        $('#modal form').find('#jumlah').val(data.jumlah);
                        $('#modal form').find('#keadaan').val(data.keadaan).change();
                        $('#modal form').find('#sumber').val(data.sumber);

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
            });

            // delete data
            table.on("click", "#hapus", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: 'Anda yakin untuk menghapus ini ?',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: "{!! url('inventaris/delete/"+id+"') !!}",
                            type: "GET",
                            dataType: "JSON",
                            cache: false,
                            success: function(response) {
                                if (response.status) {
                                    swal({
                                        icon: 'success',
                                        title: response.message,
                                    }).then(function() {
                                        table.ajax.reload();
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
                    nama_barang: {
                        required: true,
                    },
                    tahun_masuk: {
                        required: true,
                    },
                    jumlah: {
                        required: true,
                        number: true,
                        min: 1,
                    },
                    keadaan: {
                        required: true,
                    },
                    sumber: {
                        required: true,
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
                            url: "{{ route('inventaris') }}",
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
                                        table.ajax.reload();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                    }).then(function() {
                                        table.ajax.reload();
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
                    } else {
                        $.ajax({
                            url: "{{ route('inventaris.update') }}",
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
                                        table.ajax.reload();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                    }).then(function() {
                                        table.ajax.reload();
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
