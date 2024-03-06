<?php

namespace Database\Seeders;

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
        $data = [];
        $barangIds = DB::table('m_barang')->pluck('barang_id');
    
        foreach ($barangIds as $barangId) {
            for ($i = 1; $i <= 1; $i++) {
                $data[] = [
                    'barang_id' => $barangId,
                    'user_id' => rand(1, 3),
                    'stok_tanggal' => now(),
                    'stok_jumlah' => rand(10, 100),
                ];
            }
        }
    
        DB::table('t_stok')->update($data);
    }
}
