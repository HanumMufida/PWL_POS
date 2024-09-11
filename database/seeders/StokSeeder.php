<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id'=> 1,
                'barang_id' => '1',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'10',
            ],
            [
                'supplier_id'=> 1,
                'barang_id' => '2',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'9',
            ],
            [
                'supplier_id'=> 1,
                'barang_id' => '3',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'20',
            ],
            [
                'supplier_id'=> 1,
                'barang_id' => '4',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'15',
            ],
            [
                'supplier_id'=> 2,
                'barang_id' => '5',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'17',
            ],
            [
                'supplier_id'=> 2,
                'barang_id' => '6',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'12',
            ],
            [
                'supplier_id'=> 2,
                'barang_id' => '7',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'19',
            ],
            [
                'supplier_id'=> 2,
                'barang_id' => '8',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'25',
            ],
            [
                'supplier_id'=> 3,
                'barang_id' => '9',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'4',
            ],
            [
                'supplier_id'=> 3,
                'barang_id' => '10',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'2',
            ],
            [
                'supplier_id'=> 3,
                'barang_id' => '11',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'9',
            ],
            [
                'supplier_id'=> 3,
                'barang_id' => '12',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'33',
            ],
            [
                'supplier_id'=> 4,
                'barang_id' => '13',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'15',
            ],
            [
                'supplier_id'=> 4,
                'barang_id' => '14',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'17',
            ],
            [
                'supplier_id'=> 4,
                'barang_id' => '15',
                'user_id' =>'3',
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' =>'15',
            ],

            
        ];
        DB::table('t_stok')->insert($data);
    }
}
