<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keluarga';

    protected $fillable = [
        'kepala_keluarga_id',
        'alamat',
    ];

    // Kepala keluarga
    public function kepala()
    {
        return $this->belongsTo(Jemaat::class, 'kepala_keluarga_id');
    }

    // Anggota keluarga
    public function anggota()
    {
        return $this->belongsToMany(Jemaat::class, 'keluarga_anggota')
            ->withPivot('hubungan')
            ->withTimestamps();
    }
}
