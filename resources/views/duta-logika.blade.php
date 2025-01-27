<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUTA LOGIKA 2025</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: white;
            color: black;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background: #030000;
            flex-wrap: wrap;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }

        nav {
            flex: 1;
            text-align: center;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #F67630;
        }

        .masuk-button {
            background-color: #FFBC29;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .masuk-button:hover {
            background-color: #FFBC29;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin-top: 0;
        }

        .penalties-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .penalties-table th, .penalties-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .penalties-table th {
            background-color: #f2f2f2;
        }

        .button-container {
            text-align: left;
            margin-top: 20px;
        }

        .button-container a {
            background-color: #EE3637;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .button-container a:hover {
            background-color: #F67630;
        }

    </style>
</head>
<body>
    <header style="padding: 5px">
        <div class="logo-container">
            <img src="{{ asset('img/LOGO 2.png') }}" alt="Logo 1">
            <img src="{{ asset('img/CENDRA 6.png') }}" alt="Logo 2">
            <img src="{{ asset('img/ROSE 2.png') }}" alt="Logo 3">
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/">Timeline</a></li>
                <li><a href="/">Kategori</a></li>
                <li><a href="/">Contact</a></li>
                <li><a href="/">Lokasi</a></li>
                <li><a href="/statistik">Statistik</a></li>
                <li><a href="{{ route('login') }}" class="masuk-button">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <div class="card">
        <h2 style="text-align: center; padding-bottom:2%;">PERSYARATAN DUTA LOGIKA</h2>
        <ul>
            <li>Peserta lomba duta logika sebanyak 2 orang (1 putra dan 1 putri) tiap kontingen.</li>
            <li>Peserta menggunakan pakaian dengan bahan utama koran.</li>
            <li>Peserta mempresentasikan hasil karya.</li>
            <li>Tema pakaian duta logika yang dipakai.</li>
            <li>Sesi presentasi dan wawancara tiap kontingen adalah 3 menit dan 2 menit.</li>
            <li>Peserta menempati tempat yang disediakan oleh panitia.</li>
            <li>Peserta tampil sesuai urutan yang sudah diambil saat TM.</li>
            <li>Peserta tidak diperkenankan membawa catatan saat wawancara dan presentasi.</li>
            <li>Apabila peserta melakukan pelanggaran, maka akan dikenakan pengurangan nilai seperti ketentuan berikut:</li>
        </ul>
        <table class="penalties-table" style="margin-top: 3%; text-align: center;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Sanksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Peserta datang terlambat</td>
                    <td>Mendapat urutan terakhir</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pembina pendamping memasuki area lomba tanpa izin</td>
                    <td>Pengurangan 40 poin</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Peserta membawa contekan dalam bentuk apapun</td>
                    <td>Diskualifikasi</td>
                </tr>
            </tbody>
        </table>

            <h2 style="padding-top: 5%; text-align:center;">KRITERIA PENILAIAN</h2>
            <table class="penalties-table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Kriteria Penilaian</th>
                        <th>Skor Maksimal</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kreativitas dan Inovasi</td>
                        <td>30</td>
                        <td>Menilai orisinalitas desain, pemilihan bahan, dan cara pengolahan bahan yang tidak biasa atau unik.</td>
                    </tr>
                    <tr>
                        <td>Kesesuaian Tema</td>
                        <td>25</td>
                        <td>Menilai kesesuaian desain pakaian dengan tema yang telah ditentukan.</td>
                    </tr>
                    <tr>
                        <td>Kualitas Pengerjaan</td>
                        <td>20</td>
                        <td>Menilai kerapian jahitan, kekuatan sambungan, dan keseluruhan finishing pakaian.</td>
                    </tr>
                    <tr>
                        <td>Penggunaan Bahan Daur Ulang</td>
                        <td>15</td>
                        <td>Menilai jenis dan jumlah bahan daur ulang yang digunakan, serta cara pemanfaatannya.</td>
                    </tr>
                    <tr>
                        <td>Presentasi</td>
                        <td>10</td>
                        <td>Menilai kemampuan peserta dalam menjelaskan proses pembuatan, keunikan desain, dan manfaat dari pakaian yang dibuat.</td>
                    </tr>
                </tbody>
            </table>
        
        <div class="button-container" style="margin-top: 4%; margin-bottom:3%;">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
