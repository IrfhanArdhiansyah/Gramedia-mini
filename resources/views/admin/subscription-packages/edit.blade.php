@extends('layout.app')

@section('content')
    <div class="card mt-5 w-50 d-block mx-auto">
        <div class="card-header">
            <h1>Edit Paket Langganan</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subscription-packages.update', $subscriptionPackage->id) }}" method="POST">
                @method('PUT')
                @csrf
                {{-- @csrf untuk mencegah request yang tidak sah --}}
                <div class="mb-3">
                    <label for="nama_packages" class="form-label">Nama Paket</label>
                    <input type="text" name="nama_packages" id="nama_packages" class="form-control @error('nama_packages') is-invalid @enderror" value="{{ old('nama_packages',$subscriptionPackage->nama_packages) }}" required>

                     @error('nama_packages')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">

                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description',$subscriptionPackage->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$subscriptionPackage->price) }}" required>

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Warna</label>
                    <input type="color" name="color" id="color"
                        class="form-control form-control-color @error('color') is-invalid @enderror"
                        value="{{ old('color', '#000000') }}" required
                        style="max-width: 70px; height: 38px; padding: 3px; cursor: pointer;">

                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection