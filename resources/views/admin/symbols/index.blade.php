@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gambar Semaphore Morse</li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary" style="font-size: 16px;">List Simbol</h5>
                <a href="{{route('symbols.create')}}" class="btn btn-primary" style="font-size: 11px;" title="Add New Symbol">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Huruf</th>
                                <th>Jenis</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($symbols as $symbol)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $symbol->letter }}</td>
                                    <td>{{ ucfirst($symbol->type) }}</td>
                                    <td>
                                        @if($symbol->image)
                                            <img src="{{ Storage::url($symbol->image) }}" alt="{{ $symbol->letter }}" width="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('symbols.edit', $symbol->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit Symbol">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Delete Form -->
                                        <form action="{{ route('symbols.destroy', $symbol->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this symbol?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Symbol">
                                                <i class="fas fa-trash-alt"></i>
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
@endsection

@section('script')
    <script>
        $(function(){
            $('#dataTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
        });
    </script>
@endsection
