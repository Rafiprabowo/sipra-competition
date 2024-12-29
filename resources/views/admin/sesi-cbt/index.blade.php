@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Sesi Computer Based Test</h5>
                <a href="{{route('sesi-cbt.create')}}" class="btn btn-primary">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$session->nama}}</td>
                                <td>{{$session->waktu_mulai}}</td>
                                <td>{{$session->waktu_selesai}}</td>
                                <td>
                                    <a href="{{ route('sesi-peserta.index', $session->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <a href="{{ route('sesi-cbt.edit', $session->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('sesi-soal.index', ['id' => $session->id, 'nama' => $session->mataLomba->nama])}}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    <form action="{{ route('sesi-cbt.destroy', $session->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
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
        })
    </script>
@endsection
