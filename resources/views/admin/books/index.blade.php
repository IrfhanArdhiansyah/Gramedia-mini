@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Buku</h3>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        </div>

        @if (Session('success'))
            <div class="alert alert-success text-success d-flex justify-content-between align-items-center mt-3"
                role="alert">
                <span>{{ session('success') }}</span>
                <i class="fa-solid fa-check ms-3" aria-hidden="true"></i>
            </div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-bordered" id="data-buku">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- Modal Detail --}}
    <div class="modal modal-blur fade" id="modalDetailBook" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                {{-- Modal Header --}}
                <div class="modal-header"> 
                    <h5 class="modal-title">Detail Informasi Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Body --}}
                <div class="modal-body">
                    <div class="row">
                        {{-- Column Cover --}}
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img id="detail-cover" src="" class="rounded shadow-sm border img-fluid" alt="Cover Buku" 
                            style="max-height: 300px; width: 100%; object-fit: cover;">
                        </div>

                        {{-- Column info --}}
                        <div class="col-md-8">
                            <h3 id="detail-title" class="mb-1 text-primary fw-bold"></h3>
                            <div class="mb-3">
                                <span id="detail-category" class="badge bg-blue-lt"></span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pt-2">Harga</div>
                                    <div class="text-success fw-bold" id="detail-price"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2">Penulis</div>
                                    <div class="" id="detail-writer"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2">Penerbit</div>
                                    <div class="" id="detail-publisher"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2">Bahasa</div>
                                    <div class="" id="detail-language"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2">Tanggal Rilis</div>
                                    <div class="" id="detail-release"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2">Jumlah Halaman</div>
                                    <div class="" id="detail-pages"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    </hr>

                    <div>
                        <h4 class="subheader mb-2">Deskripsi Buku</h4>
                        <div id="detail-description" class="p-3 bg-body-tertiary rounded border" style="max-height: 200px; overflow-y: auto;">
                            <span class="text-secondary">Tidak ada deskripsi.</span>
                        </div>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-***" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#data-buku').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.books.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'coverImg',
                        name: 'coverImg',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#data-buku').on('click', '#btn-detail', function() {
                const btn = $(this);

                // Ambil data dari atribut data-*
                const cover = btn.data('cover');
                const title = btn.data('title');
                const category = btn.data('category');
                const price = btn.data('price');
                const writer = btn.data('writer');
                const publisher = btn.data('publisher');
                const language = btn.data('language');
                const release = btn.data('release');
                const pages = btn.data('pages');
                const rawDescription = btn.data('description');

                // Masukkan data ke elemen modal
                $('#detail-cover').attr('src', cover);
                $('#detail-title').text(title);
                $('#detail-category').text(category);
                $('#detail-price').text(price);
                $('#detail-writer').text(writer);
                $('#detail-publisher').text(publisher);
                $('#detail-language').text(language);
                $('#detail-release').text(release);
                $('#detail-pages').text(pages + ' Halaman');
                $('#detail-description').html(rawDescription);

                // Tampilkan modal
                const modalElement = document.getElementById('modalDetailBook');
                $('#modalDetailBook').modal('show');
            });
        });
    </script>
@endpush
