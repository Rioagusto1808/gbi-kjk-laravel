<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeuanganTransaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keuangan_transaksi';

    protected $fillable = [
        'tipe',
        'jumlah',
        'kategori',
        'keterangan',
        'tanggal',
        'dibuat_oleh',
    ];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
