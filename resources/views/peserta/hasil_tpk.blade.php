<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Simulasi CBT TPK</title>
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
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .table-container {
            padding: 20px;
        }
        .btn {
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <div class="card w-75">
        <div class="card-body">
            <h5 class="card-title">Hasil Simulasi CBT TPK</h5>
            <div class="table-container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Jumlah Benar</th>
                            <th>Waktu selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $nama }}</td>
                            <td>{{ $nilai }}</td>
                            <td>{{ $jawaban_benar }}</td> 
                            <td>{{ $durasi }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-left mt-4">
                    <a href="/tpk" class="btn btn-secondary ml-2" title="Kembali">
                        <i class="fas fa-arrow-left"> Kembali</i>
                    </a>
                </div>
            </div>
        </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
</body>
</html>
