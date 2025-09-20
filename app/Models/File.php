<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'nama_asli',
        'path',
        'mime_type',
        'size',
        'kategori',
        'uploaded_by',
    ];

    // Relasi ke user (uploader)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Relasi ke berita (pivot)
    public function berita()
    {
        return $this->belongsToMany(Berita::class, 'berita_files')
            ->withPivot('tipe')
            ->withTimestamps();
    }
}
