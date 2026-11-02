@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Paket Langganan</h1>
            <a href="{{ route('admin.subscription-packages.create') }}" class="btn btn-primary mb-3">+ Tambah Paket
                Langganan</a>
        </div>

        @if (Session('success'))
            <div class="alert alert-success text-success d-flex justify-content-between align-items-center mt-3" role="alert">
                <span>{{ session('success') }}</span>
                <i class="fa-solid fa-check ms-3" aria-hidden="true"></i>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="subscription-packages-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Warna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
        $('#subscription-packages-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.subscription-packages.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_packages', name: 'nama_packages' },
                { data: 'description', name: 'description' },
                { data: 'formatted_price', name: 'price' },
                { data: 'color', name: 'color' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
@endpush