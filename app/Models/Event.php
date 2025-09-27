<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event';

    protected $fillable = [
        'nama_event',
        'image',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'tema',
        'biaya',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'biaya' => 'decimal:2',
    ];

    public function peserta()
    {
        return $this->hasMany(EventPeserta::class, 'event_id');
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($this->tanggal_mulai > $now) {
            return 'Akan Datang';
        }

        if ($this->tanggal_mulai <= $now && $this->tanggal_selesai && $this->tanggal_selesai >= $now) {
            return 'Sedang Berlangsung';
        }

        return 'Selesai';
    }
}
