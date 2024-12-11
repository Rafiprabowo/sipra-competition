<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
        
        <a href="{{route('registrasi.form')}}" class="nav-link">{{$pembina->finalisasi->status == 0 || 1 ? 'Hasil Finalisasi' : 'Registrasi LOGIKA'}}</a>
    </li>


</ul>
<!-- End of Sidebar -->
