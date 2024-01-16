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
        #starter {
            z-index: 1;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 50px;
            margin-top: -25px;
            margin-left: -150px;
            text-align: center;
            /* font-family: 'Roboto Condensed', sans-serif;
            font-size: 2em;
            font-weight: 600; */
            cursor: pointer;
        }

        /*
        #scene {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 1200px;
            height: 600px;
            overflow: hidden;
            margin-top: -300px;
            margin-left: -600px;
            background: url(/cuan/bgundian.avif) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            box-shadow: 0 0 0 2px white inset;
        } */


        #scene {
            position: fixed;
            /* top: 50%;
            left: 50%; */
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin-top: 0px;
            margin-left: 0px;
            background: url(/cuan/bgundian.avif) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            box-shadow: 0 0 0 2px white inset;
        }


        #curtain {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
        }

        #curtain .left,
        #curtain .right {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            filter: brightness(180%);
            /* background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/950358/curtain.svg"); */
            background-size: cover;
            background-repeat: no-repeat;
        }

        #curtain .left {
            left: 0;
            transform-origin: top right;
        }

        #curtain .right {
            left: 50%;
            transform-origin: top left;
        }

        .ground {
            position: absolute;
            left: 50%;
            top: 133%;
            width: 10000px;
            height: 10000px;
            margin-left: -5000px;
            border-radius: 100%;
            box-shadow: 0 0 100px 100px white;
        }

        h1 {
            position: absolute;
            left: 0px;
            right: 0px;
            top: 0%;
            display: block;
            width: 100%;
            margin-top: 0px;
            margin-left: 0px;
            text-align: center;
            /* font-family: 'Open Sans', sans-serif;
            font-size: 30px; */
            line-height: 40px;
            color: white;
            transform: translateY(-50%) scale(0.75);
            opacity: 0;
        }



        /* **********
 opening
********** */

        /* #scene.expand {
            width: 140%;
            left: -20%;
            margin-left: 0;
            background-color: rgb(32, 32, 32);
            box-shadow: 0 0 0 0 white inset;
            animation-fill-mode: forwards;
            animation-name: expand-scene-horizontaly, expand-scene-verticaly;
            animation-duration: 2.5s, 1.5s;
            animation-timing-function: ease-in-out, ease-in-out;
            animation-delay: 0s, 2.5s;
            animation-iteration-count: 1, 1;
            animation-direction: normal, normal;
        } */
        /*
        #curtain.open .left,
        #curtain.open .right {
            filter: brightness(100%);
        } */

        /* #curtain.open .left {
            animation-fill-mode: forwards;
            animation-name: curtain-opening, left-curtain-opening;
            animation-duration: 2s, 4s;
            animation-timing-function: ease-in-out, ease-in-out;
            animation-delay: 0s, 0s;
            animation-iteration-count: 1, 1;
            animation-direction: normal, normal;
        }

        #curtain.open .right {
            animation-fill-mode: forwards;
            animation-name: curtain-opening, right-curtain-opening;
            animation-duration: 2s, 4s;
            animation-timing-function: ease-in-out, ease-in-out;
            animation-delay: 0s, 0s;
            animation-iteration-count: 1, 1;
            animation-direction: normal, normal;
        } */

        /* #scene.expand .ground {
            animation-fill-mode: forwards;
            animation-name: ground-rising;
            animation-duration: 6s;
            animation-timing-function: ease-out;
            animation-delay: 0s;
            animation-iteration-count: 1;
            animation-direction: normal;
        } */

        #scene.expand h1 {
            top: 50%;
            animation-fill-mode: forwards;
            animation-name: text-zoom, text-fade-in, text-glowing;
            animation-duration: 1s, 1s, 1s;
            animation-timing-function: ease-out, ease-in-out, ease-in-out;
            animation-delay: 1s, 1s, 0s;
            animation-iteration-count: 1, 1, infinite;
            animation-direction: normal, normal, alternate;
        }

        .fade-out {
            animation-fill-mode: forwards;
            animation-name: fade-out;
            animation-duration: 1s;
            animation-timing-function: ease-in;
            animation-delay: 0s;
            animation-iteration-count: 1;
            animation-direction: normal;
        }

        /* **********
 animations
********** */

        @keyframes expand-scene-horizontaly {

            /* 2.5
 s */
            from {
                width: 1200px;
                left: 50%;
                margin-left: -600px;
                background-color: rgb(0, 0, 0);
                box-shadow: 0 0 0 2px white inset;
            }

            to {
                width: 140%;
                left: -20%;
                margin-left: 0;
                background-color: rgb(32, 32, 32);
                box-shadow: 0 0 0 0 white inset;
            }
        }

        @keyframes expand-scene-verticaly {

            /* 1.5s */
            from {
                top: 50%;
                height: 600px;
                margin-top: -300px;
            }

            to {
                top: 0;
                height: 100%;
                margin-top: 0;
            }
        }

        @keyframes curtain-opening {

            /* 2s */
            from {
                filter: brightness(180%);
            }

            to {
                filter: brightness(100%);
            }
        }

        @keyframes left-curtain-opening {

            /* 4s */
            from {
                transform: translate(0) rotate(0) scale(1, 1);
            }

            to {
                transform: translate(-100%) rotate(20deg) scale(0, 2);
            }
        }

        @keyframes right-curtain-opening {

            /* 4s */
            from {
                transform: translate(0) rotate(0) scale(1, 1);
            }

            to {
                transform: translate(100%) rotate(-20deg) scale(0, 2);
            }
        }

        @keyframes ground-rising {
            from {
                top: 133%;
            }

            to {
                top: 105%;
            }
        }

        @keyframes text-zoom {
            from {
                transform: translateY(-50%) scale(0.75);
            }

            to {
                transform: translateY(-50%) scale(1);
            }
        }

        @keyframes text-fade-in {
            from {
                opacity: 0;
                top: 0px
            }

            to {
                opacity: 1;
                top: 50%
            }
        }

        @keyframes text-glowing {
            from {
                text-shadow: 0 0 10px white;
            }

            to {
                text-shadow: 0 0 10px white, 0 0 20px white, 0 0 30px dodgerblue;
            }
        }

        @keyframes fade-out {
            from {
                color: black;
                opacity: 1;
            }

            to {
                color: white;
                opacity: 0;
            }
        }

        img.logo {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        .wuling {
            width: 30%;
            margin-top: -50px;
        }

        .group,
        .lever {
            background: -webkit-linear-gradient(top, rgb(22 34 53) 0%, rgb(17 17 17) 50%, rgb(77 77 77) 51%, rgb(77 85 100) 100%);
            font-size: 60px;
            font-weight: 300;
            line-height: 80px;
        }

        .modal-backdrop.show {
            opacity: .8 !important;
        }

        .ww {
            margin-top: 295px;
            position: absolute;
            width: 425px;
            margin-left: -436px;
            text-align: center;
            height: fit-content;
            line-height: initial;
            font-size: 18px;
            font-weight: 600;
            background-color: rgb(52 52 51);
            text-shadow: 0px 1px 1px #e3bf36;
            color: transparent;
            -webkit-background-clip: text;
        }

        .reel p {
            font-family: monospace;
            font-size: xxx-large;
            font-weight: 600;
        }
    </style>


</head>

<body>
    <div id='starter-x' onclick="showTime()"></div>
    <div id='scene'>
        <div id='curtain'>
            <h1><img src="{{ asset('cuan/ionic.avif') }}" class="wuling" alt="Wuling" style="width:50%;">
            </h1>
            <div class="d-flex justify-content-center mx-auto aligns-items-center position-absolute top-50 start-50 translate-middle"
                style="margin-top:11.3rem">
                <div class="group">
                    <div class="reel" style="width:600px;">
                        <div id="planeMachine">
                            @foreach ($dtnya as $k => $v)
                                <p id="{{ $k }}" pid="{{ $v->peserta_id }}" phone="{{ $v->phone }}"
                                    no="{{ $v->email }}" nama="{{ strtoupper($v->full_name) }}">
                                    {{ strtoupper($v->full_name) }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class='ground'></div>
            <div class='left'></div>
            <div class='right'></div> --}}
        </div>
    </div>


    {{-- <div id="plane">


        <div class="well content" style="top: 0;position: fixed;">
            <div id="sm">
                <div class="group">
                    <div class="reel">
                        <div id="planeMachine">
                            @foreach ($dtnya as $k => $v)
                                <p id="{{ $k }}" no="{{ $v->peserta_no }}"
                                    nama="{{ strtoupper($v->peserta_nama) }}">
                                    {{ $v->peserta_no }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}

    <div class="modal fade" id="winnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="overflow:hidden;">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal" style="overflow:hidden;">
            <div class="modal-content modalWinner" style="background-color:#fff0">
                <div class="modal-body">
                    <img src="{{ asset('/undian/grandprize.png') }}" alt=""
                        style="width: -webkit-fill-available;">
                    <span class="ww" style="width: 80%;text-align: center;padding-left: 25px;padding-right: 25px;">
                        <span class="menang" style="font-size:22px;margin-top:5px;">Nama</span>
                        <br>
                        {{-- <span class="nomor" style="font-size:22px;">Nomor</span><br> --}}
                        <span class="detil" style="font-size:16px;margin-top:15px;"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/undian/dist/slotmachine.min.js') }}"></script>
    <script src="{{ asset('plugins/undian/dist/jquery.slotmachine.min.js') }}"></script>

    <script>
        function showTime() {
            // var curtain = document.getElementById("curtain");
            // curtain.className = "open";

            var scene = document.getElementById("scene");
            scene.className = "expand";

            // var starter = document.getElementById("starter");
            // starter.className = "fade-out";
        }
        // $(function() {
        const planeMachine = document.querySelector('#planeMachine');
        const listriqu = new SlotMachine(planeMachine, {
            active: 0,
            delay: 1500,
            onComplete: function(z) {
                $("span.menang").html($('#planeMachine p[id="' + z + '"]').attr("nama"));
                $("span.nomor").html($('#planeMachine p[id="' + z + '"]').attr("no"));
                $("span.detil").html($('#planeMachine p[id="' + z + '"]').attr("phone"));
                $.post("{{ url('grandprize/setwinner') }}", {
                    id: $('#planeMachine p[id="' + z + '"]').attr("pid"),
                    nama: $('#planeMachine p[id="' + z + '"]').attr("nama"),
                    no: 5,
                    _token: $("input[name=_token]").val()
                })

            }
        });

        $(planeMachine).find('p').hide();


        function mulai() {
            $(planeMachine).find('p').show();
            listriqu.shuffle(Infinity);
        }


        function stop() {
            listriqu.stop();
            const myTimeout = setTimeout(function() {
                $("#winnerModal").modal("show");
            }, 3000);
        }

        function reset() {
            $(planeMachine).find('p').hide();
        }

        showTime();

        // });
    </script>




</body>

</html>
