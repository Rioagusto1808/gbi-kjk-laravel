<?php

namespace Database\Seeders;

use App\Models\Pelayanan;
use Illuminate\Database\Seeder;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Worship Leader', 'deskripsi' => 'Pemimpin pujian dalam ibadah'],
            ['nama' => 'Singer I',       'deskripsi' => 'Vokal pendukung ibadah'],
            ['nama' => 'Singer II',       'deskripsi' => 'Vokal pendukung ibadah'],
            ['nama' => 'Pemain Bass',    'deskripsi' => 'Musisi instrumen bass'],
            ['nama' => 'Pemain Drum',    'deskripsi' => 'Musisi instrumen drum'],
            ['nama' => 'Pemain Piano',   'deskripsi' => 'Musisi instrumen piano/keyboard'],
            ['nama' => 'Usher I',          'deskripsi' => 'Petugas penyambut jemaat'],
            ['nama' => 'Usher II',          'deskripsi' => 'Petugas penyambut jemaat'],
            ['nama' => 'Multimedia',     'deskripsi' => 'Operator LCD, Proyektor, Sound'],
            ['nama' => 'Doa Syafaat',    'deskripsi' => 'Pendoa dalam ibadah'],
        ];

        foreach ($kategori as $k) {
            Pelayanan::firstOrCreate(
                ['nama' => $k['nama']],
                ['deskripsi' => $k['deskripsi']]
            );
        }
    }
}
