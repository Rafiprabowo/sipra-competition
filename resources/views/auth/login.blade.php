<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIKA 2025</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        .bg-login-image {
            background: url('{{ asset('img/CENDRA 1.png') }}') center center;
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
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b>LOGIN LOGIKA 2025</b></h1>
                                    <!-- Display Flash Message -->
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login.attempt') }}" class="user">
                                    @csrf
                                    <!-- Username Input -->
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user"
                                               id="exampleInputUsername" placeholder="Masukkan Username"
                                               value="{{ old('username') }}" required autofocus>
                                        @error('username')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Password Input -->
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Masukkan Password" required>
                                        @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Remember Me Checkbox -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                            <label class="custom-control-label" for="customCheck">Ingatkan Saya</label>
                                        </div>
                                    </div>
                                    <!-- Login Button -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a href="{{ route('register') }}">Belum Punya Akun, Register</a>
                                </div>
                                <div class="text-center">
                                    <a href="/">Kembali ke home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
