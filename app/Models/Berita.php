<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
