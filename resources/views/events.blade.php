@extends('layouts.index')
@section('header')
    <div class="d-md-flex align-items-end">
        <div class="me-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Family Day</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
            </nav>
            <h2 class="page-title mb-0 mt-2"></h2>

            <p class="lead mb-lg-0"></p>

        </div>
        <div class="flex-grow-1 d-flex flex-wrap justify-content-end align-items-center gap-3">

            <button type="button" class="btn btn-bg-purple btn-sm hstack gap-2" data-bs-toggle="modal"
                data-bs-target="#eventsModal">
                <i class="la la-plus"></i>
                Create Event
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="mt-4 d-grid gap-2 d-md-block">
        <a href="{{ url('/events/list') }}"><button class="btn {{ $tipe == null ? 'btn-bg-purple' : 'btn-light' }} btn-sm"
                type="button">Berlangsung</button></a>
        {{-- <a href="{{ url('/events/list/cs') }}"><button
                class="btn {{ $tipe == 'cs' ? 'btn-bg-purple' : 'btn-light' }} btn-sm ml-2"
                type="button">Segera</button></a>
        <a href="{{ url('/events/list/end') }}"><button
                class="btn {{ $tipe == 'end' ? 'btn-bg-purple' : 'btn-light' }} btn-sm ml-2"
                type="button">Berakhir</button></a> --}}
    </div>
    <div class="row mt-3">
        @foreach ($data as $k => $d)
            <div class="col-sm-6 col-md-4 col-xl-3 mb-3 d-flex align-items-stretch">
                <div class="card data-events " id="{{ $d->acara_id }}" idx="{{ $k }}">
                    <div class="card-body p-0">
                        <div class="text-center position-relative box">
                            <div class="pb-3">
                                <div class="container-img">
                                    @if ($d->acara_banner)
                                        <?php $img = explode(';', $d->acara_banner); ?>
                                        <img class="img-lg bannernya " src="{{ $img[0] }}" alt="Logo Picture"
                                            loading="lazy">
                                    @else
                                        <img class="img-lg bannernya" src="{{ asset('img/logo.png') }}" alt="Logo Picture"
                                            loading="lazy">
                                    @endif
                                </div>
                            </div>
                            <p class="h6 black-text text-left px-2">{{ $d->acara_nama }}</p>
                            <p class="text-muted text-left fs-12 mb-1 px-2"><i
                                    class="la la-stopwatch"></i>{{ $d->acara_mulai }}</p>
                            <p class="text-muted text-left fs-12 mb-0 px-2 pb-3"><i
                                    class="la la-map-marker"></i>{{ $d->acara_lokasi }}</p>
                            <textarea class="d-none datanya">{{ $d }}</textarea>
                        </div>
                        <div class="overlay">
                            <div class="h-100 d-flex gap-2 item-center justify-content-center">
                                <button type="button" class="btn btn-icon btn-outline-light btn-h btn-edit">
                                    <i class="la la-edit fs-5"></i> Edit
                                </button>
                                <a href="{{ url('events/manage/' . $d->acara_id) }}"><button type="button"
                                        class="btn btn-icon btn-outline-light btn-h ">
                                        <i class="la la-youtube icon-lg fs-5"></i> Manage
                                    </button></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
@endsection

@section('modal')
    <div class="modal" id="eventsModal">
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
                            <h6 class="row">Create Event</h6>
                            <form id="createEvents" class="mt-2" action="{{ url('/events/create') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label class="row text-dark fw-bolder">Banner Acara</label>
                                <div class="row form-upload row-cols-5">
                                    <div class="col field-upload-center"><img class="img-upload banner_1"
                                            src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                            loading="lazy"><input type="file" class="d-none" name="banner_1">
                                        <input type="hidden" class="banner_1_link" name="banner_1_link">
                                    </div>
                                    <div class="col field-upload-center"><img class="img-upload banner_2"
                                            src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                            loading="lazy"><input type="file" class="d-none" name="banner_2">
                                        <input type="hidden" class="banner_2_link" name="banner_2_link">
                                    </div>
                                    <div class="col field-upload-center"><img class="img-upload banner_3"
                                            src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                            loading="lazy"><input type="file" class="d-none" name="banner_3">
                                        <input type="hidden" class="banner_3_link" name="banner_3_link">
                                    </div>
                                    <div class="col field-upload-center"><img class="img-upload banner_4"
                                            src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                            loading="lazy"><input type="file" class="d-none" name="banner_4">
                                        <input type="hidden" class="banner_4_link" name="banner_4_link">
                                    </div>
                                    <div class="col field-upload-center"><img class="img-upload banner_5"
                                            src="{{ asset('img/placeholder.png') }}" alt="Banner Picture"
                                            loading="lazy"><input type="file" class="d-none" name="banner_5">
                                        <input type="hidden" class="banner_5_link" name="banner_5_link">
                                    </div>
                                    <p class="text-muted fs-12px w-100 text-center mt-2">*Tambahkan 5
                                        banner
                                        dengan resolusi 640
                                        <i>pixel</i>
                                        x 720 <i>pixel</i>
                                    </p>
                                </div>
                                <label class="row mt-3 text-dark fw-bolder">Detil Acara</label>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_nama_acara" class="form-label">Nama
                                            Acara</label>
                                        <input id="field_nama_acara" type="text" name="nama_acara"
                                            class="form-control acara_nama">
                                        <input type="hidden" class="acara_id" name="acara_id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_sdeskripsi_acara" class="form-label">Deskripsi
                                            Acara</label>
                                        <textarea id="field_sdeskripsi_acara" name="deskripsi_acara" type="text" class="form-control acara_deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_maks_peserta_acara" class="form-label">Max
                                            peserta per
                                            keluarga</label>
                                        <input id="field_maks_peserta_acara" type="number" name="maks_peserta"
                                            class="form-control acara_max_kuota_per_peserta" max=10 min=1>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-md-6 p-0 pr-2">
                                        <label for="field_tgl_mulai_acara" class="form-label">Tgl
                                            Mulai
                                            Acara</label>
                                        <input id="field_tgl_mulai_acara" type="datetime-local" name="tgl_mulai_acara"
                                            class="form-control acara_mulai">
                                    </div>

                                    <div class="col-md-6 p-0 pl-2">
                                        <label for="field_tgl_selesai_acara" class="form-label">Tgl
                                            Selesai Acara</label>
                                        <input id="field_tgl_selesai_acara" type="datetime-local"
                                            name="tgl_selesai_acara" class="form-control acara_selesai">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 p-0 pr-2">
                                        <label for="field_waktu_mulai_checkin" class="form-label">Waktu
                                            Mulai Check-in</label>
                                        <input id="field_waktu_mulai_checkin" type="datetime-local"
                                            name="waktu_mulai_presensi" class="form-control acara_mulai_checkin">
                                    </div>

                                    <div class="col-md-6 p-0 pl-2">
                                        <label for="field_waktu_tutup_checkin" class="form-label">Waktu
                                            Tutup Check-in</label>
                                        <input id="field_waktu_tutup_checkin" type="datetime-local"
                                            name="waktu_selesai_presensi" class="form-control acara_selesai_checkin">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-md-6 p-0 pr-2">
                                        <label for="field_alamat_checkin" class="form-label">Lokasi</label>
                                        <input id="field_alamat_checkin" name="lokasi_acara" type="text"
                                            class="form-control acara_lokasi">
                                    </div>

                                    <div class="col-md-6 p-0 pl-2">
                                        <label for="field_koordinat" class="form-label">Titik
                                            Koordinat</label>
                                        <input id="field_koordinat" name="titik_koordinat" type="text"
                                            class="form-control acara_koordinat">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 p-0 ">
                                        <label for="field_lokasi_acara" class="form-label">Alamat
                                            Lokasi</label>
                                        <input id="field_lokasi_acara" name="alamat_lokasi" type="text"
                                            class="form-control acara_alamat_lokasi">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-md-6 p-0 pr-2">
                                        <label for="field_nama_pic" class="form-label">Nama
                                            Pic</label>
                                        <input id="field_nama_pic" name="nama_pic" type="text"
                                            class="form-control acara_pic">
                                    </div>

                                    <div class="col-md-6 p-0 pl-2">
                                        <label for="field_no_whatsapp" class="form-label">No Whatsapp
                                            PIC</label>
                                        <input id="field_no_whatsapp" name="telp_pic" type="text"
                                            class="form-control acara_whatsapp_pic">
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
                                            Save Event
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

            document.addEventListener('DOMContentLoaded', () => {
                let tooltipList = [...document.querySelectorAll('.add-tooltip')];
                tooltipList.map(function(tooltipEl) {
                    new bootstrap.Tooltip(tooltipEl)
                })
            });

            function readURL(input, el) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(el).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("img.img-upload").on("click", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    const ini = this;
                    $(this).next("input[type=file].d-none").trigger("click");
                    $(this).next("input[type=file].d-none").on("change", function() {
                        readURL(this, ini);
                    });
                    ev.handler = true;
                }
            });

            $("div.card.data-events").on("click", ".btn-edit", function(ev) {
                ev.preventDefault();
                if (ev.handler != true) {
                    const data = $(this).closest("div.card.data-events").find("textarea.datanya").val();
                    const detil = JSON.parse(data);
                    $("#eventsModal").find("h6").text("Edit Event");
                    $.each(detil, function(k, v) {
                        $("form#createEvents ." + k).val(v);
                        if (k == "acara_banner" && v) {
                            const myImage = v.split(";");
                            $.each(myImage, function(key, image) {
                                $("form#createEvents .banner_" + parseInt(key + 1) + "")
                                    .attr("src", image);
                                $("form#createEvents .banner_" + parseInt(key + 1) +
                                    "_link").val(image);
                            });
                        }
                    });
                    $("form#createEvents").attr("action", "{{ url('/events/update') }}");
                    $("#eventsModal").modal("show");
                    ev.handler = false;
                }
            });

            var validator = $("form#createEvents").validate({
                onfocusout: function(element) {
                    let dt;
                    if ($(element).attr('type') == "time") {
                        dt = false;
                    } else {
                        dt = true;
                    }
                    return dt;
                },
                rules: {
                    nama_acara: {
                        required: true,
                        maxlength: 250,
                        minlength: 5
                    },
                    deskripsi_acara: {
                        maxlength: 350,
                        minlength: 5
                    },
                    lokasi_acara: {
                        maxlength: 100,
                        minlength: 5,
                        required: true,
                    },
                    alamat_lokasi: {
                        maxlength: 350,
                        minlength: 5,
                        required: true,
                    },
                    nama_pic: {
                        required: true,
                        maxlength: 250,
                        minlength: 5
                    },
                    telp_pic: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    maks_peserta: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    titik_koordinat: {
                        required: true
                    },
                    tgl_mulai_acara: {
                        required: true
                    },
                    tgl_selesai_acara: {
                        required: true
                    },
                    waktu_mulai_presensi: {
                        required: true
                    },
                    waktu_selesai_presensi: {
                        required: true,
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#eventsModal").on('hidden.bs.modal', function() {
                $("form#createEvents").attr("action", "{{ url('/events/create') }}");
                $(this).find("h6").text("Create Event");
                $(".img-upload").attr("src", "{{ asset('img/placeholder.png') }}");
                validator.resetForm();
                $("form#createEvents").trigger('reset');
            });
        });
    </script>
@endsection
