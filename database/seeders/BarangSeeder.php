<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   'barang_id' => 1, 
                'kategori_id'=> 1,
                'barang_kode' => 'MakRin01',
                'barang_nama' => 'Japota Pedas Jeruk 160gr',
                'harga_beli'=> '7500',
                'harga_jual' => '10000'
            ],
            [   'barang_id' => 2, 
                'kategori_id'=> 1,
                'barang_kode' => 'MakRin02',
                'barang_nama' => 'Lays Rendang 160gr',
                'harga_beli'=> '10000',
                'harga_jual' => '16000'
            ],
            [   'barang_id' => 3, 
                'kategori_id'=> 1,
                'barang_kode' => 'MakRin03',
                'barang_nama' => 'Pringles Black 100gr',
                'harga_beli'=> '11500',
                'harga_jual' => '13000'
            ],
            [   'barang_id' => 4, 
                'kategori_id'=> 2,
                'barang_kode' => 'MakSS01',
                'barang_nama' => 'Spagheti Carbonara Chef Devina',
                'harga_beli'=> '20500',
                'harga_jual' => '27000'
            ],
            [   'barang_id' => 5, 
                'kategori_id'=> 2,
                'barang_kode' => 'MakSS02',
                'barang_nama' => 'Nasi Goreng Padang Chef Devina',
                'harga_beli'=> '12500',
                'harga_jual' => '17000'
            ],
            [   'barang_id' => 6, 
                'kategori_id'=> 2,
                'barang_kode' => 'MakSS03',
                'barang_nama' => 'Mie Ayam Solo',
                'harga_beli'=> '7000',
                'harga_jual' => '13000'
            ],
            [   'barang_id' => 7, 
                'kategori_id'=> 3,
                'barang_kode' => 'RT01',
                'barang_nama' => 'Spoon Cake',
                'harga_beli'=> '5000',
                'harga_jual' => '7000'
            ],
            [   'barang_id' => 8, 
                'kategori_id'=> 3,
                'barang_kode' => 'RT02',
                'barang_nama' => 'Lapis Legit',
                'harga_beli'=> '8500',
                'harga_jual' => '10000'
            ],
            [   'barang_id' => 9, 
                'kategori_id'=> 3,
                'barang_kode' => 'RT03',
                'barang_nama' => 'Chiffon Strawberry',
                'harga_beli'=> '20500',
                'harga_jual' => '27000'
            ],
            [   'barang_id' => 10, 
                'kategori_id'=> 4,
                'barang_kode' => 'SoDr01',
                'barang_nama' => 'Pulpy Orange 500Ml',
                'harga_beli'=> '5500',
                'harga_jual' => '7000'
            ],
            [   'barang_id' => 11, 
                'kategori_id'=> 4,
                'barang_kode' => 'SoDr02',
                'barang_nama' => 'Pulpy Orange 1L',
                'harga_beli'=> '7500',
                'harga_jual' => '8000'
            ],
            [   'barang_id' => 12, 
                'kategori_id'=> 4,
                'barang_kode' => 'SoDr03',
                'barang_nama' => 'Coca Cola 2L',
                'harga_beli'=> '8500',
                'harga_jual' => '10000'
            ],
            [   'barang_id' => 13, 
                'kategori_id'=> 5,
                'barang_kode' => 'Bmb01',
                'barang_nama' => 'Desaku Kari',
                'harga_beli'=> '2500',
                'harga_jual' => '4000'
            ],
            [   'barang_id' => 14, 
                'kategori_id'=> 5,
                'barang_kode' => 'Bmb02',
                'barang_nama' => 'Indofood Ayam Goreng',
                'harga_beli'=> '3500',
                'harga_jual' => '5000'
            ],
            [   'barang_id' => 15, 
                'kategori_id'=> 5,
                'barang_kode' => 'Bmb03',
                'barang_nama' => 'Royco Salted Egg',
                'harga_beli'=> '5500',
                'harga_jual' => '7200'
            ],
            
        ];
        DB::table('m_barang')->insert($data);
    }
}
