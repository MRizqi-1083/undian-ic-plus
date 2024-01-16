@extends('layouts.index')
@section('header')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/b-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
    <style type="text/css">
        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: auto;
            display: inline-block;
        }

        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
        }

        .dataTables_filter label {
            margin-right: 5px;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
        }
    </style>
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemenang Doorprize / Grandprize</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">

            {{-- <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" data-bs-toggle="modal"
                data-bs-target="#userModal">
                <i class="la la-plus"></i>
                Create User
            </button> --}}
        </div>
    </div>
@endsection

@section('content')
    <div class="card pageCard">
        <div class="card-header pt-4 bg-white">
            <div class="row">



            </div>
        </div>

        <div class="card-body pt-1">
            <div class="table-responsove">
                <table class="table table-striped table-bordered table-hover" id="winner">
                    <thead>
                        <tr>
                            <th>No Peserta</th>
                            <th>Nama</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Hadiah</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.12.1/b-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script>
        $(function() {

            $('#winner').DataTable({
                ajax: 'data',
                columns: [{
                        data: 'peserta_no'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'prize_id'
                    },
                    {
                        data: 'winner_status'
                    },
                    {
                        data: 'winner_id',
                        width: 50,
                        render: function(id) {
                            return '<button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" id="verifikasi"><i class="la la-plus"></i>Verifikasi</button>';
                        }
                    },
                ],
            });

            $("#winner tbody").on("click", function(k) {
                k.preventDefault();
                if (k.handler != true) {
                    var $dt = $("#winner").DataTable().row($(this).closest("tr")).data();
                    $.post("verifikasi", {

                    });
                    k.handler = true
                }
            });

        });
    </script>
@endsection
