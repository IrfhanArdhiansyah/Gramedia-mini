@extends('layout.app')

@section('content')
    <form action="{{ route('login.store') }}" method="POST" class="form-fieldset w-50 bg-white mx-auto mt-5">

        {{-- Notifikasi jika berhasil register --}}
        @if (Session('success'))
            {{-- tulisan session('success') diambil dari bagian controller method with --}}

            <div class="alert alert-success text-success" role="alert">{{ Session::get('success') }}</div>
        @endif

        {{-- Notifikasi jika login gagal --}}
        @if (Session('error'))
            <div class="alert alert-danger text-danger" role="alert">{{ Session::get('error') }}</div>
        @endif

        @csrf
        <h3 class="text-center mb-4">Login</h3>

        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" autocomplete="off" />
            @error('email')
                {{-- memanggil error validasi @error('email') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                autocomplete="off" />
            @error('password')
                {{-- memanggil error validasi @error('password') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
@endsection
