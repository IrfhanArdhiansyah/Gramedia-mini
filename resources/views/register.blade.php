@extends('layout.app')

@section('content')
    <form action="{{ route('register.store') }}" method="POST" class="form-fieldset w-50 bg-white d-block mx-auto mt-5">
        {{-- token : kunci agar data di form bisa diambil controller --}}
        @csrf
        <h2 class="text-center mb-4">Daftar Akun</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Berhasil!</h4>
                        <div class="text-secondary">{{ session('success') }}</div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label required" for="fieldset-name">Nama Lengkap</label>
            <input type="text" id="fieldset-name" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" autocomplete="name" required />
            @error('name')
                {{-- memanggil error validasi @error('namainput') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required" for="fieldset-email">Email</label>
            <input type="email" id="fieldset-email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" autocomplete="email" required />
            @error('email')
                {{-- memanggil error validasi @error('emailinput') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required" for="fieldset-password">Password</label>
            <input type="password" id="fieldset-password" name="password" class="form-control @error('password') is-invalid @enderror"
                autocomplete="password" required />
            @error('password')
                {{-- memanggil error validasi @error('password') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
    </form>
@endsection
