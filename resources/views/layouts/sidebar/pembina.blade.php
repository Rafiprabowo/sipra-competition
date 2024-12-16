<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1c294e; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('pembina.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 11px;">LOGIKA</div>
    </a>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        
        <a class="nav-link" href="{{route('pembina.dashboard')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a href="{{route('registrasi.form')}}" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span style="font-size: 11px;">Registrasi Pembina</span></a>
    </li>

        <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('upload_lombas.form')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span style="font-size: 11px;">Lomba Foto & Vidio</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('pembina.lihat-anggota')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span style="font-size: 11px;">Lihat Anggota</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
