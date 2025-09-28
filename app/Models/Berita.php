<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'author_id',
        'published_at',
    ];

    protected $casts = [
        'judul' => 'string',
        'isi' => 'string',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'berita_files', 'berita_id', 'file_id')
            ->withPivot('tipe')
            ->withTimestamps();
    }

    // Shortcut: ambil semua foto
    public function photos()
    {
        return $this->files()->wherePivot('tipe', 'gambar');
    }

    // Shortcut: ambil semua lampiran selain foto
    public function attachments()
    {
        return $this->files()->wherePivot('tipe', 'lampiran');
    }

    public function getRouteKeyName()
    {
        return 'id'; // atau 'slug' kalau kamu punya kolom slug
    }
}
