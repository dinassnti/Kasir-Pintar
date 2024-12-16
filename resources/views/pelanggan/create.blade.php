@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4">Tambah Pelanggan</h1>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control shadow-sm @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control shadow-sm @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" required>
            @error('no_telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control shadow-sm @error('alamat') is-invalid @enderror" rows="4" required>{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm hover-shadow-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    .form-control {
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        border-color: #268fff;
    }

    .btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .hover-shadow-lg:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .container {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
