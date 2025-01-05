<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/Logika.png') }}" alt="Logika" width="50px;" style="margin-top: 30px;">
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" style="padding-top: 15%;">
        <a class="nav-link" href="{{route('peserta.dashboard')}}">
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
