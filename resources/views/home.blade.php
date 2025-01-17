
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIKA 2025</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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

        aside img {
            height: 300px;
        }

        #timeline {
    padding: 2em;
    color: #000;
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
}

.timeline-container {
    position: relative;
    margin: 2em 0;
    max-width: 1000px; /* Adjust max-width to make it wider */
    margin-left: auto;
    margin-right: auto;
}

.timeline-container::after {
    content: '';
    position: absolute;
    width: 4px;
    background-color: black;
    top: 0;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}

.timeline-item-left, .timeline-item-right {
    padding: 1em 2em; /* Adjust padding for more space */
    position: relative;
    background-color: inherit;
    width: 45%; /* Adjust width to make divs wider */
    box-sizing: border-box;
    transition: transform 0.3s, background-color 0.3s;
}

.timeline-item-left:hover, .timeline-item-right:hover {
    transform: scale(1.05);
    background-color: #ffe6e6;
}

.timeline-item-left::after, .timeline-item-right::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: black;
    border: 3px solid #ffffff;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;
    z-index: 1;
    transition: background-color 0.3s;
}

.timeline-item-left {
    left: 0;
    text-align: right;
}

.timeline-item-left::after {
    right: -10px;
}

.timeline-item-right {
    left: 50%;
    text-align: left;
}

.timeline-item-right::after {
    left: -10px;
}

.timeline-date-left {
    font-weight: bold;
    margin-bottom: 0.5em;
    width: 150px;
    color: black;
}

.timeline-date-right {
    font-weight: bold;
    margin-bottom: 0.5em;
    width: 400px;
    color: black;
}

.timeline-content-right {
    padding: 1em;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.timeline-content-left {
    padding: 1em;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.timeline-content-left p, .timeline-content-right p {
    margin: 0;
    word-wrap: break-word; /* Ensure long words wrap to the next line */
}

@media screen and (max-width: 600px) {
    .timeline-item-left, .timeline-item-right {
        width: 100%;
        text-align: center;
    }

    .timeline-item-left::after, .timeline-item-right::after {
        left: 50%;
        transform: translateX(-50%);
    }
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
            flex: 1 1 calc(25% - 2em); /* Adjusted to fit 4 items per row */
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
            <img src="{{ asset('img/LOGO 2.png') }}" alt="Logo 1" style="margin-left: 50px;">
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#timeline">Timeline</a></li>
                <li><a href="#kategori">Kategori</a></li>
                <li><a href="#lokasi">Lokasi</a></li>
                <li><a href="/statistik">Statistik</a></li>
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
                <div class="timeline-item-left">
                    <div class="timeline-date-left">9 Desember 2024 - 1 Februari 2025</div>
                    <div class="timeline-content-left">
                        <p>PENDAFTARAN</p>
                    </div>
                </div>
                <div class="timeline-item-right">
                    <div class="timeline-date-right">1 Februari 2025</div>
                    <div class="timeline-content-right">
                        <p>TECHNICAL MEETING</p>
                    </div>
                </div>
                <div class="timeline-item-left">
                    <div class="timeline-date-left">22 Februari 2025</div>
                    <div class="timeline-content-left">
                        <p>PENDAFTARAN ULANG</p>
                    </div>
                </div>
                <div class="timeline-item-right">
                    <div class="timeline-date-right">22 Februari 2025</div>
                    <div class="timeline-content-right">
                        <p>PELAKSANAAN LOMBA</p>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <section id="kategori">
            <h2>LOMBA</h2>
            <div class="kategori-container">
                <a class="kategori-item" href="/pionering" style="text-decoration: none;">
                    <img src="{{ asset('img/ROSE 1.png') }}" alt="Pionering" style="margin-top: 14%;">
                    <h3>Pionering</h3>
                </a>
                <a class="kategori-item" href="/karikatur" style="text-decoration: none;">
                    <img src="{{ asset('img/CENDRA 4.png') }}" alt="Karikatur">
                    <h3>Karikatur</h3>
                </a>
                <a class="kategori-item" href="/duta-logika" style="text-decoration: none;">
                    <img src="{{ asset('img/ROSE 3.png') }}" alt="Duta Logika" style="margin-top: 14%;">
                    <h3>Duta Logika</h3>
                </a>
                <a class="kategori-item" href="/lkfbb" style="text-decoration: none;">
                    <img src="{{ asset('img/CENDRA 2.png') }}" alt="LKFBB">
                    <h3>LKFBB</h3>
                </a>
            </div>
            <div class="kategori-container">
                <a class="kategori-item" href="/tpk" style="text-decoration: none;">
                    <img src="{{ asset('img/ROSE 6.png') }}" alt="Tes Kemampuan Kepramukaan" style="margin-top: 14%;">
                    <h3>Tes Kemampuan Kepramukaan</h3>
                </a>
                <a class="kategori-item" href="/semaphore" style="text-decoration: none;">
                    <img src="{{ asset('img/CENDRA 5.png') }}" alt="Semaphore & Morse">
                    <h3>Semaphore & Morse</h3>
                </a>
                <a class="kategori-item" href="/foto" style="text-decoration: none;">
                    <img src="{{ asset('img/ROSE 4.png') }}" alt="Foto" style="margin-top: 14%;">
                    <h3>Foto</h3>
                </a>
                <a class="kategori-item" href="/vidio" style="text-decoration: none;">
                    <img src="{{ asset('img/CENDRA 3.png') }}" alt="Vidio">
                    <h3>Vidio</h3>
                </a>
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
    <footer style="background-color: #030000; color: #ffffff; padding: 20px; text-align: center;">
        <div style="margin-bottom: 20px;">
            <img src="{{ asset('img/LOGO 1.png') }}" alt="Logo 1" style="width:100px;">
        </div>
        <div style="margin-bottom: 20px;">
            <a href="https://www.facebook.com/arvegatu.esempeempat" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Facebook">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.youtube.com/@arvegatuscout1995" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Youtube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="+62 341 551289" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Phone">
                <i class="fa fa-phone"></i>
            </a>
            <a href="https://www.instagram.com/arvegatuscout/" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
        <div style="margin-bottom: 20px;">
            <p>LOGIKA II ©2025. All rights reserved.</p>
            <p>SMP Negeri 4 Malang</p>
        </div>
    </footer>
    
</body>
</html>
