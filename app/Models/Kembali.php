<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $table = 'anggota';

    protected $filliable = ['pinjam_id','tgl_kembali', 'denda'];
}
