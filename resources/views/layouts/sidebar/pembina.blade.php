<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1c294e; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('pembina.dashboard')}}">
        <div class="sidebar-brand-text mx-3">LOGIKA</div>
    </a>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('pembina.dashboard')}}">Dashboard</a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a href="{{route('registrasi.form')}}" class="nav-link">Registrasi Pembina</a>
    </li>

        <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('upload_lombas.form')}}">
            Upload Lomba Foto& Vidio</a>
    </li>


</ul>
<!-- End of Sidebar -->
