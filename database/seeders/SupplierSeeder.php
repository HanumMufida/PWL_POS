<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 
            'supplier_kode'=> 1234,
            'supplier_nama' => 'Mayora',
            'supplier_alamat' => 'Jakarta'
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 2345,
                'supplier_nama' => 'Indofood',
                'supplier_alamat' => 'Surabaya',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 3456,
                'supplier_nama' => 'GarudaFood',
                'supplier_alamat' => 'Bandung',
            ],
            [
                'supplier_id' => 4,
                'supplier_kode' => 4567,
                'supplier_nama' => 'Wings Group',
                'supplier_alamat' => 'Yogyakarta',
            ]
            
        ];
        DB::table('m_supplier')->insert($data);
    }
}
