<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LKFBB 2025</title>
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
        <h2 style="text-align: center; padding-bottom:2%;">PERSYARATAN LKFBB</h2>
        <ul>
            <li>Setiap regu diwakili oleh 8 orang.</li>
            <li>Durasi pelaksanaan LKFBB adalah maksimal 6 menit/regu.</li>
            <li>Peserta menggunakan seragam pramuka lengkap dan diperbolehkan menggunakan aksesoris tambahan.</li>
            <li>Lokasi pelaksanaan LKFBB adalah di lapangan utama dengan ukuran kavling 7 meter x 7 meter untuk setiap regu yang tampil.</li>
            <li>Urutan penampilan sesuai dengan urutan nomor regu.</li>
            <li>Peserta dilarang menggunakan aksesoris tambahan yang menyebabkan sampah.</li>
            <li>Aksesoris tambahan yang digunakan harus berada di dalam kavling.</li>
            <li>Lomba dimulai setelah terdengar 1 kali peluit panjang.</li>
            <li>1 menit sebelum waktu berakhir, panitia akan mengangkat bendera.</li>
            <li>Penampilan berakhir setelah terdengar 2 kali peluit panjang.</li>
            <li>Formasi yang akan dilakukan peserta:</li>
            <ul>
                <li>Meroda</li>
                <li>Angkare</li>
                <li>Anak panah</li>
                <li>Lingkaran besar</li>
                <li>Bersaf</li>
            </ul>
            <li>Untuk formasi bisa dilakukan dengan urutan bebas, tetapi harus sesuai dengan yang telah ditentukan.</li>
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
                    <td>Peserta dan/atau alat yang digunakan meninggalkan area</td>
                    <td>Pengurangan 10 poin</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Peserta tidak hadir ketika nomor regu dipanggil 3 kali</td>
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
            <td>Ketepatan Formasi</td>
            <td>40</td>
            <td>Menilai ketepatan kreasi formasi yang dibuat. Termasuk di dalamnya variasi gerakan, dan penggunaan ruang.</td>
        </tr>
        <tr>
            <td>Ketepatan Gerakan</td>
            <td>25</td>
            <td>Menilai ketepatan gerakan baris berbaris dalam membentuk formasi. Termasuk di dalamnya ketepatan aba-aba, keselarasan gerakan, dan kecepatan.</td>
        </tr>
        <tr>
            <td>Kekompakan</td>
            <td>15</td>
            <td>Menilai kekompakan anggota regu dalam melakukan gerakan dan perubahan formasi. Termasuk di dalamnya keseragaman gerakan, waktu, dan jarak antar anggota.</td>
        </tr>
        <tr>
            <td>Kelancaran Transisi</td>
            <td>10</td>
            <td>Menilai kelancaran peralihan dari satu formasi ke formasi lainnya. Termasuk di dalamnya kecepatan, ketepatan, dan tanpa adanya kesalahan.</td>
        </tr>
        <tr>
            <td>Penampilan</td>
            <td>10</td>
            <td>Menilai kerapian pakaian, sikap, dan semangat selama melakukan baris berbaris.</td>
        </tr>
    </tbody>
</table>

        <div class="button-container" style="margin-top: 4%; margin-bottom:3%;">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
