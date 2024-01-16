<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Family Day Grand Prize</title>


    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/undian/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/undian/dist/jquery.slotmachine.css') }}" type="text/css"
        media="screen" />
    <style>
        @font-face {
            font-family: future;
            src: url('../css/FutureTech.ttf');
        }

        .bg {
            position: fixed;
            top: 0;
            left: 0;

            /* Preserve aspet ratio */
            min-width: 100%;
            min-height: 100%;
            width: -webkit-fill-available;
            z-index: -1;
        }

        .group {
            border-radius: 10px;
            padding: 5px 5px 5px 5px;
            margin-top: 0px;
        }

        .group,
        .lever {
            /* background: -webkit-linear-gradient(top, rgb(188 140 68) 0%, rgb(1 10 51) 50%, rgb(1 23 96) 51%, rgb(2 24 99) 100%); */
        }

        .daftar {
            z-index: 9;
            position: absolute;
            margin-top: 150px;
        }

        .judul {
            font-family: future;
            margin-bottom: 10px;
        }

        .text-white {
            font-weight: 600 !important;
            font-size: 36px;
        }

        .text-muted {
            color: #666e76 !important;
        }

        .text-small {
            font-size: 14px;
        }

        .daftar {
            margin-top: unset;
        }
    </style>


</head>

<body>
    @csrf

    {{-- @if ($no == 11)
        <img class="bg" src="{{ asset('cuan/200.avif') }}" alt="">
    @else --}}
    <img class="bg" src="{{ asset('undian/234567.jpg') }}" alt="">
    {{-- @endif --}}

    <div class="container-fluid vh-100 d-flex justify-content-center p-3">
        <div class="col-12 my-auto justify-content-center row data-undi">
            <div class="row judul">
                <center>
                    <h2 class="namaHadiah text-white">{{ $jdl }}</h2>
                </center>
            </div>
            @for ($k = 0; $k < $jml; $k++)
                @if ($jml < 13)
                    <div class="col-6 px-1 py-1">
                    @elseif ($jml > 12 && $jml < 17)
                        <div class="col-5 px-1 py-1">
                        @elseif ($jml > 16 && $jml < 25)
                            <div class="col-3 px-1 py-1">
                @endif
                <div class="group w-100">
                    <div class="reel" style="width: 99.6%;height:75px;">
                        <div id="planeMachine" style="margin-top:15px;">
                            <span style="font-size: 17px;font-weight: 600;" id="{{ $k }}"></span><br><br>
                            <span style="margin-top: 20px;font-weight:600;font-size:16px"
                                id="{{ $k }}_detil"></span>
                            <span id="{{ $k }}_pst_peserta_id" class="peserta_id"
                                style="display:none;"></span>
                        </div>
                    </div>
                </div>
        </div>
        @endfor
    </div>
    </div>


    {{-- <div class="container-fluid daftar vh-100" style="padding: 2rem !important;">
        <div class="row d-flex justify-content-center mx-auto aligns-items-center  data-undi ">
            <div class="row judul">
                <center>
                    <h2 class="namaHadiah text-white">{{ $jdl }}</h2>
                </center>
            </div>
            @for ($k = 0; $k < $jml; $k++)
                @if ($jml < 13)
                    <div class="col-6 px-1">
                    @elseif ($jml > 12 && $jml < 17)
                        <div class="col-5 px-1">
                        @elseif ($jml > 16 && $jml < 25)
                            <div class="col-3 px-1">
                @endif
                <div class="group w-100">
                    <div class="reel" style="width: 99.6%;height:75px;">
                        <div id="planeMachine" style="margin-top:15px;">
                            <span style="font-size: 17px;font-weight: 600;" id="{{ $k }}"></span><br><br>
                            <span style="margin-top: 20px;font-weight:600;font-size:16px"
                                id="{{ $k }}_detil"></span>
                            <span id="{{ $k }}_pst_peserta_id" class="peserta_id"
                                style="display:none;"></span>
                        </div>
                    </div>
                </div>
        </div>
        @endfor
    </div>
    </div> --}}
    <span class="datanya" style="display:none;"><?php echo json_encode($oke); ?></span>

    <script src="{{ asset('plugins/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/undian/colorr.js') }}"></script>
    <script src="{{ asset('plugins/undian/confetti.js') }}"></script>

    <script>
        function rand() {
            let dt = JSON.parse($("span.datanya").text()).sort(() => Math.random() - 0.5);
            for (var i = 0; i < 100; i++) {
                $("span#" + i).html(dt[i].nama + "<br><span class='text-muted text-small'>" + dt[i].email + "</span>");
                // $("span#" + i + "_detil").text(dt[i].phone);
                $("span#" + i + "_pst_peserta_id").text(dt[i].peserta_id);
                $("span#" + i + "_pst_peserta_id").attr("email", dt[i].email);
                $("span#" + i + "_pst_peserta_id").attr("nama", dt[i].nama);
            }
        }
        var myVar = '';

        function mulai() {
            myVar = setInterval(function() {
                rand()
            }, 100);
        }

        function stop() {
            clearInterval(myVar);
            console.log();
            new confettiKit({
                colors: randomColor({
                    hue: 'blue',
                    count: 18
                }),
                confettiCount: 100,
                angle: 90,
                startVelocity: 50,
                elements: {
                    'confetti': {
                        direction: 'down',
                        rotation: true,
                    },
                    'star': {
                        count: 20,
                        direction: 'down',
                        rotation: true,
                    },
                    'ribbon': {
                        count: 10,
                        direction: 'down',
                        rotation: true,
                    },
                },
                position: 'topLeftRight',
            });

            const formData = new FormData();
            $.each($(".data-undi").find("span.peserta_id"), function(k, v) {
                formData.append("peserta_id[]", $(v).text());
                formData.append("full_name[]", $(v).attr("nama"));
                formData.append("email[]", $(v).attr("email"));
                formData.append("hadiah[]", $(".namaHadiah").text());
            });
            formData.append("_token", $("input[name=_token]").val());
            //             $.post("{{ url('grandprize/setwinner') }}", {
            //     id: $(v).text(),
            //     no: {{ $no }},
            //     _token: $("input[name=_token]").val()
            // })

            $.ajax({
                url: "{{ url('grandprize/setmenang') }}",
                processData: false,
                contentType: false,
                data: formData,
                type: 'post',
            });
        }

        function lanjut(no) {
            if (no < 5) {
                window.location.href = "{{ url('doorprize') }}/" + no;
            } else {
                window.location.href = "{{ url('grandprize') }}";
            }
        }
    </script>




</body>

</html>
