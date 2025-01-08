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
    <div class="kop-surat" style="text-align: center;">
        {{-- <img src="{{ asset('') }}" alt="Logo Kiri"> --}}
        <div>
            <h2>PESERTA PERLOMBAAN</h2>
            <h3>PRESTASI TANGGAP PRAMUKA PENGGALANG (PRESTAPRAGA)</h3>
            <h3>PANGKALAN SMA SURYA BUANA MALANG</h3>
            <p>JL. Candi VI 01/06 Karangbesuki Sukun Kota Malang Telp./Fax (0341)5024546</p>
        </div>
        {{-- <img src="{{ asset('') }}" alt="Logo Kanan"> --}}
        <hr style="border: 3px solid black;">
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
                    <th>Nama Peserta</th>
                    <th>Regu</th>
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
                <br>
                <div class="footer" style="text-align: right; position: absolute; right: 0;">
                    <p>Malang, {{ $peserta->penilaian_pionering->first()->created_at->format('d F Y') }}</p>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_pionering->juri->nama }}</p>
                </div>    

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
                    <br>
                    <div class="footer" style="text-align: right; position: absolute; right: 0;">
                        <p>Malang, {{ $peserta->penilaian_karikatur->first()->created_at->format('d F Y') }}</p>
                        <p style="margin-top: 60%;">{{ $peserta->penilaian_karikatur->juri->nama }}</p>
                    </div>                    

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
                <br>
                <div class="footer" style="text-align: right; position: absolute; right: 0;">
                    <p>Malang, {{ $peserta->penilaian_duta_logika->first()->created_at->format('d F Y') }}</p>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_duta_logika->juri->nama }}</p>
                </div>    
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
                <br>
                <div class="footer" style="text-align: right; position: absolute; right: 0;">
                    <p>Malang, {{ $peserta->penilaian_lkfbb->first()->created_at->format('d F Y') }}</p>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_lkfbb->juri->nama }}</p>
                </div> 
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
                    <th>Nama Peserta</th>
                    <th>Regu</th>
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
        <br>
        <div class="footer" style="text-align: right; position: absolute; right: 0;">
            <p>Malang, {{ $peserta->penilaian_foto->first()->created_at->format('d F Y') }}</p>
            <p style="margin-top: 60%;">{{ $peserta->penilaian_foto->juri->nama }}</p>
        </div> 
    @endif

    @if(isset($tab) && ($tab == 'penilaian_dutaLogika'))
        @if($mata_lomba->nama == 'DUTA LOGIKA')
            <h3 style="text-align: center;">Hasil Lomba Duta Logika LOGIKA 2025</h3>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Regu</th>
                    <th>Pangkalan</th>
                    <th>Jenis Kelamin</th>
                    <th>Nilai akhir</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @if($mata_lomba->nama == 'DUTA LOGIKA')
                @foreach($peserta as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->regu_pembina->nama_regu }}</td>
                        <td>{{ $item->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->highest_total_nilai }}</td>
                        <td>{{ $item->penilaian_duta_logika->rangking }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <div class="footer" style="text-align: right; position: absolute; right: 0;">
            <p>Malang, {{ $peserta->penilaian_duta_logika->first()->created_at->format('d F Y') }}</p>
            <p style="margin-top: 60%;">{{ $peserta->penilaian_duta_logika->juri->nama }}</p>
        </div> 
    @endif

    @if(isset($tab) && ($tab == 'penilaian_vidio'))
        @if($mata_lomba->nama == 'VIDIO')
            <h3 style="text-align: center;">Hasil Lomba Vidio LOGIKA 2025</h3>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Regu</th>
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
        <br>
        <div class="footer" style="text-align: right; position: absolute; right: 0;">
            <p>Malang, {{ $peserta->penilaian_vidio->first()->created_at->format('d F Y') }}</p>
            <p style="margin-top: 60%;">{{ $peserta->penilaian_vidio->juri->nama }}</p>
        </div> 
    @endif
</body>
</html>