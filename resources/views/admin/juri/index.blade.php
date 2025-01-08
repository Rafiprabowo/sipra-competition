@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>        
                <li class="breadcrumb-item active" aria-current="page">Data Juri</li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert"> {{ session('error') }} </div>
        @endif
    
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 16px;">Data Nama Juri</h6>
                <div>
                    <a href="{{route('juri.create')}}" class="btn btn-primary btn-md" style="font-size: 11px;" title="Tambah">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{route('juri.export')}}" class="btn btn-danger btn-md" style="font-size: 11px;" title="Export PDF">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Juri</th>
                            <th>Kwartir Cabang</th>
                            <th>Pangkalan</th>
                            <th>Jenis Kelamin</th>
                            <th>No Handphone</th>
                            <th>Mata Lomba</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($juri as $index => $value)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{ $value->kwartir_cabang }}</td>
                                <td>{{ $value->pangkalan }}</td>
                                <td>{{ $value->jenis_kelamin }}</td>
                                <td>{{ $value->no_hp }}</td>
                                <td>{{optional($value->mata_lomba)->nama}}</td>
                                <td>
                                    {{-- <a href="{{route('juri.show', $value->id)}}" class="btn btn-info btn-sm " title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a> --}}
                                    <a href="{{route('juri.edit', $value->id)}}" class="btn btn-warning btn-sm mx-3" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{route('juri.destroy', $value->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger  btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
