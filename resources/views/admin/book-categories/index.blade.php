@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Kategori Buku</h1>
            <a href="{{ route('admin.book-categories.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori Buku</a>
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
            <table class="table table-bordered" id="book-categories-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
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
        $('#book-categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.book-categories.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush

