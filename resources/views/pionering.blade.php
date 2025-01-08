<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIKA 2025</title>
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
            background: #EE3637;
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
            text-align: left;
        }

        .penalties-table th {
            background-color: #f2f2f2;
        }

        .button-container {
            text-align: center;
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
                <li><a href="/">Lokasi</a></li>
                <li><a href="/statistik">Statistik</a></li>
                <li><a href="{{ route('login') }}" class="masuk-button">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <div class="card">
        <h2>PIONERING</h2>
        <ul>
            <li>Peserta pionering sebanyak 4 orang tiap regu.</li>
            <li>Durasi pelaksanaan lomba selama 90 menit.</li>
            <li>Peserta menggunakan seragam pramuka lengkap.</li>
            <li>Tema pionering yang dibuat adalah Menara Tiang Bendera (dengan pondasi dasar kaki 3).</li>
            <li>Bentuk pionering seluruh peserta sama, sesuai dengan contoh yang diberikan panitia.</li>
            <li>Menggunakan tongkat pramuka dengan ukuran maksimal 160 cm & minimal 50 cm, jumlah tali menyesuaikan.</li>
            <li>Aksesoris yang boleh digunakan hanya bendera WOSM dan TUNAS. Putra: Tunas, Putri: Wosm</li>
            <li>Peserta mempersiapkan peralatan 10 menit sebelum lomba dimulai.</li>
            <li>Lokasi pelaksanaan adalah di lapangan barat dengan ukuran kavling 3 meter x 3 meter.</li>
            <li>Lomba dimulai setelah terdengar 1 kali peluit panjang.</li>
            <li>Waktu pengerjaan pionering berakhir setelah terdengar 2 kali peluit panjang.</li>
            <li>Hasil pionering dibongkar setelah dinilai dan didokumentasikan oleh juri dan dilaksanakan pada giat II oleh 7 anggota regu (selain peserta Duta LOGIKA).</li>
            <li>Apabila peserta melakukan pelanggaran, maka akan dikenakan pengurangan nilai seperti ketentuan berikut:</li>
        </ul>
        <table class="penalties-table">
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
                    <td>Peserta dan/atau alat yang digunakan meninggalkan area</td>
                    <td>Pengurangan 10 poin</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Peserta dilarang meminjam atau meminjamkan alat kepada peserta lain</td>
                    <td>Pengurangan 10 poin untuk setiap regu yang meminjam</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Memotong tali saat perlombaan</td>
                    <td>Pengurangan 10 poin</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Peserta datang terlambat</td>
                    <td>Tidak ada penambahan waktu</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Pelatih atau pendamping masuk ke area perlombaan tanpa izin</td>
                    <td>Diskualifikasi</td>
                </tr>
            </tbody>
        </table>

            <h2 style="padding-top: 5%;">Kriteria Penilaian</h2>
            <table class="penalties-table">
                <thead>
                    <tr>
                        <th>Kriteria Penilaian</th>
                        <th>Skor Maksimal</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kekuatan Struktur</td>
                        <td>40</td>
                        <td>Evaluasi kekuatan menara dalam menahan beban, termasuk saat dipanjat. Dinilai berdasarkan stabilitas, ketebalan ikatan, dan pemilihan bahan.</td>
                    </tr>
                    <tr>
                        <td>Ketepatan Ikatan</td>
                        <td>15</td>
                        <td>Setiap jenis ikatan harus digunakan sesuai fungsinya.</td>
                    </tr>
                    <tr>
                        <td>Kerapian Ikatan</td>
                        <td>15</td>
                        <td>Ikatan harus dibuat dengan rapi dan kuat sehingga tidak mudah lepas.</td>
                    </tr>
                    <tr>
                        <td>Kesesuaian Fungsi</td>
                        <td>30</td>
                        <td>Evaluasi apakah menara berfungsi dengan baik sebagai tiang bendera, termasuk tinggi yang sesuai dan kemudahan pemasangan bendera.</td>
                    </tr>
                </tbody>
            </table>
        
        <div class="button-container">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
