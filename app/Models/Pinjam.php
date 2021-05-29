<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';

    protected $filliable = ['buku_id', 'anggota_id',
                             'tgl_pinjam', 'tgl_jatuh_tempo'];
}
