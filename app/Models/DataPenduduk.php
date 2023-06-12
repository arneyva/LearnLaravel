<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        // mendefinisikan kolom apa saja yang akan dibuat data dummynya
        // mendefinisikan kolom apa saja yang diisi oleh kita
        'nama',
        'phone',
        'alamat',
        'foto',
    ];
}
