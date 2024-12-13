<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOMBA 2024</title>
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
            background: #332deb;
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
            border-radius: 50%; /* Memberikan efek rounded pada logo */
            border: 2px solid white; /* Menambahkan border putih di sekitar logo */
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
            background-color: #1a1aff; /* Warna latar belakang saat hover */
        }

        .masuk-button {
            background-color: #ff00ff;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease; /* Animasi transisi */
        }

        .masuk-button:hover {
            background-color: #cc00cc; /* Warna latar belakang saat hover */
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
            font-size: 3em;
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
            background-color: #f4f4f4;
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
            background-color: #003366;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        .timeline-item {
            padding: 1em 2em;
            position: relative;
            background-color: inherit;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #003366;
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
            text-align: right;
        }

        .timeline-date {
            font-weight: bold;
            color: #003366;
            margin-bottom: 0.5em;
        }

        .timeline-content {
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
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
            <img src="{{ asset('img/bistik.jpg') }}" alt="Logo 1">
            <img src="{{ asset('img/jaringan.jpg') }}" alt="Logo 2">
            <img src="{{ asset('img/cipta.jpg') }}" alt="Logo 3">
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
        <section class="content">
            <h1>LOMBA 2024</h1>
            <p>Kompetisi Pramuka se SMP di kota Malang</p>
            <h2>Final Surabaya<br>01 Agustus 2023</h2>
            {{-- <div class="countdown">
                <div class="time">
                    <span id="days">0</span>
                    <span>Hari</span>
                </div>
                <div class="time">
                    <span id="hours">0</span>
                    <span>Jam</span>
                </div>
                <div class="time">
                    <span id="minutes">0</span>
                    <span>Menit</span>
                </div>
                <div class="time">
                    <span id="seconds">0</span>
                    <span>Detik</span>
                </div>
            </div> --}}
        </section>

        <section id="timeline">
            <h2>TIMELINE</h2>
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-date">15 Maret - 10 Mei 2023</div>
                    <div class="timeline-content">
                        <h3>PENDAFTARAN DAN SUBMIT PROPOSAL</h3>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">22 Mei 2023</div>
                    <div class="timeline-content">
                        <h3>BABAK PENYISIHAN PERTAMA</h3>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">23 Mei 2023</div>
                    <div class="timeline-content">
                        <h3>BABAK PENYISIHAN</h3>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="kategori">
            <h2>LOMBA</h2>
            <div class="kategori-container">
                <div class="kategori-item">
                    <img src="{{ asset('img/iot.jpg') }}" alt="Internet Of Things">
                    <h3>Internet Of Things</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/bistik.jpg') }}" alt="Perencanaan Bisnis Bidang TIK">
                    <h3>Perencanaan Bisnis Bidang TIK</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/hackathon.jpg') }}" alt="Hackathon">
                    <h3>Hackathon</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/animasi.jpg') }}" alt="Animasi">
                    <h3>Animasi</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/game.jpg') }}" alt="Pengembangan Aplikasi Bidang Permainan">
                    <h3>Pengembangan Aplikasi Bidang Permainan</h3>
                </div>
                <div class="kategori-item">
                    <img src="{{ asset('img/egov.jpg') }}" alt="E-Government">
                    <h3>E-Government</h3>
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
    <script>
        // Countdown timer logic
        const countdownDate = new Date("Aug 1, 2023 00:00:00").getTime();

        const countdownFunction = setInterval(function() {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("[_{{{CITATION{{{_1{](https://github.com/xpros/www/tree/d7f4b372e52ac11dee9f1245353767ec077d55fe/src%2Fcountdown%2Fcountdown.js)[_{{{CITATION{{{_2{](https://github.com/randika480/grid-af-host-testing/tree/67225ae70d72b9b411eddb882d6e41715e28da41/src%2Fcomponents%2FCountDown.js)[_{{{CITATION{{{_3{](https://github.com/santiaguf/spacex-platzi/tree/c02680dc8d4454bc2f881921af9c5f3dbe88cf90/js%2Flaunches.js)[_{{{CITATION{{{_4{](https://github.com/Brymo/CoronaCrew/tree/4a909cb149c4db56c3c72fddbfcfe125dafdd543/main.js)[_{{{CITATION{{{_5{](https://github.com/koldovsky/610-team-3/tree/9ad5ae5a5aa0052d88b50857279917562bfa3acf/js%2Fcountdown.js)
    </script>
</body>
</html>
