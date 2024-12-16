<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'nomor_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'status_pembayaran',
        'id_user',
        'id_shift',
        'id_pelanggan',
        'id_diskon',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Relasi ke Diskon
    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'id_diskon');
    }
}



