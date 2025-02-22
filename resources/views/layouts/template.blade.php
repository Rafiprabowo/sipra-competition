<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIKA 2025</title>

    <!-- Custom fonts for this template-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Impor CSS DataTables -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    
    @yield('h-script')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @yield('sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                {{-- <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           @if(Auth::user()->role == 'pembina')
                                @if(Auth::user()->pembina)
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->pembina->nama }}</span>
                                @else
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nama belum diisi</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil) }}">
                                {{-- <img class="img-profile rounded-circle" src="{{ Auth::user()->foto_profil ? asset('profile_pictures/' . Auth::user()->foto_profil) : asset('images/default.png') }}" alt="User Profile"> --}}
                            @elseif(Auth::user()->role == 'juri')
                                @if(Auth::user()->juri)
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->juri->nama }}</span>
                                @else
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nama belum diisi</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil) }}">
                                {{-- <img class="img-profile rounded-circle" src="{{ Auth::user()->foto_profil ? asset('profile_pictures/' . Auth::user()->foto_profil) : asset('images/default.png') }}" alt="User Profile"> --}}
                            @elseif(Auth::user()->role == 'peserta')
                                @if(Auth::user()->peserta)
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->peserta->nama }}</span>
                                @else
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nama belum diisi</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil) }}">
                                {{-- <img class="img-profile rounded-circle" src="{{ Auth::user()->foto_profil ? asset('profile_pictures/' . Auth::user()->foto_profil) : asset('images/default.png') }}" alt="User Profile"> --}}
                            @elseif(Auth::user()->role == 'admin')
                                @if(Auth::user()->admin)
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->admin->nama }}</span>
                                @else
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nama belum diisi</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ Storage::url(Auth::user()->foto_profil) }}">
                                {{-- <img class="img-profile rounded-circle" src="{{ Auth::user()->foto_profil ? asset('profile_pictures/' . Auth::user()->foto_profil) : asset('images/default.png') }}" alt="User Profile"> --}}
                            @endif
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                             @if(Auth::user()->role == 'pembina')
                                <a class="dropdown-item" href="{{ route('editProfilePembina') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            @elseif(Auth::user()->role == 'juri')
                                <a class="dropdown-item" href="{{ route('editProfileJuri') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            @elseif(Auth::user()->role == 'peserta')
                                <a class="dropdown-item" href="{{ route('editProfilePeserta') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            @elseif(Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('editProfileAdmin') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            @endif
                            {{-- <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row">
                    @yield('content')
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span style="font-size: 14px;"><strong>LOGIKA 2025</strong></span>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik Logout Jika Ingin Keluar dari Website</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle (termasuk Popper.js) -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- SB Admin 2 (menggunakan Bootstrap) -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>



@yield('script')
</body>

</html>
