@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Transaksi</h1>
    
    <!-- Tampilkan pesan jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel transaksi -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($transaksi as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->pelanggan->nama ?? 'Tidak Ada' }}</td>
        <td>{{ $item->tanggal_transaksi }}</td>
        <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
        <td>
            <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">Tidak ada data transaksi.</td>
    </tr>
@endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol tambah transaksi -->
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mt-3">Tambah Transaksi</a>
</div>
@endsection
