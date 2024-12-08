<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-text mx-3">LOGIKA</div>
    </a>
    <!-- Manjemen Peserta -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Peserta</span></a>
    </li>
    <!-- Manjemen Pembina -->
    <hr class="sidebar-divider my-2">
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Pembina</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <!-- Manjemen Juri -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen Juri</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <!-- Manjemen User -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Manajemen User</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.mata-lomba.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Mata Lomba</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dokumen.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Template Dokumen</span></a>
    </li>
    <hr class="sidebar-divider my-2">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manajemen Peserta</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.pembina.index')}}">Pembina</a>
                <a class="collapse-item" href="{{route('admin.peserta.index')}}">Peserta</a>
                <a class="collapse-item" href="{{route('juri.index')}}">Juri</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.mata-lomba.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manajemen Bobot Soal</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Manajemen Lomba</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h3 class="collapse-header text-black-50">Lomba CBT</h3>
                <a class="collapse-item" href="login.html">TPK</a>
                <a class="collapse-item" href="register.html">Semaphore</a>
                <a class="collapse-item" href="forgot-password.html">Sandi Morse</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Lomba Umum</h6>
                <a class="collapse-item" href="404.html">Vido</a>
                <a class="collapse-item" href="blank.html">dll</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item active">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
