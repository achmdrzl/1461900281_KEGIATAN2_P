<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $filliable = ['buku_judul', 'kategori_id',
                             'buku_deskripsi', 'buku_jumlah',
                            'buku_cover'];
}
