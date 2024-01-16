@extends('layouts.index')
@section('header')
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item">Manage Events</li>
                    <li class="breadcrumb-item active" aria-current="page">Hadiah</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">

            <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" data-bs-toggle="modal"
                data-bs-target="#prizeModal">
                <i class="la la-plus"></i>
                Create Hadiah
            </button>
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
                        <a href="{{ url('users/list') }}"><button class="btn btn-icon btn-outline-light text-muted p-1"><i
                                    class="la la-sync fs-5"></i></button></a>
                        <button class="btn btn-icon btn-outline-light text-muted p-1"><i
                                class="la la-print fs-5"></i></button>
                        <button class="btn btn-icon btn-outline-light text-muted p-1"><i
                                class="la la-file-download fs-5"></i></button>
                    </div>
                </div>
                <!-- END : Left toolbar -->

                <!-- Right Toolbar -->
                <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end ">
                    <div class="form-group">
                        <input type="text" placeholder="Cari..." class="form-control" autocomplete="off">
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
                            <th>Hadiah</th>
                            <th>Deskripsi</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $a)
                            <tr>
                                <td>
                                    {{ $a->prize_name }}
                                </td>
                                <td>
                                    {{ $a->prize_desc }}
                                </td>
                                <td class="text-right">
                                    {{ $a->prize_quota }}
                                </td>
                                <td class="fs-6 align-middle">
                                    <div class="badge d-block bg-success">{{ $a->prize_status }}</div>
                                </td>
                                <td class="text-right align-middle">
                                    <div class="toolbar-end">
                                        <div class="dropdown">
                                            <a class="btn btn-icon p-1 btn-xs" href="javascript:void(0);" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="las la-ellipsis-h"></i></a>

                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li><a class="dropdown-item" href="javascript:void(0);" tipe="edit"><i
                                                            class="la la-edit"></i> Edit
                                                        Prize</a></li>
                                                {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                                                <textarea class="d-none datanya">{{ $a }}</textarea>
                                            </ul>
                                        </div>
                                    </div>
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
    <div class="modal" id="prizeModal">
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
                            <h6 class="row">Create Prize</h6>
                            <form id="createPrize" class="mt-2" action="{{ url('/hadiah/create') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label class="row mt-3 text-dark fw-bolder">Detil Hadiah</label>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_prize_name" class="form-label">Nama
                                            Hadiah</label>
                                        <input id="field_prize_name" type="text" name="prize_name"
                                            class="form-control prize_name">
                                        <input type="hidden" class="prize_id" name="prize_id">
                                        <input type="hidden" class="acara_id" name="acara_id"
                                            value="{{ $id }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_prize_desc" class="form-label">Deskripsi
                                            Hadiah</label>
                                        <input id="field_prize_desc" type="text" name="prize_desc"
                                            class="form-control prize_desc">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_prize_jenis" class="form-label">Jenis Undian Hadiah</label>
                                        <select id="field_prize_jenis" name="prize_jenis"
                                            class="form-control prize_jenis">
                                            <option value="" disabled selected>Pilih Jenis Undian Hadiah</option>
                                            <option value="single">Single</option>
                                            <option value="group">Group</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_prize_quota" class="form-label">Kuota</label>
                                        <input id="field_prize_quota" type="number" name="prize_quota"
                                            class="form-control prize_quota">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_status" class="form-label">Status</label>
                                        <select id="field_status" name="prize_status" class="form-control prize_status">
                                            <option value="" selected="selected">Pilih Status</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="non-aktif">Non Aktif</option>
                                        </select>
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
                                            Save Prize
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
            var validator = $("form#createPrize").validate({
                rules: {
                    prize_name: {
                        required: true,
                        maxlength: 250,
                        minlength: 4
                    },
                    prize_quota: {
                        digits: true,
                        maxlength: 3,
                        minlength: 1,
                        required: true,
                    },
                    prize_jenis: {
                        required: true,
                    },
                    prize_desc: {
                        required: true,
                    },
                    prize_status: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#prizeModal").on('hidden.bs.modal', function() {
                $("form#createPrize").attr("action", "{{ url('/hadiah/create') }}");
                $(this).find("h6").text("Create Prize");
                // $(".img-upload").attr("src", "{{ asset('img/placeholder.png') }}");
                validator.resetForm();
                $("form#createPrize").trigger('reset');
            });



            $("table tbody tr").on("click", "td .toolbar-end .dropdown ul li", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    const btn = $(this).find("a").attr("tipe");
                    const data = $(this).parent("ul").find("textarea.datanya").val();
                    const detil = JSON.parse(data);
                    if (btn == "edit") {
                        $("#prizeModal").find("h6").text("Edit Prize");
                        $.each(detil, function(k, v) {
                            $("form#createPrize ." + k).val(v);
                        });
                        $("form#createPrize").attr("action", "{{ url('/hadiah/update') }}");
                        $("#prizeModal").modal("show");
                    }
                    ev.handler = false;
                }
            });

        });
    </script>
@endsection
