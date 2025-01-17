<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOGIKA 2025</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #030000;
        }

        .container {
            font-size: 14px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .bg-register-image {
            background: url('{{ asset('img/ROSE 5.png') }}') center center;
            background-size: cover;
        }

        h1 {
            font-weight: 700;
        }

        .btn-primary {
            background-color: #EE3637;
            border: none;
            border-radius: 50px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #d12d2e;
        }

        .form-control {
            border-radius: 30px;
            padding: 0.75rem 1.5rem;
            font-size: 14px;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #EE3637;
        }

        .text-gray-900 {
            color: #3a3a3a;
        }

        .alert-success {
            border-radius: 50px;
        }

        .text-center a {
            font-size: 14px;
            color: #333;
            transition: color 0.3s;
        }

        .text-center a:hover {
            color: #EE3637;
        }
    </style>
</head>

<body>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-12 col-md-9" style="margin-top: 100px;">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b>REGISTRASI LOGIKA 2025</b></h1>
                                </div>
                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register.attempt') }}" class="user">
                                    @csrf
                                    <!-- Username -->
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user"
                                               placeholder="Masukkan Username" required>
                                        @error('username')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               placeholder="Masukkan Password" required>
                                        @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Role -->
                                    <div class="form-group">
                                        <select name="role" id="role-select" class="form-control form-control-user" aria-label=".form-select-lg example" required>
                                            <!-- Placeholder dengan value kosong -->
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="pembina">Pembina</option>
                                            <option value="peserta">Peserta</option>
                                            <option value="juri">Juri</option>
                                            <option value="ketua_pelaksana">Ketua Pelaksana</option>
                                        </select>
                                        @error('role')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Buat Akun
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah Punya Akun, Login Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Tambahan JavaScript untuk menampilkan pilihan yang dipilih -->
<script>
    document.getElementById('role-select').addEventListener('change', function() {
        var selectedRole = this.options[this.selectedIndex].text;
        alert('Role yang dipilih: ' + selectedRole);
    });
</script>

</body>
</html>
