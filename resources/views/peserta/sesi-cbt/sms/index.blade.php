@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <h5>Mulai Ujian</h5>
        @if($sessions->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada sesi ujian yang tersedia saat ini.
            </div>
        @else
            <div class="table-responsive bg-white p-3 rounded">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Durasi</th>
                            <th>Token</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->nama }}</td>
                                <td><span class="badge badge-info">{{ \Carbon\Carbon::parse($session->waktu_mulai)->format('d-m-Y H:i') }}</span></td>
                                <td><span class="badge badge-info">{{ \Carbon\Carbon::parse($session->waktu_selesai)->format('d-m-Y H:i') }}</span></td>
                                <td>{{ $session->durasi }} menit</td>
                                <td>
                                    <form action="{{ route('token.cbt', $session->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="token_{{ $session->id }}" name="token" required>
                                        </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Mulai Ujian</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="d-flex justify-content-start mt-4">
            <a href="{{ route('peserta.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
