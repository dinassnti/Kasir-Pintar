<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStaff extends Model
{
    use HasFactory;
    
    protected $table = 'data_staff'; // Nama tabel
    protected $primaryKey = 'id_data_staff'; // Nama kolom primary key
    public $timestamps = true; // Jika tabel menggunakan timestamps
    protected $fillable = [
        'id_user', 'nama', 'email', 'no_telepon', 'alamat', 'password', 'level_akses', 'status_aktif'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
