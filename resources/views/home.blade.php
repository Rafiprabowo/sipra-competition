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
            background: linear-gradient(to right, #0000ff, #ff00ff);
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: #ff00ff;
        }

        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
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
            color: yellow;
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
        }

        .timeline-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timeline-item {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 1em 0;
            padding: 1em;
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .timeline-date {
            font-weight: bold;
            color: #003366;
        }

        .timeline-content h3 {
            margin: 0.5em 0;
        }

        .timeline-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        #kategori {
            padding: 2em;
            background-color: #0000ff;
            color: #fff;
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

    </style>
</head>
<body>
    <header style="padding: 30px">
        <div class="logo-container">
            <img src="logo1.png" alt="Logo 1">
            <img src="logo2.png" alt="Logo 2">
            <img src="logo3.png" alt="Logo 3">
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#sambutan">Sambutan</a></li>
                <li><a href="#timeline">Timeline</a></li>
                <li><a href="#kategori">Kategori</a></li>
                <li><a href="#statistik">Statistik</a></li>
                <li><a href="{{ route('login') }}">Masuk</a></li>
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
                        <img src="proposal_image.png" alt="Pendaftaran Submit Proposal">
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
                    <img src="iot.png" alt="Internet Of Things">
                    <h3>Internet Of Things</h3>
                </div>
                <div class="kategori-item">
                    <img src="business_planning.png" alt="Perencanaan Bisnis Bidang TIK">
                    <h3>Perencanaan Bisnis Bidang TIK</h3>
                </div>
                <div class="kategori-item">
                    <img src="hackathon.png" alt="Hackathon">
                    <h3>Hackathon</h3>
                </div>
                <div class="kategori-item">
                    <img src="animation.png" alt="Animasi">
                    <h3>Animasi</h3>
                </div>
                <div class="kategori-item">
                    <img src="game_development.png" alt="Pengembangan Aplikasi Bidang Permainan">
                    <h3>Pengembangan Aplikasi Bidang Permainan</h3>
                </div>
                <div class="kategori-item">
                    <img src="e_gov.png" alt="E-Government">
                    <h3>E-Government</h3>
                </div>
                <div class="kategori-item">
                    <img src="cyber_security.png" alt="Keamanan Siber">
                    <h3>Keamanan Siber</h3>
                </div>
                <div class="kategori-item">
                    <img src="innovation.png" alt="Cipta Inovasi Bidang di Bidang TIK">
                    <h3>Cipta Inovasi Bidang di Bidang TIK</h3>
                </div>
            </div>
        </section>
        <aside>
            <img src="logo_kmipn.png" alt="KMIPN V Logo">
        </aside>
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
