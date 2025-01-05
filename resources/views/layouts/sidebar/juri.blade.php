<style>
    .disabled {
        pointer-events: none;
        color: grey;
        text-decoration: none;
    }

</style>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black; ">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/Logika.png') }}" alt="Logika" width="50px;" style="margin-top: 30px;">
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" style="padding-top: 15%;">
        <a class="nav-link" href="{{route('juri.dashboard')}}">
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('juri.profil_juri')}}">
            <span style="font-size: 11px;">Profil Juri</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <span style="font-size: 11px;">Penilaian Lomba</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white pt-2 collapse-inner rounded">
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    @php 
                            $user = auth()->user(); 
                            $mataLombaUser = $user && $user->juri && $user->juri->mata_lomba ? $user->juri->mata_lomba->nama : null; 
                        @endphp

                        @if ($mataLombaUser == 'KARIKATUR')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-karikatur.index')}}">KARIKATUR</a>
                            </div>
                        @endif

                        @if ($mataLombaUser == 'PIONERING')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-pionering.index')}}">PIONERING</a>
                            </div>
                        @endif

                        @if ($mataLombaUser == 'DUTA LOGIKA')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-duta-logika.index')}}">DUTA LOGIKA</a>
                            </div>
                        @endif

                        @if ($mataLombaUser == 'LKFBB')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-lkfbb.index')}}">LKFBB</a>
                            </div>
                        @endif

                        @if ($mataLombaUser == 'FOTO')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-foto.index')}}">FOTO</a>
                            </div>
                        @endif

                        @if ($mataLombaUser == 'VIDIO')
                            <div class="bg-white pt-2 collapse-inner rounded" style="font-size: 11px;">
                                <a class="collapse-item" href="{{route('penilaian-vidio.index')}}">VIDIO</a>
                            </div>
                        @endif
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
