<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('assets/client/img/logo-icon.png') }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/slick/slick.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/vendor/slick/slick-theme.min.css') }}" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/client/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/client/css/osahan.min.css') }}" rel="stylesheet">

    @yield('page-style')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-start" href="{{ route('home') }}">
               <div class="sidebar-brand-icon">
                  <img src="{{ asset('assets/client/img/logo-icon.png') }}" alt="">
               </div>
               <div class="sidebar-brand-text mx-3"><img src="{{ asset('assets/client/img/logo.png') }}" alt=""></div>
            </a>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if(Request()->segment(1) == '') active @endif">
               <a class="nav-link" href="{{ route('home') }}">
               <i class="fas fa-fw fa-home"></i>
               <span>Home</span></a>
            </li>
            <li class="nav-item @if(Request()->segment(1) == 'movies') active @endif">
               <a class="nav-link" href="{{ route('movies') }}">
               <i class="fas fa-fw fa-film"></i>
               <span>Movies</span></a>
            </li>
         </ul>
         <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow">
                    {{-- <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/client/img/logo-icon.png') }}" alt="" width="" height="">
                        <img src="{{ asset('assets/client/img/logo.png') }}" alt="" width="" height="">
                    </a> --}}
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3"><i class="fa fa-bars"></i></button>
                    <!-- Topbar Search -->
                    <form action="" method="post" id="searchForm" class="d-none d-sm-inline-block form-inline mx-auto my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-white border-0 small" name="keyword" placeholder="Search for Movies..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn bg-white" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form action="" method="post" id="searchFormMobile" class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for Movies..." name="keyword" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->
                        @auth
                            @if (Auth::user()->is_admin)
                                <li class="nav-item mr-2">
                                    <a class="btn btn-primary" href="{{ route('dashboard') }}" role="button"><span>Dashboard</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#logoutModal" role="button"><span>Logout</span></a>
                                </li>
                            @else
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        <!-- Counter - Alerts -->
                                        <span class="badge badge-danger badge-counter">8+</span>
                                    </a>
                                    <!-- Dropdown - Alerts -->
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header">
                                            Alerts
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary text-white">
                                                    KN
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 12, 2020</div>
                                                <span class="font-weight-bold">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                </span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle w-60" src="{{ asset('assets/client/img/s1.png') }}"
                                                    alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Duis vel est sit amet ipsum egestas efficitur.</div>
                                                <div class="small text-gray-500">Gurdeep Osahan · 58m</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle w-60"
                                                    src="{{ asset('assets/client/img/s2.png') }}" alt="">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Pellentesque euismod diam sit amet nibh molestie,
                                                    imperdiet feugiat mi feugiat.</div>
                                                <div class="small text-gray-500">Jae Chun · 1d</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle w-60"
                                                    src="{{ asset('assets/client/img/s3.png') }}" alt="">
                                                <div class="status-indicator bg-warning"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Quisque ac justo bibendum nunc fringilla pharetra nec
                                                    sit amet mauris.</div>
                                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 7, 2020</div>
                                                Sed aliquet nibh nec odio congue, in condimentum massa dapibus.
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 2, 2020</div>
                                                Pellentesque sit amet nunc consectetur, porta sapien a, bibendum dolor.
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </li>
                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        <img class="img-profile rounded-circle"
                                            src="{{ asset('assets/img/default.jpg') }}">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Account Settings
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mr-2">
                                <a class="btn btn-primary" href="{{ route('login') }}" role="button"><span>Login</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button"><span>Register</span></a>
                            </li>
                        @endauth
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" hrtypeef="submit">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/client/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/client/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/client/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="{{ asset('assets/client/vendor/slick/slick.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/client/js/osahan.min.js') }}"></script>

    <script>
        const searchForm = $('#searchForm')
        const searchFormMobile = $('#searchFormMobile')

        const handleSearch = (e) => {
            e.preventDefault()

            const keyword = $(e.target).serializeArray()[0].value

            if (keyword) {
                document.location.href = "<?= url('movies/search/') ?>/" + keyword;
            } else {
                document.location.href = "{{ route('movies') }}";
            }
        }

        searchForm.on('submit', handleSearch)
        searchFormMobile.on('submit', handleSearch)
    </script>

    @yield('page-script')
</body>

</html>
