<!-- Template PDF -->
<!DOCTYPE html>
<html>
<head>
    <title>Penilaian Lomba</title>
    <style>
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
</head>
<body>
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

    @if(isset($tab) && ($tab == 'putra' || $tab == 'putri'))
        @if($mata_lomba->nama == 'PIONERING')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Pionering {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'KARIKATUR')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Karikatur {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'DUTA LOGIKA')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Duta Logika {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @elseif($mata_lomba->nama == 'LKFBB')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba LKFBB {{ ucfirst($tab) }} LOGIKA 2025</h3>
        @endif
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
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
                @if($peserta->penilaian_pionering->rangking == 'Juara 1' || $peserta->penilaian_pionering->rangking == 'Juara 2' || $peserta->penilaian_pionering->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_pionering->rangking }}</td>
                    </tr>
                @endif
                @endforeach
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
                    <p>Malang, {{ $peserta->penilaian_pionering->first()->created_at->format('d F Y') }}</p>
                    <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_pionering->juri->nama }}</p>
                </div>    

                @elseif($mata_lomba->nama == 'KARIKATUR')
                @foreach(${$tab} as $index => $peserta)
                @if($peserta->penilaian_karikatur->rangking == 'Juara 1' || $peserta->penilaian_karikatur->rangking == 'Juara 2' || $peserta->penilaian_karikatur->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_karikatur->rangking }}</td>
                    </tr>
                @endif
                @endforeach
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
                        <p>Malang, {{ $peserta->penilaian_karikatur->first()->created_at->format('d F Y') }}</p>
                        <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
                        <p style="margin-top: 60%;">{{ $peserta->penilaian_karikatur->juri->nama }}</p>
                    </div>                  

                @elseif($mata_lomba->nama == 'DUTA LOGIKA')
                @foreach(${$tab} as $index => $peserta)
                @if($peserta->penilaian_duta_logika->rangking == 'Juara 1' || $peserta->penilaian_duta_logika->rangking == 'Juara 2' || $peserta->penilaian_duta_logika->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_duta_logika->rangking }}</td>
                    </tr>
                @endif
                @endforeach
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
                    <p>Malang, {{ $peserta->penilaian_duta_logika->first()->created_at->format('d F Y') }}</p>
                    <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_duta_logika->juri->nama }}</p>
                </div>    

                @elseif($mata_lomba->nama == 'LKFBB')
                @foreach(${$tab} as $index => $peserta)
                @if($peserta->penilaian_lkfbb->rangking == 'Juara 1' || $peserta->penilaian_lkfbb->rangking == 'Juara 2' || $peserta->penilaian_lkfbb->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->highest_total_nilai }}</td>
                        <td>{{ $peserta->penilaian_lkfbb->rangking }}</td>
                    </tr>
                    @endif
                @endforeach
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
                    <p>Malang, {{ $peserta->penilaian_lkfbb->first()->created_at->format('d F Y') }}</p>
                    <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
                    <p style="margin-top: 60%;">{{ $peserta->penilaian_lkfbb->juri->nama }}</p>
                </div>    
                @endif
            </tbody>
        </table>
    @endif

    @if(isset($tab) && ($tab == 'penilaian_foto'))
        @if($mata_lomba->nama == 'FOTO')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Foto LOGIKA 2025</h3>
        @endif
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
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
                @if($penilaian_foto->rangking == 'Juara 1' || $penilaian_foto->rangking == 'Juara 2' || $penilaian_foto->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian_foto->juri->nama }}</td>
                        <td>{{ $penilaian_foto->pembina->nama }}</td>
                        <td>{{ $penilaian_foto->pembina->pangkalan }}</td>
                        <td>{{ $penilaian_foto->total_nilai }}</td>
                        <td>{{ $penilaian_foto->rangking }}</td>
                    </tr>
                    @endif
                @endforeach
                @endif
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
            <p>Malang, {{ $penilaian_foto->first()->created_at->format('d F Y') }}</p>
            <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
            <p style="margin-top: 60%;">{{ $penilaian_foto->juri->nama }}</p>
        </div>    
    @endif

    @if(isset($tab) && ($tab == 'penilaian_dutaLogika'))
        @if($mata_lomba->nama == 'DUTA LOGIKA')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Duta Logika LOGIKA 2025</h3>
        @endif
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
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
                @if($item->penilaian_duta_logika->rangking == 'Juara 1' || $item->penilaian_duta_logika->rangking == 'Juara 2' || $item->penilaian_duta_logika->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->regu_pembina->nama_regu }}</td>
                        <td>{{ $item->regu_pembina->pembina->pangkalan }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->highest_total_nilai }}</td>
                        <td>{{ $item->penilaian_duta_logika->rangking }}</td>
                    </tr>
                    @endif
                @endforeach
                @endif
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
            <p>Malang, {{ $item->penilaian_duta_logika->first()->created_at->format('d F Y') }}</p>
            <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
            <p style="margin-top: 60%;">{{ $item->penilaian_duta_logika->juri->nama }}</p>
        </div>    
    @endif

    @if(isset($tab) && ($tab == 'penilaian_vidio'))
        @if($mata_lomba->nama == 'VIDIO')
            <h3 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Hasil Lomba Vidio LOGIKA 2025</h3>
        @endif
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
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
                @if($penilaian_vidio->rangking == 'Juara 1' || $penilaian_vidio->rangking == 'Juara 2' || $penilaian_vidio->rangking == 'Juara 3')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian_vidio->juri->nama }}</td>
                        <td>{{ $penilaian_vidio->pembina->nama }}</td>
                        <td>{{ $penilaian_vidio->pembina->pangkalan }}</td>
                        <td>{{ $penilaian_vidio->total_nilai }}</td>
                        <td>{{ $penilaian_vidio->rangking }}</td>
                    </tr>
                @endif
                @endforeach
                @endif
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
            <p>Malang, {{ $penilaian_vidio->first()->created_at->format('d F Y') }}</p>
            <span style="text-align: right; padding-left:30%;">Juri Lomba</span>
            <p style="margin-top: 60%;">{{ $penilaian_vidio->juri->nama }}</p>
        </div>    
    @endif
</body>
</html>