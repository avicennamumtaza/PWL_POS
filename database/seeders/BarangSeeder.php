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
        $data = [];

        $kategoriIds = DB::table('m_kategori')->pluck('kategori_id');

        foreach ($kategoriIds as $kategoriId) {
            for ($i = 1; $i <= 2; $i++) {
                $data[] = [
                    'kategori_id' => $kategoriId,
                    'barang_kode' => "BRG{$kategoriId}00{$i}",
                    'barang_nama' => "Barang {$kategoriId}00{$i}",
                    'harga_beli' => rand(10000, 50000),
                    'harga_jual' => rand(60000, 100000),
                ];
            }
        }

        DB::table('m_barang')->insert($data);
    }
}
