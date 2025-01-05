<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('img/Logika.png') }}" alt="Logika" width="50px;" style="margin-top: 30px;">
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" style="padding-top: 15%;">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <span style="font-size: 11px;">Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-2">

    <!-- Manjemen Peserta -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.peserta.index')}}">
            <span style="font-size: 11px;">Manajemen Peserta</span></a>
    </li>
    <!-- Manjemen Pembina -->

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.pembina.index')}}">
            <span style="font-size: 11px;">Manajemen Pembina</span></a>
    </li>

    <!-- Manjemen Juri -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('juri.index')}}">
            <span style="font-size: 11px;">Manajemen Juri</span></a>
    </li>

    <!-- Manjemen User -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <span style="font-size: 11px;">Manajemen User</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.mata-lomba.index')}}">
            <span style="font-size: 11px;">Manajemen Mata Lomba</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('sesi-cbt.index')}}">
            <span style="font-size: 11px;">Lomba CBT SMS & TPK</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.bobot-soal.index')}}">
            <span style="font-size: 11px;">Manajemen Bobot Soal</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <span style="font-size: 11px;">Hasil Penilaian</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded">
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white collapse-inner rounded" style="font-size: 11px;">
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_karikatur')}}">KARIKATUR</a>
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_pionering')}}">PIONERING</a>
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_duta_logika')}}">DUTA LOGIKA</a>
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_lkfbb')}}">LKFBB</a>
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_foto')}}">FOTO</a>
                        <a class="collapse-item" href="{{route('admin.hasil_nilai.nilai_vidio')}}">VIDIO</a>
                        <a class="collapse-item" href="{{route('hasil-tpk')}}">TPK</a>
                        <a class="collapse-item" href="cards.html">SEMAPHORE MORSE</a>
                    </div>
                </div>                
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('dokumen.index')}}">
            <span style="font-size: 11px;">Template Dokumen</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
