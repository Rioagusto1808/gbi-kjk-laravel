<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pelayanan';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function jemaat()
    {
        return $this->belongsToMany(Jemaat::class, 'pelayanan_jemaat', 'pelayanan_id', 'jemaat_id')
            ->withTimestamps();
    }

    public function pelayananIbadah()
    {
        return $this->hasMany(PelayananIbadah::class, 'pelayanan_id');
    }

}
