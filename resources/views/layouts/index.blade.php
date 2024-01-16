<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Web Admin untuk acara Family Day.">
    <meta name="author" content="Muhammad Rizqi">
    <title>Family Day Admin</title>



    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/lineAwesome/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="familyDay">
    <div id="root" class="root mn--max hd--expanded">
        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">
                    @yield('header')
                </div>
            </div>

            <div class="content__boxed">
                <div class="content__wrap container">
                    @yield('content')
                </div>
            </div>
            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Powered By<a href="https://www.iconpln.co.id"
                                class="ms-1 btn-link fw-bold">ICON+</a></div>
                    </div>
                </div>
            </footer>
        </section>


        <nav id="famdaynav-container" class="famdaynav">
            <div class="famdaynav__inner">
                <div class="famdaynav__top-content scrollable-content pb-5">
                    <div class="famdaynav__profile mt-3 d-flex3">
                        <div class="mt-2 d-mn-max"></div>
                        <div class="mininav-toggle text-center py-2">
                            <img class="famdaynav__logo img-md rounded-circle " src="{{ asset('img/logo.png') }}"
                                alt="Logo Picture">
                        </div>
                    </div>

                    <div class="famdaynav__categoriy py-3">
                        <ul class="famdaynav__menu nav flex-column">
                            <li class="nav-item has-sub">
                                <a href="{{ url('/') }}" class="mininav-toggle nav-link collapsed"><i
                                        class="la la-th-large fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label ms-1">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('events/list') }}" class="nav-link">
                                    <i class="la la-calendar fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label ms-1">Events</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ url('events/manage/2') }}" class="nav-link">
                                    <i class="la la-calendar fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label ms-1">Refferal</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('users/list') }}" class="nav-link mininav-toggle"><i
                                        class="la la-user fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label mininav-content ms-1">Daftar User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('winner/list') }}" class="nav-link mininav-toggle"><i
                                        class="la la-user fs-5 me-2 mtnk1r"></i>
                                    <span class="nav-label mininav-content ms-1">Daftar Pemenang Undian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="famdaynav__bottom-content border-top pb-2">
                    <ul id="famdaynav" class="famdaynav__menu nav flex-column">
                        <li class="nav-item ">
                            <a href="{{ url('auth/logout') }}" class="nav-link" aria-expanded="false">
                                <i class="la la-lock fs-5 me-2"></i>
                                <span class="nav-label ms-1">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    @yield('modal')

    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>

    <script src="{{ asset('plugins/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/additional-methods.min.js') }}"></script>
    @yield('script')

</body>

</html>
