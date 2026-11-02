@extends('layout.app')

@push('styles')
    <style>
        .slick-prev:before,
        .slick-next::before {
            color: #333;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        @if (Session('success'))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon me-2" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>{{ Session('success') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon alert-icon me-2">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                    <div>{{ Session('error') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div id="carousel-sample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" alt="" src="{{ asset('images/book-banner2.png') }}" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt="" src="{{ asset('images/book-banner2.png') }}" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt="" src="{{ asset('images/book-banner2.png') }}" />
                </div>
            </div>
            <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        {{-- Paket Langganan --}}

        <div class="mt-4">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-yellow text-yellow-fg p-2"><i class="fa-solid fa-crown fs-3"></i></span>
                <h2 class="m-3 text-dark">Paket Langganan</h2>
            </div>
        </div>

        <div class="row g-4 px-3">
            @forelse ($subscriptionPackages as $subscriptionPackage)
                <div class="col-md-4">
                    <div class="card h-100" style="background: {{ $subscriptionPackage->color }};">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-dark row">
                            <div class="col-4"></div>
                            <div class="col-6 text-center text-dark">
                                <h2 style="font-weight: bold">{{ $subscriptionPackage->nama_packages }}</h2>
                                <p class="text-secondary" style="font-weight: bold; margin: 0 !important">PACKAGE</p>
                                <div>
                                    Rp <span style="font-size: 2rem; font-weight: bold"
                                        class="text-warning">{{ number_format($subscriptionPackage->price, 0, ',', '.') }}</span>
                                    <br>
                                    <span style=" font-weight: bold margin: 0 !important" class="text-secondary">/30
                                        Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada paket langganan.</p>
            @endforelse
        </div>

        {{-- Buku terbaru --}}
        <div class="mt-4">
            <div class="d-flex align-items-center gap-2">
                <h2 class="mt-3 text-dark">Buku Baru Dirilis</h2>
            </div>

            <div id="wrapper-slider">
                @forelse ($latestBooks as $book)
                    <div class="px-2 py-2">
                        <div class="card" style="padding: 0.75rem; border-radius: 16px;">
                            <div class="card-body">
                                <img class="d-block mx-auto w-40 h-50" alt="" src="{{ asset($book->cover) }}" />
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <p class="bagde"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="bagde">10+</p>
                            </div>
                            <div>
                                <h5><span style="font-size: 0.8rem;" class="text-secondary"> {{ $book->writer }} </span>
                                    <br><span style="font-size: 1rem;">{{ $book->title }}</span>
                                </h5>
                                <h4 syle="font-size: 1.2rem; font-weight: bold">
                                    {{ number_format($book->price, 0, ',', '.') }} </h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada buku terbaru.</p>
                @endforelse
            </div>
        </div>

        {{-- buku gratis --}}
        <div class="mt-4">
            <div class="d-flex align-items-center gap-2">
                <h2 class="mt-3 text-dark">Buku Gratis</h2>
            </div>
            <div class="row">
                @forelse ($freeBooks as $book)
                    <div class="col-4">
                        <div class="card d-flex flex-column">
                            <div class="row row-0 flex-fill">
                                <div class="col-md-3">
                                    <a href="#">
                                        <img src="{{ asset($book->cover) }}" class="w-100 h-100 object-cover"
                                            alt="Card side image">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="card-body h-full d-flex flex-column">
                                        <h3 class="card-title">
                                            <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                        </h3>
                                        <div class="text-secondary">
                                            Penulis
                                            <br><span class="text-dark">{{ $book->writer }}</span>
                                        </div>
                                        <div class="d-flex align-items-center pt-4 mt-auto">
                                            <h3><span class="text-decoration-line-through text-secondary">Rp 999.000</span>
                                                <span class="text-dark">Rp 0</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada buku gratis.</p>
                @endforelse
            </div>
        </div>
    @endsection
    {{-- menambahkan konten --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#wrapper-slider').slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });
            })
        </script>
    @endpush
