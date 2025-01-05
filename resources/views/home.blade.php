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

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px;
        }

        .content {
            max-width: 600px;
            justify-content: left;
            text-align: left;
        }

        h1 {
            font-size: 2em;
            margin: 0;
        }

        h2 {
            font-size: 2em;
            color: black;
        }

        .countdown {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .time {
            text-align: center;
        }

        .time span {
            display: block;
            font-size: 2em;
        }

        aside img {
            height: 300px;
        }

        #timeline {
            padding: 2em;
            color: #000;
            font-family: 'Arial', sans-serif;
        }

        .timeline-container {
            position: relative;
            margin: 2em 0;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #FFBC29;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        .timeline-item {
            padding: 1em 2em;
            position: relative;
            background-color: inherit;
            width: 80%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #FFBC29;
            border: 3px solid #ffffff;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
            text-align: left;
            transform: translateX(-100%);
        }

        .timeline-item:nth-child(odd) {
            left: 50%;
            text-align: left;
            transform: translateX(-100%);
        }

        .timeline-date {
            font-weight: bold;
            color: #ED3237;
            margin-bottom: 0.5em;
        }

        .timeline-content {
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .timeline-content h3 {
            margin: 0.5em 0;
        }

        #kategori {
            padding: 2em;
            background-color: white;
            color: black;
            text-align: center;
        }

        .kategori-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .kategori-item {
            margin: 1em;
            padding: 1em;
            background-color: white;
            color: #000;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 200px;
            text-align: center;
        }

        .kategori-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .kategori-item h3 {
            margin-top: 0.5em;
        }

        .container { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px; 
        } 
        
        .text { 
            max-width: 50%; 
        } 
        
        .text h1 { 
            font-size: 24px; 
            color: #333; 
        } 
        
        .text p { 
            font-size: 16px; 
            color: #666; 
        } 

        .map { 
            max-width: 45%; 
        } 
        
        iframe { 
            width: 100%; 
            height: 300px; 
            border: 0; 
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
                <li><a href="#timeline">Timeline</a></li>
                <li><a href="#kategori">Kategori</a></li>
                <li><a href="#lokasi">Lokasi</a></li>
                <li><a href="{{ route('login') }}" class="masuk-button">Masuk</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="content" style="text-align: center;">
            <h1>LOGIKA (LOMBA GIAT PRAMUKA) II ARVEGATU</h1>
            <p>Lomba Giat Pramuka Arvegatu <br> Tingkat Penggalang SD/MI Sederajat <br> se-Jawa Timur</p>
        </section>

        <section id="timeline" style="text-align: center">
            <h2>Timeline Lomba</h2>
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-date">9 Desember 2024 - 1 Februari 2025</div>
                    <div class="timeline-content">
                        <h3>Pendaftaran</h3>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">1 Februari 2025</div>
                    <div class="timeline-content">
                        <h3>Technical Meeting</h3>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">22 Februari 2025</div>
                    <div class="timeline-content">
                        <h3>Pendaftaran Ulang</h3>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">22 Februari 2025</div>
                    <div class="timeline-content">
                        <h3>Pelaksanaan Lomba</h3>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="kategori">
            <h2>LOMBA</h2>
            <div class="kategori-container">
                <div class="kategori-item">
                    <img src="{{ asset('img/ROSE 1.png') }}" alt="Pionering">
                    <h3>Pionering</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/CENDRA 4.png') }}" alt="Karikatur">
                    <h3>Karikatur</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/ROSE 3.png') }}" alt="Duta Logika">
                    <h3>Duta Logika</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/CENDRA 2.png') }}" alt="LKFBB">
                    <h3>LKFBB</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/ROSE 6.png') }}" alt="Tes Kemampuan Kepramukaan">
                    <h3>Tes Kemampuan Kepramukaan</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/CENDRA 5.png') }}" alt="Semaphore & Morse">
                    <h3>Semaphore & Morse</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/ROSE 4.png') }}" alt="Foto">
                    <h3>Foto</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/CENDRA 3.png') }}" alt="Vidio">
                    <h3>Vidio</h3>
                </div>
            </div>
        </section>

        <h2>Lokasi Kami</h2>
        <div class="container" id="lokasi"> 
            <div class="text"> 
                <h1>SMP Negeri 4 Malang</h1> 
                <p>Jl. Veteran No.37, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p> 
                <p>Indonesia, Malang</p> 
            </div> 
            <div class="map"> 
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.059097145618!2d112.6135982!3d-7.9575145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7882792b507679%3A0x4d623f89a0f344ea!2sSMP%20Negeri%204%20Malang!5e0!3m2!1sen!2sid!4v1696931234567!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe> 
            </div>
        </div>
    </main>
    
</body>
</html>
