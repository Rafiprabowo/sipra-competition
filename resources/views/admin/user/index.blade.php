@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>        
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert"> {{ session('error') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 16px;">Data Users</h6>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-md" style="font-size: 11px;" title="Tambah">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($user->foto_profil)
                                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto user" style="width:100px;">
                                    @else
                                        <span>null</span>
                                    @endif
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk mengaktifkan DataTables dan fitur export -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Export Excel',
                        titleAttr: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> Export PDF',
                        titleAttr: 'Export to PDF'
                    }
                ],
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
