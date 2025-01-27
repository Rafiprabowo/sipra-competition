<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi CBT TPK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Impor CSS DataTables -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body {
            background-color: #030000;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #EE3637;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #EE3637;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="card">
        <h5 class="card-title">Mulai Simulasi CBT TPK</h5>
        <form id="startForm" action="{{route('simulasi_tpk.start', ['nomor_soal' => 1])}}" method="GET">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Mulai</button>
        </form>
    </div>

    <!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle (termasuk Popper.js) -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- SB Admin 2 (menggunakan Bootstrap) -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
</body>
</html>
