<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('pembina.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/Logika.png') }}" alt="Logika" width="50px;" style="margin-top: 30px;">
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" style="padding-top: 15%;">
        <a class="nav-link" href="{{route('pembina.dashboard')}}">
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a href="{{route('registrasi.form')}}" class="nav-link">
            <span style="font-size: 11px;">Registrasi Pembina</span></a>
    </li>

        <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('upload_lombas.form')}}">
            <span style="font-size: 11px;">Lomba Foto & Vidio</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('pembina.lihat-anggota')}}">
            <span style="font-size: 11px;">Lihat Anggota</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
