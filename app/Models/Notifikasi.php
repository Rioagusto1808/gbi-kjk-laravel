<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifikasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifikasi';

    protected $fillable = [
        'judul',
        'pesan',
        'tipe',
        'target',
        'dikirim_pada',
    ];

    protected $casts = [
        'target' => 'array',
        'dikirim_pada' => 'datetime',
    ];
}
