<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pelanggans'; 
    
    // Primary key tabel
    protected $primaryKey = 'id_pelanggan'; 
    
    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'alamat',
        'tanggal_bergabung', // Tetap disertakan untuk default tanggal saat pembuatan
    ];

    // Casting tipe data pada atribut tertentu
    protected $casts = [
        'tanggal_bergabung' => 'date',
        'point' => 'integer', // Point akan selalu kosong hingga pelanggan melakukan transaksi
    ];

    // Menonaktifkan kolom "point" untuk input secara manual
    protected static function booted()
    {
        static::creating(function ($pelanggan) {
            $pelanggan->point = 0; // Default point adalah 0
        });
    }
}
