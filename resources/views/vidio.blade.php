<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOMBA VIDEO PANGKALAN TERFAVORIT 2025</title>
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
        <h2>LOMBA VIDEO PANGKALAN TERFAVORIT</h2>
        <ul>
            <li>Tema video: “Makanan Khas Daerah”.</li>
            <li>Video berupa pengenalan makanan khas daerah berbentuk vlog.</li>
            <li>Durasi video 1 sampai dengan 3 menit.</li>
            <li>Video tidak mengandung unsur SARA.</li>
            <li>Video yang dibuat harus original.</li>
            <li>Video dikirim ke panitia melalui email paling lambat 15 Februari 2025 pukul 23.00 WIB.</li>
            <li>Video akan diupload oleh panitia maksimal tanggal 16 Februari 2025.</li>
            <li>Video akan diupload oleh panitia melalui akun Youtube ARVEGATU SCOUT.</li>
            <li>Peserta wajib subscribe akun Youtube panitia, yaitu ARVEGATU SCOUT.</li>
            <li>Penghitungan likes dimulai sejak video diupload sampai dengan 21 Februari 2025 pukul 15.00.</li>
            <li>Kriteria Penilaian:</li>
        </ul>
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
                    <td>Editing Video</td>
                    <td>50</td>
                    <td>Menilai kualitas teknis dan artistik dalam pengeditan video.</td>
                </tr>
                <tr>
                    <td>Likes</td>
                    <td>30</td>
                    <td>Menilai popularitas karya berdasarkan jumlah suka terbanyak</td>
                </tr>
                <tr>
                    <td>Originalitas</td>
                    <td>20</td>
                    <td>Menilai keunikan dan kreativitas ide, konsep, atau cara penyampaian tanpa meniru karya pihak lain.</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>100</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="button-container">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
