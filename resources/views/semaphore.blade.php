<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEMAPHORE DAN MORSE 2025</title>
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
        <h2>SEMAPHORE DAN MORSE</h2>
        <ul>
            <li>Peserta lomba semaphore dan morse sebanyak 1 orang tiap regu.</li>
            <li>Peserta menggunakan pakaian pramuka lengkap.</li>
            <li>Pengerjaan dengan sistem CBT (Computer Based Test).</li>
            <li>Peserta diberikan 15 soal (5 soal semaphore dan 10 soal morse).</li>
            <li>Durasi pengerjaan 30 menit.</li>
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
                    <td>Peserta datang terlambat</td>
                    <td>Tidak ada tambahan waktu</td>
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
                        <td>Ketepatan Jawaban</td>
                        <td>100</td>
                        <td>Jumlah soal yang harus dikerjakan sebanyak 15 soal. Setiap soal terdiri atas 5 huruf. Setiap huruf memiliki poin 1,333 jika jawaban benar, dan poin 0 jika jawaban salah.</td>
                    </tr>
                    <tr>
                        <td>Kecepatan Pengumpulan</td>
                        <td>-</td>
                        <td>Kecepatan pengumpulan digunakan pada saat terdapat skor akhir yang sama antar peserta. Kecepatan pengumpulan akan menentukan peringkat peserta.</td>
                    </tr>
                </tbody>
            </table>

        
        <div class="button-container">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
