@extends('layout.app')

@section('content')
    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data"
        class="d-block mx-auto w-75 mt-5 card">
        @csrf
        @method('PUT')

        {{-- pengganti @error untuk memunculkan semua err sekaligus --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
            <h3>Tambah Buku</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $book->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="writer" class="form-label">Penulis</label>
                    <input type="text" name="writer" id="writer" class="form-control"
                        value="{{ old('writer', $book->writer) }}">
                    @error('writer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" name="publisher" id="publisher" class="form-control"
                        value="{{ old('publisher', $book->publisher) }}">
                    @error('publisher')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" id="price" class="form-control"
                        value="{{ old('price', $book->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="release_date" class="form-label">Tanggal Rilis</label>
                    <input type="date" name="release_date" id="release_date" class="form-control"
                        value="{{ old('release_date', $book->release_date) }}">
                    @error('release_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="page_of_book" class="form-label">Jumlah Halaman</label>
                    <input type="number" name="page_of_book" id="page_of_book" class="form-control"
                        value="{{ old('page_of_book', $book->page_of_book) }}">
                    @error('page_of_book')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="book_category_id" class="form-label">Kategori Buku</label>
                    <select name="book_category_id" id="book_category_id" class="form-select">
                        <option disabled hidden selected>Pilih</option>
                        @foreach ($bookCategory as $category)
                            <option value="{{ $category->id }}"
                                {{ old('book_category_id', $book->book_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    @php
                        $language = ['Indonesia', 'English', 'Arabic'];
                    @endphp
                    <label for="language" class="form-label">Bahasa</label>
                    {{-- data bahasa tidak ada di db, jadi pilihan dibuat manual --}}
                    <select name="language" id="language" class="form-select">
                        @foreach ($language as $language)
                            <option value="{{ $language }}"
                                {{ old('language', $book->language) == $language ? 'selected' : '' }}>
                                {{ $language }}</option>
                        @endforeach
                    </select>
                    @error('language')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="cover" class="form-label">Sampul Buku</label>

                {{-- Tampilkan Preview sampul lama --}}
                @if ($book->cover)
                    <div class="mb-2">
                        <img src="{{ asset($book->cover) }}" alt="Cover {{ $book->title }}" class="img-thumbnail"
                            style="max-height: 150px;">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah sampul.</small>
                    </div>
                @endif

                <input type="file" name="cover" id="cover"
                    class="form-control @error('cover') is-invalid @enderror">
                @error('cover')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

             <div class="row mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <div id="description"></div>
                <input type="hidden" name="description" id="description-input"
                    value="{{ old('description', $book->description) }}">
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.8/purify.min.js"></script>
    <script>
        const quill = new Quill('#description', {
            theme: 'snow'
        });

        const descriptionInput = document.getElementById('description-input');

        // Render nilai lama/lama dari DB secara aman menggunakan DOMpurify
        if(descriptionInput.value) {
            quill.clipboard.dangerouslyPasteHTML(descriptionInput.value);
        }

        // Sync data tiap kali ada perubahan teks di Quill
        quill.on('text-change', function() {
            document.querySelector('#description-input').value = quill.root.innerHTML;
        });

    </script>
@endpush