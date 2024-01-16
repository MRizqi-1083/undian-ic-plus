@extends('layouts.index')
@section('header')
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">

            <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" data-bs-toggle="modal"
                data-bs-target="#userModal">
                <i class="la la-plus"></i>
                Create User
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="card pageCard">
        <div class="card-header pt-4 bg-white">
            <div class="row">

                <!-- Left toolbar -->
                <div class="col-md-6 d-flex gap-1 align-items-center ">
                    <div class="btn-group">
                        <a class="getReload" href="{{ url('users/list') }}"><button class="btn btn-icon btn-outline-light text-muted p-1"><i
                                    class="la la-sync fs-5"></i></button></a>

                    </div>
                </div>
                <!-- END : Left toolbar -->

                <!-- Right Toolbar -->
                <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end ">
                    <div class="form-group d-flex">
                        <input type="text" placeholder="Cari..." class="form-control caridata" autocomplete="off"
                            value="<?=$user?>"><button
                            class="btn btn-icon btn-bg-purple btn-sm p-1 ml-1 klikcari"><i
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
                            <th>Nama / Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $u)
                            <tr>
                                <td><img src="{{ Avatar::create(strtoupper($u->person_name))->setDimension(32)->setFontSize(16)->toBase64() }}"
                                        class="mr-2 va-none">
                                    <a class="btn-link ml-1 d-inline-block" href="#">
                                        <span class="fw-bold text-dark">{{ $u->person_name }}</span><br>
                                        <span class="text-muted fs-9">{{ $u->person_email }}</span>
                                    </a>
                                </td>
                                <td class="align-middle">{{ $u->person_phone }}</td>
                                <td class="align-middle {{ $u->person_role == 'admin' ? 'fw-bold text-dark' : '' }}">
                                    {{ $u->person_role == 'admin' ? 'Administrator' : 'Registered User' }}</td>
                                <td class="fs-6 align-middle">
                                    <div class="badge d-block bg-success">{{ $u->person_status }}</div>

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
                                                        User</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" tipe="change"><i
                                                            class="la la-key"></i> Change
                                                        Password</a></li>
                                                {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                                                <textarea class="d-none datanya">{{ $u }}</textarea>
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
                            <h6 class="row">Create User</h6>
                            <form id="createUser" class="mt-2" action="{{ url('/users/create') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <label class="row text-dark fw-bolder">Photo Profile</label>
                                <div class="row form-upload row-cols-5 justify-content-center no-border">
                                    <div class="col field-upload-center form-upload-mini"><img class="img-upload photo"
                                            src="{{ asset('img/placeholder.png') }}" alt="Profile Picture"
                                            loading="lazy"><input type="file" class="d-none" name="photo">
                                        <input type="hidden" class="photo_link" name="photo_link">
                                    </div>
                                    <p class="text-muted fs-12px w-100 text-center mt-2">*Photo profile resolusi 120
                                        <i>pixel</i>
                                        x 120 <i>pixel</i>
                                    </p>
                                </div> --}}
                                <label class="row mt-3 text-dark fw-bolder">Detil User</label>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_nama_lengkap" class="form-label">Nama
                                            Lengkap</label>
                                        <input id="field_nama_lengkap" type="text" name="nama_user"
                                            class="form-control person_name">
                                        <input type="hidden" class="person_id" name="person_id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_email" class="form-label">Email</label>
                                        <input id="field_email" type="email" name="email"
                                            class="form-control person_email">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_phone" class="form-label">Nomor HP</label>
                                        <input id="field_phone" type="number" name="phone"
                                            class="form-control person_phone">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_role" class="form-label">Role</label>
                                        <select id="field_role" name="role" class="form-control person_role">
                                            <option value="" selected="selected">Pilih Role</option>
                                            <option value="user">Registered User</option>
                                            <option value="admin">Administrator</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="pwd-edit">
                                <div class="row mt-3 pwd-edit">
                                    <div class="col-md-6 p-0 pr-2">
                                        <label for="field_password" class="form-label">Password</label>
                                        <input id="field_password" name="password" type="password"
                                            class="form-control ">
                                    </div>

                                    <div class="col-md-6 p-0 pl-2">
                                        <label for="field_kpassword" class="form-label">Konfirmasi Password</label>
                                        <input id="field_kpassword" name="kpassword" type="password"
                                            class="form-control">
                                    </div>

                                </div>
                                <hr class="pwd-edit">

                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_status" class="form-label">Status</label>
                                        <select id="field_status" name="status" class="form-control person_status">
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
                                            Save User
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

    <div class="modal" id="userPassModal">
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
                            <h6 class="row">Change Password User</h6>
                            <form id="changePassUser" class="mt-2" action="{{ url('/users/change') }}"
                                method="POST">
                                @csrf
                                <label class="row mt-3 text-dark fw-bolder">Password User</label>

                                <div class="row mt-3 ">
                                    <div class="col-md-12 p-0">
                                        <label for="field_cpassword" class="form-label">Password</label>
                                        <input id="field_cpassword" name="password" type="password"
                                            class="form-control ">
                                    </div>
                                </div>
                                <div class="row mt-3 ">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_ckpassword" class="form-label">Konfirmasi Password</label>
                                        <input id="field_ckpassword" name="kpassword" type="password"
                                            class="form-control">
                                    </div>

                                </div>
                                <hr>
                                <input type="hidden" class="person_id" name="person_id">
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 text-center">
                                        <button type="button" class="btn btn-bg-red btn-sm hstack gap-2"
                                            data-bs-dismiss="modal">
                                            <i class="la la-close"></i>
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-bg-purple btn-sm hstack gap-2">
                                            <i class="la la-save"></i>
                                            Save Password
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
                        window.location.href = $(".getReload").attr("href") + "/" + $(".caridata")
                            .val();
                    }
                    ev.handler = true;
                }
            });

            $.validator.addMethod("emailfull", function(value, element) {
                return this.optional(element) ||
                    /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i
                    .test(value);
            }, "Email format not valid.");
            var validator = $("form#createUser").validate({
                rules: {
                    nama_user: {
                        required: true,
                        maxlength: 250,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        emailfull: true
                    },
                    phone: {
                        digits: true,
                        maxlength: 15,
                        minlength: 10,
                        required: true,
                    },
                    password: {
                        minlength: 4,
                        required: $("input[name=person_id]").val() == null,
                    },
                    role: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    kpassword: {
                        required: $("input[name=person_id]").val() == null,
                        equalTo: "#field_password"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#userModal").on('hidden.bs.modal', function() {
                $("form#createUser").attr("action", "{{ url('/users/create') }}");
                $(this).find("h6").text("Create User");
                // $(".img-upload").attr("src", "{{ asset('img/placeholder.png') }}");
                validator.resetForm();
                $(".pwd-edit").show();
                $("form#createUser").trigger('reset');
            });



            $("table tbody tr").on("click", "td .toolbar-end .dropdown ul li", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    const btn = $(this).find("a").attr("tipe");
                    const data = $(this).parent("ul").find("textarea.datanya").val();
                    const detil = JSON.parse(data);
                    if (btn == "edit") {
                        $("#userModal").find("h6").text("Edit User");
                        $(".pwd-edit").hide();
                        $.each(detil, function(k, v) {
                            $("form#createUser ." + k).val(v);
                        });
                        $("form#createUser").attr("action", "{{ url('/users/update') }}");
                        $("#userModal").modal("show");
                    } else {
                        $("form#changePassUser input.person_id").val(detil.person_id);
                        $("#userPassModal").modal("show");
                    }
                    ev.handler = false;
                }
            });

            var validator2 = $("form#changePassUser").validate({
                rules: {
                    password: {
                        minlength: 4,
                        required: true,
                    },
                    kpassword: {
                        required: true,
                        equalTo: "#field_cpassword"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#userPassModal").on('hidden.bs.modal', function() {
                validator2.resetForm();
                $("form#changePassUser").trigger('reset');
            });

        });
    </script>
@endsection
