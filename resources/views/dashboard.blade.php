@extends('layouts.app')

@section('title', 'Dashboard admin')

@section('content')
    <div class="panel-header bg-white">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="pb-2 fw-bold">Dashboard</h2>
                    <h5 class="mb-2">Selamat Datang {{ Str::ucfirst(auth()->user()->level) }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-12 col-md-6">
                <div class="card full-height" style="background-color: #1470e5;">
                    <div class="card-header">
                        <div class="card-title text-white"><i class="fas fa-calendar-alt pr-2" aria-hidden="true"></i>
                            Jadwal
                            Pertandingan Bulan Ini</div>
                    </div>
                    <div class="card-body">
                        @if (count($jadwal))
                            <ol class="activity-feed text-white">
                                @foreach ($jadwal as $item)
                                    <li class="feed-item feed-item-danger">
                                        <time class="date text-white"
                                            datetime="9-25">{{ date('M d', strtotime($item->jadwal)) }} |
                                            {{ date('H:i', strtotime($item->jadwal)) }}</time>
                                        <div class="row h-100">
                                            <div class="col-4 col-md-5 text text-center my-auto">
                                                <img src="{{ asset('jadwal/' . $item->logo1) }}"
                                                    class="avatar rounded-circle mt-3" alt="">
                                                <p class="font-weight-bold">{{ Str::title($item->team1) }}</p>
                                                <p class="font-weight-bold">
                                                    @php
                                                        if ($item->skor != null) {
                                                            $skor = explode('-', $item->skor);
                                                            echo $skor[0];
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="col-4 col-md-2 text text-center my-auto"><strong> VS
                                                </strong></div>
                                            <div class="col-4 col-md-5 text text-center my-auto">
                                                <img src="{{ asset('jadwal/' . $item->logo2) }}"
                                                    class="avatar rounded-circle mt-3" alt="">
                                                <p class="font-weight-bold">{{ Str::title($item->team2) }}</p>
                                                <p class="font-weight-bold">
                                                    @php
                                                        if ($item->skor != null) {
                                                            $skor = explode('-', $item->skor);
                                                            echo $skor[1];
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="alert alert-warning">
                                <strong>Belum ada jadwal pertandingan</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card full-height" style="background-color: #1470e5;">
                    <div class="card-header">
                        <div class="card-title text-white"><i class="fas fa-bullhorn pr-2" aria-hidden="true"></i>
                            Pengumuman
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($pengumuman))
                            <ol class="activity-feed text-white">
                                @foreach ($pengumuman as $item)
                                    <li class="feed-item feed-item-info">
                                        <time class="date text-white"
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

            @if (auth()->user()->level == 'admin')
                <div class="col-12 col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-title">
                                Setting Info Halaman Depan Website
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="row" id="formInfo">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Type Info</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="berita">Berita</option>
                                        <option value="infopage">Info Page</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="">Link</label>
                                    <input type="text" name="link" id="link" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-8">
                                    <label for="">Text/Caption</label>
                                    <textarea name="text" id="text" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="form-group col-12 col-md-12">
                                    <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Text</th>
                                        <th>Type Info</th>
                                        <th>Link</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
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
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';

            var info = "{{ session('info') }}";
            if (info) {
                var content = {};
                content.message = "{!! session('info') !!}";
                content.title = 'Info';
                content.icon = 'fa fa-bell';
                $.notify(content, {
                    type: 'danger',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    time: 1000,
                    delay: 0,
                });
            }

            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('info') }}",
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
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'link',
                        name: 'link'
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

            // open modal edit
            table.on("click", "#edit", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#formInfo').find('#id').val(id);
                $.ajax({
                    url: "{{ url('info/edit') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        $('#formInfo').find('#type').val(data.type).change();
                        $('#formInfo').find('#link').val(data.link);
                        $('#formInfo').find('#text').val(data.text);
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
                            url: "{!! url('info/delete/"+id+"') !!}",
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
            var validator = $("#formInfo").validate({
                rules: {
                    type: {
                        required: true,
                    },
                    text: {
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
                            url: "{{ route('info') }}",
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
                                        $(form)[0].reset()
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
                            url: "{{ route('info.update') }}",
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
                                        $(form)[0].reset()
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
