<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbadahAbsensi extends Model
{
    use HasFactory;

    protected $table = 'ibadah_absensi';

    protected $fillable = [
        'ibadah_id',
        'jemaat_id',
        'hadir',
    ];

    public function ibadah()
    {
        return $this->belongsTo(Ibadah::class);
    }

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class);
    }
}
