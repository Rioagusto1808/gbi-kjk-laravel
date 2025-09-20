<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jemaat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jemaat';

    protected $fillable = [
        'name',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'status_pernikahan',
        'pekerjaan',
        'aktif',
        'foto_id',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Relasi ke foto profil
    public function foto()
    {
        return $this->belongsTo(File::class, 'foto_id');
    }

    // Relasi ke keluarga (sebagai kepala keluarga)
    public function keluargaSebagaiKepala()
    {
        return $this->hasOne(Keluarga::class, 'kepala_keluarga_id');
    }

    // Relasi ke keluarga (sebagai anggota)
    public function keluarga()
    {
        return $this->belongsToMany(Keluarga::class, 'keluarga_anggota')
            ->withPivot('hubungan')
            ->withTimestamps();
    }

    // Relasi ke pelayanan
    public function pelayanan()
    {
        return $this->belongsToMany(Pelayanan::class, 'pelayanan_jemaat', 'jemaat_id', 'pelayanan_id')
            ->withTimestamps();
    }

    // Relasi ke absensi ibadah
    public function absensiIbadah()
    {
        return $this->hasMany(IbadahAbsensi::class);
    }

    // Relasi ke event
    public function eventPeserta()
    {
        return $this->hasMany(EventPeserta::class);
    }

    public function pelayananIbadah()
    {
        return $this->hasMany(PelayananIbadah::class, 'jemaat_id');
    }

}
