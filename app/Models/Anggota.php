<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $filliable = ['anggota_id','anggota_nama', 'anggota_alamat',
                             'anggota_jk', 'anggota_telp'];
}
