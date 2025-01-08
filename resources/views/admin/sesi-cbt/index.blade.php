@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 12px;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sesi Computer Based Test</li>
            </ol>
        </nav>
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Sesi Computer Based Test</h5>
                <a href="{{route('sesi-cbt.create')}}" class="btn btn-primary" style="font-size: 11px;" title="Tambah">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Mata Lomba</th>
                                <th>Jumlah Soal</th>
                                <th>Jenis Soal</th> <!-- New column for question types -->
                                <th>Kode Akses</th>                                    
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$session->nama}}</td>
                                    <td>
                                        <span class="badge badge-info">{{$session->waktu_mulai}}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{$session->waktu_selesai}}</span>
                                    </td>                                    
                                    <td>{{$session->durasi}} Menit</td>  
                                    <td>
                                        @if($session->status == 'draft')
                                            <span class="badge badge-danger">Ditutup</span>
                                        @elseif($session->status == 'active')
                                            <span class="badge badge-success">Dibuka</span>
                                        @else
                                            <span class="badge badge-info">Selesai</span>
                                        @endif
                                    </td>                                       
                                    <td>{{$session->mataLomba->nama}}</td>
                                    <td>{{$session->jumlah_soal}}</td>
                                    <td>
                                        <!-- Display question types and counts -->
                                        @foreach($session->questionConfigurations as $config)
                                            <div>{{ $config->question_type }} - {{ $config->question_count }} soal</div>
                                        @endforeach
                                    </td>
                                    <td >{{$session->kode_akses}}</td>
                                    <td>
                                        <a href="{{ route('sesi-peserta.index', $session->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Lihat Peserta">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <a href="{{ route('sesi-cbt.edit', $session->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit Sesi">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('sesi-soal.index', ['id' => $session->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Lihat Soal">
                                            <i class="fas fa-question-circle"></i>
                                        </a>
                                        <form action="{{ route('sesi-cbt.destroy', $session->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Sesi">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $('#dataTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
        });
    </script>
@endsection
