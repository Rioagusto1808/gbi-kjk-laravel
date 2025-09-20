<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPeserta extends Model
{
    use HasFactory;

    protected $table = 'event_peserta';

    protected $fillable = [
        'event_id',
        'jemaat_id',
        'status',
        'hadir',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
}
