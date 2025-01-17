<style>
    .page-break {
        page-break-before: always;
    }

        .logo-left {
            float: left;
            width: 50px;
        }
        .logo-right {
            float: right;
            width: 50px;
        }
        h2 {
            font-size: 18px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        h3 {
            font-size: 16px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        h1 {
            font-size: 20px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        p {
            font-size: 14px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        hr {
            border: 3px solid black;
            margin: 10px 0;
        }
</style>

@extends('layouts.laporan')

@section('content')
    @foreach ($rankingResults['ranked_participants'] as $gender => $participants)
        <div class="{{ $loop->first ? '' : 'page-break' }}">
            <div class="kop-surat" style="text-align: center;">
                <table>
                    <tr>
                        <td><img src="{{ $base64LogoKiri }}" alt="Logo Kiri" class="kiri" width="70" height="70"></td>
                        <td class="center-text" style="text-align: center; align-items: center; padding-left: 50px; padding-right: 50px;">
                            <h2>GERAKAN PRAMUKA</h2>
                            <h3>GUGUS DEPAN KOTA MALANG 04571-04572</h3>
                            <h1>PANGKALAN ARVEGATU SMPN 4 MALANG</h1>
                            <p>Jalan Veteran 37 Malang 65145 telepon (0341) 551289 Fax. (0341) 574062</p>
                        </td>
                        <td><img src="{{ $base64LogoKanan }}" alt="Logo Kanan" class="kanan" width="90" height="90"></td>
                    </tr>
                </table>
                <hr style="border: 2px solid black; clear: both;">
            </div>
            <div class="content">
                <h1 style="text-align: center; padding-top: 3%;">Hasil Lomba Tes Pengetahuan Kepramukaan</h1>
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
                        @foreach ($participants->slice(0, 3) as $index => $peserta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $peserta->peserta->nama ?? 'N/A' }}</td>
                                <td>{{ $peserta->score }}</td>
                                <td>{{ $peserta->peserta->regu_pembina->pembina->pangkalan ?? 'N/A' }}</td>
                                <td>{{ $peserta->peserta->regu_pembina->nama_regu ?? 'N/A' }}</td>
                                <td>{{ $peserta->rank ? 'Juara ' . $peserta->rank : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="footer" style="text-align: left; position: absolute; left: 0;">
                    <p><br></p>
                    <span style="text-align: left;">Ketua Pelaksana</span>
                    <p style="margin-top: 70%;">
                        @foreach ($ketuaPelaksanas as $ketua)
                        {{ $ketua->username }}
                    @endforeach
                    </p>
                </div> 
                <div class="footer" style="text-align: right; position: absolute; right: 0;">
                    <p>Malang, {{ \Carbon\Carbon::parse($peserta->completed_at)->format('d-m-Y') }}</p>
                    <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
                    <p style="margin-top: 80%;">
                        @foreach ($juritpks as $juri)
                            {{ $juri->nama }}
                        @endforeach
                    </p>
                </div>    
            </div>
        </div>
    @endforeach
@endsection
