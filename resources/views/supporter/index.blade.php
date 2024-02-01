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
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
{{--                                        @if(auth()->user()->level != 'supporter')--}}
{{--                                            <th>Email</th>--}}
{{--                                            <th>level</th>--}}
{{--                                        @endif--}}
                                        <th>Tanggal Lahir</th>
                                        <th>Umur</th>
{{--                                        @if(auth()->user()->level != 'supporter')--}}
{{--                                            <th>No Hp</th>--}}
{{--                                        @endif--}}
                                        <th>Alamat</th>
                                        @if (auth()->user()->level != 'supporter')
                                            <th>Status</th>
                                        @endif
                                        @if (auth()->user()->level == 'admin')
                                            <th>Opsi</th>
                                        @endif
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
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
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
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Level</label>
                                <select class="form-control" name="level" id="level">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="supporter">Supporter</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div class="form-group col-12">
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
{{--    <script>--}}
{{--        var config = [--}}
{{--            {--}}
{{--                data: 'id',--}}
{{--                render: function(data, type, row, meta) {--}}
{{--                    return meta.row + meta.settings._iDisplayStart + 1;--}}
{{--                },--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'avatar',--}}
{{--                render: function(data, type, row, meta) {--}}
{{--                    if (row.avatar == '') {--}}
{{--                        return '<i class="fas fa-user-circle fa-5x" aria-hidden="true"></i>';--}}
{{--                    } else {--}}
{{--                        return '<img src="profile/' + row.avatar +--}}
{{--                            '" alt="..." class = "img-fluid rounded-circle" > ';--}}
{{--                    }--}}
{{--                },--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'nama',--}}
{{--                name: 'nama'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'email',--}}
{{--                name: 'email'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'level',--}}
{{--                name: 'level'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'tanggal_lahir',--}}
{{--                name: 'tanggal_lahir'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'usia',--}}
{{--                name: 'usia'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'nohp',--}}
{{--                name: 'nohp'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'alamat',--}}
{{--                name: 'alamat'--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'status',--}}
{{--                render: function(data, type, row, meta) {--}}
{{--                    var btn = '';--}}
{{--                    if (row.status) {--}}
{{--                        btn =--}}
{{--                            '<button class="btn btn-primary btn-round btn-xs">Aktif</button>';--}}
{{--                    } else {--}}
{{--                        btn =--}}
{{--                            '<button class="btn btn-danger btn-round btn-xs">Tidak Aktif</button>';--}}
{{--                    }--}}
{{--                    return btn;--}}
{{--                },--}}
{{--            },--}}
{{--            {--}}
{{--                data: 'id',--}}
{{--                orderable: false,--}}
{{--                searchable: false,--}}
{{--                render: function(data, type, row, meta) {--}}
{{--                    var btn = '<div class="btn-group" role="group">';--}}
{{--                    btn += '<button data-id="' + row.id +--}}
{{--                        '" class="btn btn-round btn-icon btn-success btn-sm" id="edit"><i class="fa fa-edit"></i></button>';--}}
{{--                    btn += '</div>';--}}
{{--                    return btn;--}}
{{--                },--}}
{{--            }--}}
{{--        ];--}}
{{--    </script>--}}

    <script>
        var config = [
            {
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: 'avatar',
                render: function(data, type, row, meta) {
                    if (row.avatar == '') {
                        return '<i class="fas fa-user-circle fa-5x" aria-hidden="true"></i>';
                    } else {
                        return '<img src="profile/' + row.avatar +
                            '" alt="..." class = "img-fluid rounded-circle" > ';
                    }
                },
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'tanggal_lahir',
                name: 'tanggal_lahir'
            },
            {
                data: 'usia',
                name: 'usia'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
        ];
    </script>
    @if (auth()->user()->level != 'supporter')
        <script>
            config.push({
                data: 'status',
                render: function(data, type, row, meta) {
                    var btn = '';
                    if (row.status) {
                        btn =
                            '<button class="btn btn-primary btn-round btn-xs">Aktif</button>';
                    } else {
                        btn =
                            '<button class="btn btn-danger btn-round btn-xs">Tidak Aktif</button>';
                    }
                    return btn;
                },
            });
        </script>

        @if (auth()->user()->level == 'admin')
            <script>
                config.push({
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        var btn = '<div class="btn-group" role="group">';
                        btn += '<button data-id="' + row.id +
                            '" class="btn btn-round btn-icon btn-success btn-sm" id="edit"><i class="fa fa-edit"></i></button>';
                        btn += '</div>';
                        return btn;
                    },
                });
            </script>
        @endif
    @endif
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function() {
            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('datasupporter') }}",
                columns: config,
            });

            {{--if ("{{ auth()->user()->level }}" != "admin") {--}}
            {{--    table.column(10).visible(false);--}}
            {{--}--}}
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
                    url: "{{ url('datasupporter/edit') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        $('#modal form').find('#nama').val(data.nama);
                        $('#modal form').find('#email').val(data.email);
                        $('#modal form').find('#level').val(data.level).change();
                        document.getElementById("tanggal").valueAsDate = new Date(data
                            .tanggal_lahir);
                        $('#modal form').find('#nohp').val(data.nohp);
                        $('#modal form').find('#alamat').val(data.alamat);

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
                    password: {
                        required: function() {
                            return ($('form').find('#id').val() == "");
                        },
                        minlength: 5
                    },
                    password_confirm: {
                        required: function() {
                            return ($('form').find('#id').val() == "");
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
                    var id = $(form).find('#id').val();
                    if (id == "") {
                        $.ajax({
                            url: "{{ route('datasupporter') }}",
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
                                        $('#modal').modal('hide');
                                        table.ajax.reload();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                        showCancelButton: false,
                                        showConfirmButton: true
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
                            url: "{{ route('datasupporter.update') }}",
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
                                        $('#modal').modal('hide');
                                        table.ajax.reload();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                        showCancelButton: false,
                                        showConfirmButton: true
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
