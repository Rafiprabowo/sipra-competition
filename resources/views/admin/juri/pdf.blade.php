<!DOCTYPE html>
<html>
<head>
    <title>Data Juri</title>
    <style>
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            height: 100px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
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

    <h2 style="text-align: center; padding-top:5%;">Data Juri LOGIKA 2025</h2>
    <table>
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
