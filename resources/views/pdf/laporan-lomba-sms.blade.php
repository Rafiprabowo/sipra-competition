@extends('layouts.laporan')

@section('content')
    <x-letterhead />
    <div class="content">
        <h3>Hasil Lomba Tes Semaphore & Morse</h3>

        <!-- Putra -->
        <h4>Putra</h4>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nilai</th>
                    <th>Regu</th>
                    <th>Pangkalan</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top_peserta['Putra'] as $peserta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peserta['nama_peserta'] }}</td>
                        <td>{{ $peserta['score'] }}</td>
                        <td>{{ $peserta['nama_regu'] }}</td>
                        <td>{{ $peserta['nama_pangkalan'] }}</td>
                        <td>{{ $peserta['peringkat'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Putri -->
        <h4>Putri</h4>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nilai</th>
                    <th>Regu</th>
                    <th>Pangkalan</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top_peserta['Putri'] as $peserta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peserta['nama_peserta'] }}</td>
                        <td>{{ $peserta['score'] }}</td>
                        <td>{{ $peserta['nama_regu'] }}</td>
                        <td>{{ $peserta['nama_pangkalan'] }}</td>
                        <td>{{ $peserta['peringkat'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
