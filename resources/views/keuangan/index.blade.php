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
                        <div class="row">
                            @if (auth()->user()->level == 'admin')
                                <div class="form-group col-12 col-sm-2">
                                    <button class="btn btn-success btn-sm" id="tambah">
                                        <span class="btn-label">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Tambah Dana Masuk
                                    </button>
                                </div>
                            @endif
                            <div class="form-group col-12 col-sm-2">
                                <select class="form-control form-control-sm" name="bulan" id="bulan">
                                    @php
                                        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                    @endphp
                                    <option value="" selected>- Semua -</option>
                                    @foreach ($bulan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-2">
                                <select class="form-control form-control-sm" name="tahun" id="tahun">
                                    @php
                                        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                    @endphp
                                    @for ($i = 2024; $i < date('Y') + 20; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Opsi</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Subjek</th>
                                        <th>Sumber</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Penerima</th>
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


        @if (auth()->user()->level == 'admin')
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-title">Log Activitas Dana Masuk</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive mt-2">
                                <table class="table table-hover table-bordered table-striped" id="table2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>User</th>
                                            <th>Tanggal</th>
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
        @endif
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
                                <label for="">Subjek</label>
                                <input type="text" name="subjek" id="subjek" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
                                <input type="hidden" name="type" id="type" class="form-control" value="masuk">
                                <input type="hidden" name="users_id" id="users_id" class="form-control" value="<?= auth()->user()->id?>">
                                
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Sumber</label>
                                <input type="text" name="sumber" id="sumber" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Nominal</label>
                                <input type="text" name="nominal" id="nominal" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Penerima</label>
                                <input type="text" name="penerima" id="penerima" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="">Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
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
    <!-- Jquery Mask -->
    <script src="{{ asset('assets/js/plugin/jquery-mask/mask.min.js') }}"></script>
    <script>
        function ucwords(str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
                return $1.toUpperCase();
            });
        }

        function formatMoney(num) {
            var p = num.toFixed(2).split(".");
            return "Rp " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                return num == "-" ? acc : num + (i && !(i % 3) ? "." : "") + acc;
            }, "") + "," + p[1];
        }

        $(document).ready(function() {
            $('#nominal').mask("#.##0", {
                reverse: true
            });

            $("#tahun_masuk").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            }).on('changeDate', function(e) {
                $(this).datepicker('hide');
            });

            var table = $('#table1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('danamasuk') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
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
                    },
                    {
                        data: 'bukti_pembayaran',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {

                            var html =  '<a href="' + (data != null ? '{{ asset('keuangan') }}/' + data : 'https://lincolnplacemedical.ie/wp-content/uploads/2016/10/orionthemes-placeholder-image.jpg') + '" target="_blank">link</a>'

                            return html;
                        },
                    },
                    {
                        data: 'subjek',
                        name: 'subjek'
                    },
                    {
                        data: 'sumber',
                        name: 'sumber'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                    },
                    {
                        data: 'nominal',
                        render: function(data, type, row, meta) {
                            return formatMoney(row.nominal);
                        }
                    },
                    {
                        data: 'penerima',
                        render: function(data, type, row, meta) {
                            return ucwords(row.penerima);
                        }
                    },
                ],
            });

            var table2 = $('#table2').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('logmasuk') }}",
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
                        data: 'users.nama',
                        name: 'users.nama'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                ],
            });

            $('#bulan').on('change', function() {
                var bulan = $(this).val();
                table.column(4).search(bulan).draw();
            });

            $('#tahun').on('change', function() {
                var tahun = $(this).val();
                table.column(5).search(tahun).draw();
            });

            if ("{{ auth()->user()->level }}" != "admin") {
                table.column(1).visible(false);
            }

            var mode = 'add';

            // open modal tambah
            $('#tambah').click(function(e) {
                e.preventDefault();
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Tambah');

                mode = 'add';
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
            });

            // focus input
            $('#modal').on('shown.bs.modal', function() {
                $(this).find('#nama_paket').focus();
            });

            // open modal edit
            table.on("click", "#edit", function(e) {
                mode = 'edit';
                e.preventDefault();
                var id = $(this).data('id');
                $('#modal').modal('show');
                $('#modal').find('.modal-title').text('Form Edit');
                $('#modal form').find('#id').val(id);
                $.ajax({
                    url: "{{ route('dana.edit') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'id': id,
                        'type': 'masuk'
                    },
                    cache: false,
                    success: function(data) {
                        $('#modal form').find('#subjek').val(data.subjek);
                        $('#modal form').find('#sumber').val(data.sumber);
                        $('#modal form').find('#tanggal').val(data.tanggal);
                        $('#modal form').find('#nominal').val(data.nominal).mask("#.##0", {
                            reverse: true
                        }).trigger('keyup');
                        $('#modal form').find('#penerima').val(data.penerima);
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
                    subjek: {
                        required: true,
                    },
                    sumber: {
                        required: true,
                    },
                    tanggal: {
                        required: true,
                    },
                    nominal: {
                        required: true,
                    },
                    penerima: {
                        required: true,
                    },
                    bukti_pembayaran: {
                        required: function () {
                            return mode == 'add';
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
                    console.log(form);
                    // return;
                    var id = $(form).find('#id').val();
                    if (id == "") {
                        $.ajax({
                            url: "{{ route('dana')}}",
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
                            url: "{{ route('dana.update') }}",
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
