<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IspProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('isp_providers')->insert([
            [
                'nama_perusahaan' => 'Indihome',
                'bandwidth' => '50 Mbps',
                'harga' => 350000,
                'tahun_masuk' => 2021,
                'nama_pj' => 'Budi Santoso',
                'kontak_pj' => '081234567890',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan' => 'Biznet',
                'bandwidth' => '100 Mbps',
                'harga' => 450000,
                'tahun_masuk' => 2022,
                'nama_pj' => 'Rina Putri',
                'kontak_pj' => '081298765432',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan' => 'First Media',
                'bandwidth' => '75 Mbps',
                'harga' => 400000,
                'tahun_masuk' => 2020,
                'nama_pj' => 'Agus Hidayat',
                'kontak_pj' => '082134567821',
                'status' => 'non-aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
