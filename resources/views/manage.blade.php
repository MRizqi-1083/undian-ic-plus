@extends('layouts.index')
@section('header')
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Events</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">
            <div class="btn-group">
                <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2 dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="la la-sync"></i> Generate Refferal
                    Code</button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#userModal">Single User</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#multiModal">Multiple User</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="mt-4 d-grid gap-2 d-md-block">
        <a href="{{ url('/events/manage/' . $id) }}"><button
                class="btn {{ $tipe == null ? 'btn-bg-purple' : 'btn-light' }} btn-sm" type="button">Refferal</button></a>
        <a href="{{ url('/events/manage/' . $id . '/agenda') }}"><button
                class="btn {{ $tipe == 'agenda' ? 'btn-bg-purple' : 'btn-light' }} btn-sm ml-2"
                type="button">Agenda</button></a>
        <a href="{{ url('/events/manage/' . $id . '/hadiah') }}"><button
                class="btn {{ $tipe == 'hadiah' ? 'btn-bg-purple' : 'btn-light' }} btn-sm ml-2"
                type="button">Hadiah</button></a>
    </div>

    <div class="card pageCard mt-3">
        <div class="card-header pt-4 bg-white">
            <div class="row">

                <!-- Left toolbar -->
                <div class="col-md-6 d-flex gap-1 align-items-center ">
                    <div class="btn-group">
                        <a class="getReload" href="{{ url('events/manage/' . $id) }}"><button
                                class="btn btn-icon btn-outline-light text-muted p-1"><i
                                    class="la la-sync fs-5"></i></button></a>
                        <a href="{{ url('events/export') }}"><button
                                class="btn btn-icon btn-outline-light text-muted p-1"><i
                                    class="la la-file-download fs-5"></i></button></a>
                    </div>
                </div>
                <!-- END : Left toolbar -->

                <!-- Right Toolbar -->
                <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end ">
                    <div class="form-group d-flex">
                        <input type="text" placeholder="Cari..." class="form-control caridata" autocomplete="off"
                            value="<?= $user ?>"><button class="btn btn-icon btn-bg-purple btn-sm p-1 ml-1 klikcari"><i
                                class="la la-search fs-5"></i></button>
                    </div>
                </div>
                <!-- END : Right Toolbar -->

            </div>
        </div>

        <div class="card-body pt-1">
            <div class="table-responsove">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th width="10%">No Urut Kuota</th>
                            <th width="13%">No HP</th>
                            <th width="10%">Kode Refferal</th>
                            <th width="10%">Tgl Expired</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $a)
                            <tr>
                                <td width="4%" class="text-right">
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    {{ $a->und_nama }}
                                </td>
                                <td class="text-right">
                                    {{ $a->und_kuota_no }}
                                </td>
                                <td>
                                    {{ $a->und_user }}
                                </td>
                                <td>
                                    {{ $a->und_kode }}
                                </td>
                                <td>
                                    {{ $a->und_exp }}
                                </td>
                                <td class="fs-6 align-middle" width=80>
                                    <div
                                        class="badge d-block {{ $a->und_status == 'aktif' ? 'bg-success' : 'bg-danger' }} ">
                                        {{ $a->und_status == 'aktif' ? 'Belum Terpakai' : 'Sudah Terpakai' }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal" id="userModal">
        <div class="modal-dialog modal-fs">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h6 class="row">Generate Refferal Code</h6>
                            <form id="createUser" class="mt-2" action="{{ url('events/manage/generate/individual') }}"
                                method="POST">
                                @csrf
                                <label class="row mt-3 text-dark fw-bolder">Detil User</label>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_usernama" class="form-label">Nama</label>
                                        <input id="field_usernama" type="text" name="nama" class="form-control nama">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_email" class="form-label">Email</label>
                                        <input id="field_email" type="email" name="email"
                                            class="form-control email">
                                        <input type="hidden" name="acara_id" value="{{ $id }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_user" class="form-label">Nomor HP</label>
                                        <input id="field_user" type="text" name="user" class="form-control user">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_kuota" class="form-label">Kuota</label>
                                        <input id="field_kuota" type="number" name="kuota"
                                            value="{{ $acara->acara_max_kuota_per_peserta }}"
                                            max="{{ $acara->acara_max_kuota_per_peserta }}" class="form-control kuota">
                                    </div>
                                </div>
                                <hr>

                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 text-center">
                                        <button type="button" class="btn btn-bg-red btn-sm hstack gap-2"
                                            data-bs-dismiss="modal">
                                            <i class="la la-close"></i>
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-bg-purple btn-sm hstack gap-2">
                                            <i class="la la-save"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="multiModal">
        <div class="modal-dialog modal-fs">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h6 class="row">Generate Refferal Code</h6>
                            <form id="multi" enctype="multipart/form-data" class="mt-2"
                                action="{{ url('events/manage/generate/multiple') }}" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_user" class="form-label">Template Import</label><br>
                                        <a href="{{ asset('template/template-import.xlsx') }}" target="_blank"
                                            class="btn btn-bg-purple btn-sm hstack gap-2"> <i class="la la-download"></i>
                                            Download</a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_kuota" class="form-label">Excel File</label>
                                        <input id="field_file" type="file" name="file" class="form-control ">
                                        <input type="hidden" name="acara_id" value="{{ $id }}">
                                    </div>
                                </div>
                                <hr>

                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 text-center">
                                        <button type="button" class="btn btn-bg-red btn-sm hstack gap-2"
                                            data-bs-dismiss="modal">
                                            <i class="la la-close"></i>
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-bg-purple btn-sm hstack gap-2">
                                            <i class="la la-save"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {

            $(".klikcari").on("click", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    if ($(".caridata").val()) {
                        window.location.href = $(".getReload").attr("href") + "/undangan/" + $(".caridata")
                            .val();
                    }
                    ev.handler = true;
                }
            });
        });
    </script>
@endsection
