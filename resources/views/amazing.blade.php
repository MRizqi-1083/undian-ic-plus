<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PLN ICON Plus Ama22ing Concert</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background: rgb(255, 255, 255);
            background: -moz-linear-gradient(315deg, rgba(255, 255, 255, 1) 0%, rgba(6, 95, 119, 1) 15%, rgba(6, 95, 119, 1) 50%, rgba(6, 95, 119, 1) 85%, rgba(255, 255, 255, 1) 100%);
            background: -webkit-linear-gradient(315deg, rgba(255, 255, 255, 1) 0%, rgba(6, 95, 119, 1) 15%, rgba(6, 95, 119, 1) 50%, rgba(6, 95, 119, 1) 85%, rgba(255, 255, 255, 1) 100%);
            background: linear-gradient(315deg, rgba(255, 255, 255, 1) 0%, rgba(6, 95, 119, 1) 15%, rgba(6, 95, 119, 1) 50%, rgba(6, 95, 119, 1) 85%, rgba(255, 255, 255, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff", endColorstr="#ffffff", GradientType=1);
        }

        .text-left {
            text-align: left !important;
        }

        .modal-backdrop.show {
            opacity: .75 !important;
        }

        .error {
            color: #ffa7a7;
            text-align: left !important;
        }

        .input-group-text {
            color: #4d4e50;
            background-color: #ffffff;
        }

        .input-group input {
            border-right: 0px;
        }

        p.kodeTiket {
            margin-top: -110px;
            position: absolute;
            margin-left: 115px;
            font-size: 24px;
        }

        p.kodeTiketFailed {
            margin-top: -110px;
            position: absolute;
            margin-left: 75px;
            font-size: 15px;
        }

        @media (min-width: 280px) {
            p.kodeTiket {
                margin-top: -85px;
                position: absolute;
                margin-left: 60px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -75px;
                position: absolute;
                margin-left: 55px;
                font-size: 11.5px;
            }
        }

        @media (min-width: 384px) {
            p.kodeTiket {
                margin-top: -85px;
                position: absolute;
                margin-left: 60px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -75px;
                position: absolute;
                margin-left: 55px;
                font-size: 11.5px;
            }
        }


        @media (min-width: 576px) {
            p.kodeTiket {
                margin-top: -85px;
                position: absolute;
                margin-left: 60px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -75px;
                position: absolute;
                margin-left: 55px;
                font-size: 11.5px;
            }
        }


        @media (min-width: 768px) {
            p.kodeTiket {
                margin-top: -110px;
                position: absolute;
                margin-left: 115px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -110px;
                position: absolute;
                margin-left: 75px;
                font-size: 15px;
            }
        }

        @media (min-width: 992px) {
            p.kodeTiket {
                margin-top: -110px;
                position: absolute;
                margin-left: 115px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -110px;
                position: absolute;
                margin-left: 75px;
                font-size: 15px;
            }
        }

        @media (min-width: 1200px) {
            p.kodeTiket {
                margin-top: -110px;
                position: absolute;
                margin-left: 115px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -110px;
                position: absolute;
                margin-left: 75px;
                font-size: 15px;
            }
        }

        @media (min-width: 1400px) {
            p.kodeTiket {
                margin-top: -110px;
                position: absolute;
                margin-left: 115px;
                font-size: 24px;
            }

            p.kodeTiketFailed {
                margin-top: -110px;
                position: absolute;
                margin-left: 75px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white"
                        style="border-radius: 1rem;background-color: #21252917 !important;border:unset !important;">
                        <div class="card-body p-5 text-center">
                            <form id="getTiket">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="{{ asset('img/ama22ing.png') }}" style="width:100%;">
                                    <h4 class="fw-bold mb-2 text-uppercase">Generate Kode Tiket</h4>

                                    <div class="form-outline form-white mb-3 row">
                                        <label class="form-label text-left text-white" for="typeEmailX">Email</label>
                                        <div class="input-group p-0">
                                            <input type="text" id="typeEmailX" name="email" required
                                                class="form-control form-control-sm" />
                                            <span class="input-group-text" id="basic-addon2">@iconpln.co.id</span>
                                        </div>
                                    </div>

                                    <div class="form-outline form-white mb-3 row">
                                        <label class="form-label text-left text-white" for="typeEmailX">Password</label>
                                        <input type="password" id="typeEmailX" name="password" required
                                            class="form-control form-control-sm" />
                                    </div>

                                    <div class="form-outline form-white mb-3 row">
                                        <label class="form-label text-left text-white" for="typePasswordX">No
                                            Handphone</label>
                                        <input type="text" id="typePasswordX" name="phone" required
                                            class="form-control form-control-sm" />
                                    </div>



                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Generate</button>



                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:unset !important;">
                <div class="modal-body">
                    <img src="img/Tiket.png" style="width: -webkit-fill-available;">
                    <p class="kodeTiket"></p>
                    <button class="button btn-secondary btn-small " data-bs-dismiss="modal">X</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="myModalFailed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:unset !important;">
                <div class="modal-body">
                    <img src="img/failed.png" style="width: -webkit-fill-available;">
                    <p class="kodeTiketFailed"></p>
                    <button class="button btn-secondary btn-small " data-bs-dismiss="modal">X</button>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="{{ asset('plugins/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_id.min.js"></script>
<script>
    $(function() {
        $("form#getTiket").validate({
            submitHandler: function(form) {
                $.post("{{ url('gen/undangan') }}", $(form).serialize()).then(
                    function(ret) {
                        if (ret.response.success == true) {
                            $("p.kodeTiket").text(ret.response.data.und_kode);
                            $("#myModal").modal("show");
                        } else {
                            $("p.kodeTiketFailed").html(ret.response.data);
                            $("#myModalFailed").modal("show");
                        }
                    },
                    function(xhr) {
                        $("p.kodeTiketFailed").html("Generate Tiket Gagal");
                        $("#myModalFailed").modal("show");
                    }
                )
            }
        });
    });
</script>

</html>
