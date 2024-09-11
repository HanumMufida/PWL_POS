<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
            'user_id'=> 1,
            'pembeli'=> 'HANUM',
            'penjualan_kode' => 'PJK01',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'MITA',
            'penjualan_kode' => 'PJK02',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'ENNUR',
            'penjualan_kode' => 'PJK03',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'WANDA',
            'penjualan_kode' => 'PJK04',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'GELBOY',
            'penjualan_kode' => 'PJK05',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'SOLIKIN',
            'penjualan_kode' => 'PJK06',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'YUDHA',
            'penjualan_kode' => 'PJK07',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'SYFFA',
            'penjualan_kode' => 'PJK08',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'NAURA',
            'penjualan_kode' => 'PJK09',
            'penjualan_tanggal' => Carbon::now()
            ],
            [
            'user_id'=> 1,
            'pembeli'=> 'AISHA',
            'penjualan_kode' => 'PJK10',
            'penjualan_tanggal' => Carbon::now()
            ],
            
        ];
        DB::table('t_penjualan')->insert($data); 
    }
}
