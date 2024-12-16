<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1c294e; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LOGIKA</div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-2">

    <!-- Manjemen Peserta -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.peserta.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Peserta</span></a>
    </li>
    <!-- Manjemen Pembina -->

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.pembina.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Pembina</span></a>
    </li>

    <!-- Manjemen Juri -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('juri.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Juri</span></a>
    </li>

    <!-- Manjemen User -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen User</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.mata-lomba.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Mata Lomba</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.bobot-soal.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Bobot Soal</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dokumen.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Template Dokumen</span></a>
    </li>

    <hr class="sidebar-divider my-2">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
