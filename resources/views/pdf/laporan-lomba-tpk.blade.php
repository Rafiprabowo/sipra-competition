@extends('layouts.laporan')

@section('content')
    <x-letterhead />
    <div class="content">
        <h3>Hasil Lomba Tes Pengetahuan Kepramukaan</h1>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Peserta</th>
                    <th>Jenis Kelamin</th>
                    <th>Nilai</th>
                    <th>Nama Regu</th>
                    <th>Nama Pangkalan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top_peserta as $peserta)
                    <tr>
                        <td>{{ $peserta['peringkat'] }}</td> <!-- Menampilkan peringkat -->
                        <td>{{ $peserta['nama_peserta'] }}</td>
                        <td>{{ $peserta['jenis_kelamin'] }}</td>
                        <td>{{ $peserta['score'] }}</td>
                        <td>{{ $peserta['nama_regu'] }}</td>
                        <td>{{ $peserta['nama_pangkalan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
