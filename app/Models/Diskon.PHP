<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon'; // Nama tabel di database

    protected $primaryKey = 'id_diskon'; // Primary key

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_diskon',
        'persentase',
        'nominal',
        'tanggal_mulai',
        'tanggal_berakhir',
    ];
}
