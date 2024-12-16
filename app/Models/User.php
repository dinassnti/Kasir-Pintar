<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary Key

    // Field yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama', 'email', 'password', 'role', 'status',
    ];

    // Hidden fields untuk melindungi data sensitif
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Atribut yang di-cast ke tipe data lain.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
