@extends('layout.app')

@section('content')
    <div class="container py-4">

        <h2 class="fw-bold mb-4">Kategori Buku: {{ $bookCategory->name }}</h2>

        <form method="GET" action="{{ route('category', $bookCategory->id) }}" class="row g-2 mb-4">
            <div class="col-md-7">
                <div class="input-icon">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-rounded" placeholder="Cari judul, produk, buku, penulis..." />
                    <button type="submit" class="input-icon-addon btn border-0 p-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">Urutkan</option>
                    <option value="termurah" @selected(request('sort') == 'termurah')>Harga termurah</option>
                    <option value="termahal" @selected(request('sort') == 'termahal')>Harga termahal</option>
                    <option value="terbaru" @selected(request('sort') == 'terbaru')>Buku terbaru</option>
                </select>
            </div>
        </form>

        <div class="row g-3">
            @forelse ($books as $book)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body p-2">
                            <h6 class="card-title small mb-1">{{ $book->title }}</h6>
                            <p class="text-muted small mb-1">{{ $book->writer }}</p>
                            <strong>Rp {{ number_format($book->price, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Buku tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
