@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i data-feather="user" class="me-2"></i>
                    <h5 class="mb-0">Profil Pengguna</h5>
                </div>
                <div class="card-body">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Profile Form -->
                    <form method="POST" action="{{ route('profile.update') }}" class="mb-4">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="text-secondary">Informasi Profil</h5>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i data-feather="save" class="me-2"></i>Simpan Perubahan Profil
                        </button>
                    </form>

                    <hr>

                    <!-- Change Password Form -->
                    <form method="POST" action="{{ route('password.update') }}" class="mb-4">
                        @csrf
                        @method('PUT')

                        <h5 class="text-secondary">Ubah Password</h5>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i data-feather="key" class="me-2"></i>Ubah Password
                        </button>
                    </form>

                    <hr>

                    <!-- Delete Account Form -->
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <h5 class="text-danger">Hapus Akun</h5>
                        <div class="alert alert-warning text-center">
                            <i data-feather="alert-circle" class="me-2"></i>
                            <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. Akun Anda akan dihapus secara permanen.
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            <i data-feather="trash-2" class="me-2"></i>Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    feather.replace();
</script>
@endsection
