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
                                Tambah Jadwal
                            </button>
                        @endif
                        <ul class="nav nav-pills nav-warning nav-pills-no-bd mt-3" id="pills-tab-without-border"
                            role="tablist">
                            <li class="nav-item submenu">
                                <a class="nav-link pt-1 pb-1 active show" id="pills-home-tab-nobd" data-toggle="pill"
                                    href="#pills1" role="tab" aria-controls="pills1" aria-selected="true">Jadwal</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link pt-1 pb-1" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills2"
                                    role="tab" aria-controls="pills2" aria-selected="false">Pengumuman</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade active show" id="pills1" role="tabpanel"
                                aria-labelledby="pills-home-tab-nobd">
                                <div class="table-responsive mt-2">
                                    <table class="table table-hover table-bordered table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pertandingan</th>
                                                <th>H/A</th>
                                                <th>Hari</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Lapangan</th>
                                                <th>Skor</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills2" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                <div class="table-responsive mt-2">
                                    <table class="table table-hover table-bordered table-striped" id="table2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Isi Pengumuman</th>
                                                <th>Hari</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
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
                            <div class="form-group col-12 col-sm-12">
                                <label for="">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="pengumuman">Pengumuman</option>
                                    <option value="jadwal">Jadwal</option>
                                </select>
                            </div>
                        </div>
                        <div id="d-pengumuman" class="d-none row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Jadwal</label>
                                <input type="datetime-local" name="jadwal2" id="jadwal2" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-12">
                                <label for="">Isi Pengumuman</label>
                                <textarea name="text" id="text" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div id="d-jadwal" class="d-none row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Team 1</label>
                                <input type="text" name="team1" id="team1" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Team 2</label>
                                <input type="text" name="team2" id="team2" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Logo Team 1</label>
                                <input type="file" name="logo1" id="logo1" class="form-control" accept="image/*"
                                    onchange="loadFile(event)">
                                <img id="output1" class="img-fluid w-75 d-block mr-auto ml-auto p-3" />
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Logo Team 2</label>
                                <input type="file" name="logo2" id="logo2" class="form-control" accept="image/*"
                                    onchange="loadFile(event)">
                                <img id="output2" class="img-fluid w-75 d-block mr-auto ml-auto p-3" />
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">H/A</label>
                                <input type="text" name="home_away" id="home_away" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Jadwal</label>
                                <input type="datetime-local" name="jadwal" id="jadwal" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Lapangan</label>
                                <input type="text" name="lapangan" id="lapangan" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Skor</label>
                                <input type="text" name="skor" id="skor" class="form-control">
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
            var a = (event.target.id == "logo1") ? 'output1' : 'output2';
            var output = document.getElementById(a);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('jadwal') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'team1',
                        render: function(data, type, row, meta) {
                            return row.team1 + ' <strong>vs</strong> ' + row.team2;
                        },
                    },
                    {
                        data: 'home_away',
                        name: 'home_away'
                    },
                    {
                        data: 'hari',
                        name: 'hari'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'lapangan',
                        name: 'lapangan'
                    },
                    {
                        data: 'skor',
                        name: 'skor'
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

            var table2 = $('#table2').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('pengumuman') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'text',
                        name: 'text'
                    },
                    {
                        data: 'hari',
                        name: 'hari'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
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
                table.column(8).visible(false);
                table2.column(5).visible(false);
            }

            $('#type').change(function(e) {
                e.preventDefault();
                var v = $(this).val();
                if (v == 'pengumuman') {
                    $('#d-pengumuman').removeClass('d-none');
                    $('#d-jadwal').removeClass('d-block').addClass('d-none');
                } else {
                    $('#d-jadwal').removeClass('d-none');
                    $('#d-pengumuman').removeClass('d-block').addClass('d-none');
                }
            });

            // open modal tambah
            $('#tambah').click(function(e) {
                e.preventDefault();
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Tambah');
                $('#type').closest('.form-group').show();

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
                $('#modal form').find('[id*="output"]').attr('src', '');
                $('#d-pengumuman').removeClass('d-block').addClass('d-none');
                $('#d-jadwal').removeClass('d-block').addClass('d-none');
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
                    url: "{{ url('jadwals/edit') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        $('#type').closest('.form-group').hide();
                        $('#d-jadwal').removeClass('d-none');
                        $('#d-pengumuman').removeClass('d-block').addClass('d-none');
                        // show data
                        $('#modal form').find('#team1').val(data.team1);
                        $('#modal form').find('#team2').val(data.team2);
                        $('#modal form').find('#home_away').val(data.home_away);
                        const now = (new Date(data.jadwal).toLocaleString("sv-SE") + '')
                            .replace(' ', 'T');
                        $('#modal form').find('#jadwal').val(now);
                        $('#modal form').find('#lapangan').val(data.lapangan);
                        $('#modal form').find('#skor').val(data.skor);
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

            table2.on("click", "#edit", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Edit');
                $('#modal form').find('#id').val(id);
                $.ajax({
                    url: "{{ url('jadwals/edit') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        $('#type').closest('.form-group').hide();
                        if (data.type == 'pengumuman') {
                            $('#d-pengumuman').removeClass('d-none');
                            $('#d-jadwal').removeClass('d-block').addClass('d-none');
                            // show data
                            $('#modal form').find('#text').val(data.text);
                            const now = (new Date(data.jadwal).toLocaleString("sv-SE") + '')
                                .replace(' ', 'T');
                            $('#modal form').find('#jadwal2').val(now);
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
                            url: "{!! url('jadwals/delete/"+id+"') !!}",
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

            table2.on("click", "#hapus", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: 'Anda yakin untuk menghapus ini ?',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: "{!! url('jadwals/delete/"+id+"') !!}",
                            type: "GET",
                            dataType: "JSON",
                            cache: false,
                            success: function(response) {
                                if (response.status) {
                                    swal({
                                        icon: 'success',
                                        title: response.message,
                                    }).then(function() {
                                        table2.ajax.reload();
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
                    type: {
                        required: true,
                    },
                    text: {
                        required: true,
                    },
                    team1: {
                        required: true,
                    },
                    team2: {
                        required: true,
                    },
                    logo1: {
                        required: function() {
                            return ($('form').find('#id').val() == "");
                        },
                    },
                    logo2: {
                        required: function() {
                            return ($('form').find('#id').val() == "");
                        },
                    },
                    home_away: {
                        required: true,
                    },
                    jadwal: {
                        required: true,
                    },
                    jadwal2: {
                        required: true,
                    },
                    lapangan: {
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
                            url: "{{ route('jadwal') }}",
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
                                        table2.ajax.reload();
                                    });
                                } else {
                                    swal({
                                        icon: 'error',
                                        title: response.message,
                                    }).then(function() {
                                        table.ajax.reload();
                                        table2.ajax.reload();
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
                            url: "{{ route('jadwal.update') }}",
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
