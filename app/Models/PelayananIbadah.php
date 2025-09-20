<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelayananIbadah extends Model
{
    protected $table = 'pelayanan_ibadah';

    protected $fillable = ['ibadah_id', 'pelayanan_id', 'jemaat_id'];

    public function ibadah()
    {
        return $this->belongsTo(Ibadah::class);
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class);
    }

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class);
    }
}
