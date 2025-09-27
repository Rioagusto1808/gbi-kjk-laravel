<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibadah extends Model
{
    use HasFactory;

    protected $table = 'ibadah';

    protected $fillable = [
        'jenis',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'tema',
        'ayat',
        'gembala',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // Relasi ke absensi jemaat
    public function absensi()
    {
        return $this->hasMany(IbadahAbsensi::class, 'ibadah_id');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'Akan Datang');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'Sedang Berlangsung');
    }

    public function scopeFinished($query)
    {
        return $query->where('status', 'Selesai');
    }

    public function pelayananIbadah()
    {
        return $this->hasMany(pelayananIbadah::class, 'ibadah_id');
    }
}
