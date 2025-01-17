<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOMBA FOTO PANGKALAN TERFAVORIT 2025</title>
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
                <li><a href="/">Lokasi</a></li>
                <li><a href="/statistik">Statistik</a></li>
                <li><a href="{{ route('login') }}" class="masuk-button">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <div class="card">
        <h2 style="text-align: center; padding-bottom:2%;">PERSYARATAN FOTO PANGKALAN</h2>
        <ul>
            <li>Tema foto: “Kegiatan Lomba”.</li>
            <li>Format foto dalam JPG/JPEG.</li>
            <li>Posisi foto landscape.</li>
            <li>Editing foto yang diperbolehkan hanya lighting dan saturasi.</li>
            <li>Tidak boleh mengandung unsur SARA.</li>
            <li>Foto diupload melalui akun Instagram masing-masing pangkalan/pembina/peserta dengan ketentuan:</li>
            <ul>
                <li>Follow akun @arvegatuscout.</li>
                <li>Mencantumkan nama pangkalan.</li>
                <li>Caption bebas sesuai dengan foto.</li>
                <li>Foto di “tag” ke akun Instagram @arvegatuscout.</li>
            </ul>
            <li>Mencantumkan hashtag:</li>
            <ul>
                <li>#LOGIKAARVEGATU2025</li>
                <li>#ARVEGATUSCOUT</li>
                <li>#IKRAR</li>
                <li>#KWARCABKOTAMALANG</li>
                <li>#KWARDAJATIM</li>
                <li>#GERAKANPRAMUKA</li>
                <li>#PRAMUKAADALAHKANTORBERITA</li>
            </ul>
            <li>Foto akan di repost oleh admin.</li>
            <li>Upload foto maksimal jam 11.00.</li>
            <li>Foto akan diupload panitia pada jam 11.00 - 11.30. Penilaian like akan dibatasi sampai jam 15.00 dari foto diupload.</li>
            <li>Kriteria penilaian:</li>
        </ul>

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
                    <td>Pemilihan momen</td>
                    <td>60</td>
                    <td>Menilai pemilihan waktu dan suasana yang tepat untuk menangkap gambar yang bermakna dan menarik selama kegiatan berlangsung</td>
                </tr>
                <tr>
                    <td>Angle</td>
                    <td>30</td>
                    <td>Menilai sudut pandang kamera yang digunakan untuk mengambil foto sesuai teknik fotografi.</td>
                </tr>
                <tr>
                    <td>Caption</td>
                    <td>10</td>
                    <td>Menilai teks singkat yang menjelaskan atau memberikan interpretasi terhadap hasil foto yang telah diunggah.</td>
                </tr>
            </tbody>
        </table>
        <div class="button-container" style="margin-top: 4%; margin-bottom:3%;">
            <a href="/">Kembali</a>
        </div>
    </div>
    
</body>
</html>
