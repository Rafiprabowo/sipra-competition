<!DOCTYPE html>
<html>
<head>
    <title>Data Juri</title>
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

    <h2 style="text-align: center; padding-top: 3%; padding-bottom: 3%;">Data Juri LOGIKA 2025</h2>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Juri</th>
                <th>Kwartir Cabang</th>
                <th>Pangkalan</th>
                <th>Jenis Kelamin</th>
                <th>No Handphone</th>
                <th>Mata Lomba</th>
            </tr>
        </thead>
        <tbody>
            @foreach($juri as $index => $value)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->kwartir_cabang }}</td>
                    <td>{{ $value->pangkalan }}</td>
                    <td>{{ $value->jenis_kelamin }}</td>
                    <td>{{ $value->no_hp }}</td>
                    <td>{{ optional($value->mata_lomba)->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
