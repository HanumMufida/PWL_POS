<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode'=> 0001,'kategori_nama' => 'Makanan Ringan'],
            ['kategori_id' => 2, 'kategori_kode'=> 0002,'kategori_nama' => 'Makanan Siap Saji'],
            ['kategori_id' => 3, 'kategori_kode'=> 0003,'kategori_nama' => 'Roti'],
            ['kategori_id' => 4, 'kategori_kode'=> 0004,'kategori_nama' => 'Soft Drink'],
            ['kategori_id' => 5, 'kategori_kode'=> 0005,'kategori_nama' => 'Bumbu'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
