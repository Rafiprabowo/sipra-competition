<!-- Template PDF -->
<!DOCTYPE html>
<html>
<head>
    <title>Penilaian Lomba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <img src="{{ storage_path('app/public/profile_pictures/kop_surat.jpg') }}" alt="Kop Surat" style="width: 100%; height: auto;">
    </div>

    @if(isset($tab) && ($tab == 'putra' || $tab == 'putri'))
        @if($mata_lomba->nama == 'PIONERING')
            <h3 style="text-align: center;">Hasil Lomba Pionering {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'KARIKATUR')
            <h3 style="text-align: center;">Hasil Lomba Karikatur {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'DUTA LOGIKA')
            <h3 style="text-align: center;">Hasil Lomba Duta Logika {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'LKFBB')
            <h3 style="text-align: center;">Hasil Lomba LKFBB {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Regu</th>
                    <th>Pangkalan</th>
                    <th>Jenis Kelamin</th>
                    <th>Nilai Akhir</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @if($mata_lomba->nama == 'PIONERING')
                @foreach(${$tab} as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_pionering->rangking }}</td>
                    </tr>
                @endforeach
                @elseif($mata_lomba->nama == 'KARIKATUR')
                @foreach(${$tab} as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_karikatur->rangking }}</td>
                    </tr>
                @endforeach
                @elseif($mata_lomba->nama == 'DUTA LOGIKA')
                @foreach(${$tab} as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_duta_logika->rangking }}</td>
                    </tr>
                @endforeach
                @elseif($mata_lomba->nama == 'LKFBB')
                @foreach(${$tab} as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_lkfbb->rangking }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    @endif

    @if(isset($tab) && ($tab == 'penilaian_foto'))
        @if($mata_lomba->nama == 'FOTO')
            <h3 style="text-align: center;">Hasil Lomba Foto LOGIKA 2025</h3>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Regu</th>
                    <th>Pangkalan</th>
                    <th>Nilai Akhir</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @if($mata_lomba->nama == 'FOTO')
                @foreach($penilaianFotos as $index => $penilaian_foto)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian_foto->juri->nama }}</td>
                        <td>{{ $penilaian_foto->pembina->nama }}</td>
                        <td>{{ $penilaian_foto->pembina->pangkalan }}</td>
                        <td>{{ $penilaian_foto->total_nilai }}</td>
                        <td>{{ $penilaian_foto->rangking }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    @endif

    @if(isset($tab) && ($tab == 'penilaian_vidio'))
        @if($mata_lomba->nama == 'VIDIO')
            <h3 style="text-align: center;">Hasil Lomba Vidio LOGIKA 2025</h3>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Regu</th>
                    <th>Pangkalan</th>
                    <th>Nilai Akhir</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @if($mata_lomba->nama == 'VIDIO')
                @foreach($penilaianVidios as $index => $penilaian_vidio)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian_vidio->juri->nama }}</td>
                        <td>{{ $penilaian_vidio->pembina->nama }}</td>
                        <td>{{ $penilaian_vidio->pembina->pangkalan }}</td>
                        <td>{{ $penilaian_vidio->total_nilai }}</td>
                        <td>{{ $penilaian_vidio->rangking }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    @endif
</body>
</html>