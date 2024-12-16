<style>
    .disabled {
        pointer-events: none;
        color: grey;
        text-decoration: none;
    }

</style>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1c294e; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 11px;">LOGIKA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('juri.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('juri.profil_juri')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span style="font-size: 11px;">Profil Juri</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span style="font-size: 11px;">Penilaian Lomba</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded" style="font-size: 11px;">
                        @php 
                            $user = auth()->user(); $mataLombaUser = $user && $user->juri && $user->juri->mata_lomba ? $user->juri->mata_lomba->nama : null; 
                        @endphp
                
                        <a class="collapse-item {{ $mataLombaUser != 'PIONERING' ? 'disabled' : '' }}" href="buttons.html">PIONERING</a>
                        <a class="collapse-item {{ $mataLombaUser != 'KARIKATUR' ? 'disabled' : '' }}" href="{{route('penilaian-karikatur.index')}}">KARIKATUR</a>
                        <a class="collapse-item {{ $mataLombaUser != 'DUTA LOGIKA' ? 'disabled' : '' }}" href="cards.html">DUTA LOGIKA</a>
                        <a class="collapse-item {{ $mataLombaUser != 'LKFBB' ? 'disabled' : '' }}" href="cards.html">LKFBB</a>
                        <a class="collapse-item {{ $mataLombaUser != 'FOTO' ? 'disabled' : '' }}" href="cards.html">FOTO</a>
                        <a class="collapse-item {{ $mataLombaUser != 'VIDEO' ? 'disabled' : '' }}" href="cards.html">VIDEO</a>
                    </div>
                </div>                
            </div>
        </div>        
    </li>

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
