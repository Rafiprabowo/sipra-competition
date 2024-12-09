<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register.attempt') }}" class="user">
                                    @csrf
                                    <!-- Username -->
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user"
                                               placeholder="Enter Username" required>
                                        @error('username')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               placeholder="Password" required>
                                        @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Role -->
                                    <div class="form-group">
                                        <select name="role" class="form-control form-control-user" aria-label=".form-select-lg example" required>
                                            <!-- Placeholder dengan value kosong -->
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="pembina">Pembina</option>
                                            <option value="peserta">Peserta</option>
                                            <option value="juri">Juri</option>
                                        </select>
                                        @error('role')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>                                                                  
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
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
</body>
</html>
