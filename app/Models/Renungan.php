<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renungan extends Model
{
    use HasFactory;

    protected $table = 'renungan';

    protected $fillable = [
        'judul',
        'ayat',
        'isi',
        'doa',
        'penulis',
        'status',
    ];
}
