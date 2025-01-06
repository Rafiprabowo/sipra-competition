@extends('layouts.laporan')

@section('content')
    <x-letterhead />
    <div class="content">
        <h3>Hasil Lomba Tes Tes Pengetahuan Kepramukaan</h3>

        @if (!empty($rankingResults['ranked_participants']))
            @foreach ($rankingResults['ranked_participants'] as $gender => $participants)
                <h4>{{ ucfirst($gender) }}</h4>
                <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Nilai</th>
                            <th>Pangkalan</th>
                            <th>Regu</th>                            
                            <th>Rangking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->peserta->nama ?? 'N/A' }}</td>
                                <td>{{ $peserta->score }}</td>
                                <td>{{ $peserta->peserta->regu_pembina->pembina->pangkalan ?? 'N/A' }}</td>
                                <td>{{ $peserta->peserta->regu_pembina->nama_regu ?? 'N/A' }}</td>
                                <td>{{ $peserta->rank ? 'Juara ' . $peserta->rank : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @else
            <p>Tidak ada data peserta yang tersedia.</p>
        @endif
    </div>
@endsection
