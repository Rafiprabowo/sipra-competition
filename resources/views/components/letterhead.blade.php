<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Letterhead</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .letterhead {
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo-left {
            float: left;
            width: 50px;
        }
        .logo-right {
            float: right;
            width: 50px;
        }
        .text-center {
            text-align: center;
        }
        h2 {
            font-size: 18px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        h3 {
            font-size: 14px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        h1 {
            font-size: 20px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        p {
            font-size: 12px; /* Sesuaikan ukuran font */
            margin: 0;
        }
        hr {
            border: 3px solid black;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="letterhead" style="text-align: center;">
        <img src="{{ $base64LogoKiri }}" alt="Logo Kiri" class="kiri">
        <div class="center-text">
            <h2>GERAKAN PRAMUKA</h2>
            <h3>GUGUS DEPAN KOTA MALANG 04571-04572</h3>
            <h1>PANGKALAN ARVEGATU SMPN 4 MALANG</h1>
            <p>Jalan Veteran 37 Malang 65145 telepon (0341) 551289 Fax. (0341) 574062</p>
        </div>
        <img src="{{ $base64LogoKanan }}" alt="Logo Kanan" class="kanan">
    </div>
    <hr style="border: 3px solid black; clear: both;">
</body>
</html>
