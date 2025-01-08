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
            flex-wrap: wrap; /* Agar elemen bisa membungkus dalam beberapa baris jika tidak muat */
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
            flex: 1; /* Agar elemen nav mengisi ruang yang tersedia */
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
            transition: background 0.3s ease; /* Animasi transisi */
        }

        nav ul li a:hover {
            background-color: #F67630; /* Warna latar belakang saat hover */
        }

        .masuk-button {
            background-color: #FFBC29;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease; /* Animasi transisi */
        }

        .masuk-button:hover {
            background-color: #FFBC29; /* Warna latar belakang saat hover */
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

    <div>
        <h1 style="text-align: center; margin-top:2%;">DATA STATISTIK</h1>
    </div>
    <div style="display: flex; justify-content: center; padding-top: 40px; gap: 20px; flex-wrap: wrap;">
        <div style="background: linear-gradient(45deg, #4099ff, #73b4ff); color: white; border-radius: 15px; text-align: center; width: 300px;  height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Total Pangkalan</p>
            <p style="font-size: 30px; font-weight: bold;">36</p>
        </div>
        <div style="background: linear-gradient(45deg, #2ed8b6, #59e0c5); color: white; border-radius: 15px; text-align: center; width: 300px;  height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Pangkalan Sudah Diverifikasi</p>
            <p style="font-size: 30px; font-weight: bold;">34</p>
        </div>
        <div style="background: linear-gradient(45deg, #FF5370, #ff869a); color: white; border-radius: 15px; text-align: center; width: 300px;  height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Pangkalan Belum Diverifikasi</p>
            <p style="font-size: 30px; font-weight: bold;">19</p>
        </div>
    </div>
</body>
</html>
