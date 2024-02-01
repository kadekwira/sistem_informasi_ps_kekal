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
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-coins text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-9 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category font-weight-bold">Keuangan Club (KAS)
                                                        </p>
                                                        <h4 class="card-title" id="totalsisa">Rp
                                                            {{ number_format($totalsisa, 2, ',', '.') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Dana Masuk</th>
                                        <th>Dana Keluar</th>
                                        <th>Sisa</th>
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
                                <label for="">Subjek</label>
                                <input type="text" name="subjek" id="subjek" class="form-control">
                                <input type="hidden" name="id" id="id" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Harga Satuan</label>
                                <input type="text" name="harga_satuan" id="harga_satuan" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Nominal</label>
                                <input type="text" name="nominal" id="nominal" class="form-control">
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
            var p = parseFloat(num).toFixed(2).split(".");
            return "Rp " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                return num + (i && !(i % 3) ? "." : "") + acc;
            }, "") + "," + p[1];
        }

        $(document).ready(function() {
            $('#nominal,#harga_satuan').mask("#.##0", {
                reverse: true
            });

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
                ajax: "{{ route('danasaatini') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
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
                        data: 'totalmasuk',
                        render: function(data, type, row, meta) {
                            return formatMoney(row.totalmasuk);
                        }
                    },
                    {
                        data: 'totalkeluar',
                        render: function(data, type, row, meta) {
                            return formatMoney(row.totalkeluar);
                        }
                    },
                    {
                        data: 'sisa',
                        render: function(data, type, row, meta) {
                            return formatMoney(row.sisa);
                        }
                    },
                ],
            });

            $('#bulan').on('change', function() {
                var bulan = ($(this).val() == '' ? "null" : $(this).val());
                var bulan2 = $(this).val();
                var tahun = $('#tahun').val();
                // $.get("{!! url('dana/totalsisa/"+tahun+"/"+bulan+"') !!}", {},
                //     function(data, textStatus, jqXHR) {
                //         $('#totalsisa').text(formatMoney(data[0].sisa));
                //     },
                // );
                table.column(1).search(bulan2).draw();
            });

            $('#tahun').on('change', function() {
                var tahun = $(this).val();
                var bulan = ($('#bulan').val() == '' ? "null" : $('#bulan').val());
                // $.get("{!! url('dana/totalsisa/"+tahun+"/"+bulan+"') !!}", {},
                //     function(data, textStatus, jqXHR) {
                //         $('#totalsisa').text(formatMoney(data[0].sisa));
                //     },
                // );
                table.column(2).search(tahun).draw();
            });

            if ("{{ auth()->user()->level }}" != "admin") {
                table.column(1).visible(false);
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
                    url: "{{ route('dana.edit') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'id': id,
                        'type': 'keluar'
                    },
                    cache: false,
                    success: function(data) {
                        $('#modal form').find('#subjek').val(data.subjek);
                        $('#modal form').find('#jumlah').val(data.jumlah);
                        $('#modal form').find('#tanggal').val(data.tanggal);
                        $('#modal form').find('#harga_satuan').val(data.harga_satuan).mask(
                            "#.##0", {
                                reverse: true
                            }).trigger('keyup');
                        $('#modal form').find('#nominal').val(data.nominal).mask("#.##0", {
                            reverse: true
                        }).trigger('keyup');
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
                    jumlah: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    tanggal: {
                        required: true,
                    },
                    harga_satuan: {
                        required: true,
                    },
                    nominal: {
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
                            url: "{{ route('dana', ['type' => 'keluar']) }}",
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
                            url: "{{ route('dana.update', ['type' => 'keluar']) }}",
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
