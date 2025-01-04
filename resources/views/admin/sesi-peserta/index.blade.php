@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 style="font-size: 11px;">Peserta {{ $session->nama }} Computer Based Test</h5>
                <a href="{{ route('sesi-peserta.create', $session->id) }}" class="btn btn-primary" style="font-size: 11px;" title="Tambah">
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
                                <th>Pangkalan</th>
                                <th>Regu</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $participant->peserta->nama }}</td>
                                    <td>{{ $participant->peserta->regu_pembina->pembina->nama }}</td>
                                    <td>{{ $participant->peserta->regu_pembina->nama_regu }}</td>
                                    <td>{{ $participant->peserta->jenis_kelamin }}</td>
                                    
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
        });
    </script>
@endsection
