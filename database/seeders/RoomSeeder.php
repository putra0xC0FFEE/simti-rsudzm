<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $roomsRJ = [
            'POLIKLINIK JANTUNG ANAK BAWAAN',
            'POLIKLINIK ANAK',
            'POLIKLINIK BEDAH',
            'POLIKLINIK BEDAH SARAF',
            'POLIKLINIK BEDAH THORAX KARDIOVASKULER',
            'POLIKLINIK GIGI',
            'POLIKLINIK GIGI ENDODONSI',
            'POLIKLINIK PENYAKIT DALAM',
            'POLIKLINIK JANTUNG DAN PEMBULUH DARAH',
            'POLIKLINIK JIWA',
            'POLIKLINIK GIGI PEDODONTIS',
            'POLIKLINIK MATA',
            'POLIKLINIK OBSTETRI/OBGYN',
            'POLIKLINIK ORTHOPEDI DAN TRAUMATOLOGY',
            'POLIKLINIK PARU',
            'POLIKLINIK SARAF',
            'POLIKLINIK THT',
            'POLIKLINIK GIZI KLINIK',
            'POLIKLINIK UMUM',
            'POJOK PRB'
        ];

        $counter = 1;
        foreach ($roomsRJ as $name) {
            $roomId = sprintf('RJ-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Rawat Jalan',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsRI = [
            'ARAF AH',
            'MARWAH',
            'MINA',
            'MUZDALIFAH',
            'AL AZIZI',
            'SHAFA',
            'MULTAZAM',
            'JABAL RAHMAH',
            'IBNU SINA',
            'AZZAHRA',
            'NUR AFIAH',
            'RAUDHAH',
            'BAYI SEHAT'
        ];

        $counter = 1;
        foreach ($roomsRI as $name) {
            $roomId = sprintf('RI-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Rawat Inap',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsRK = [
            'IGD',
            'ICCU',
            'NICU',
            'PICU',
            'PONEK',
            'IBS',
            'UTDRS',
            'HCU'
        ];

        $counter = 1;
        foreach ($roomsRK as $name) {
            $roomId = sprintf('RK-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Ruang Khusus',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsPM = [
            'LAB PK',
            'LAB PA',
            'RADIOLOGI',
            'HEMODIALISA',
            'REHABILITAS',
            'FISIOTERAPI',
            'APOTEK IBS',
            'APOTEK RALAN A & KHUSUS',
            'APOTEK RALAN B',
            'APOTEK IGD',
        ];

        $counter = 1;
        foreach ($roomsPM as $name) {
            $roomId = sprintf('PM-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Penunjang Medis',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsPU = [
            'Gudang Obat dan BMHP',
            'Gudang Umum',
            'CSSD',
            'Ruang Laundry',
            'Instalasi Gizi',
            'CO (Central Officer)',
            'AMBULANCE'
        ];

        $counter = 1;
        foreach ($roomsPU as $name) {
            $roomId = sprintf('PU-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Penunjang Umum',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsAM = [
            'Informasi',
            'Rekam Medis',
            'Ruang IT'
        ];

        $counter = 1;
        foreach ($roomsAM as $name) {
            $roomId = sprintf('AM-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Administrasi',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $roomsSL = [
            'Sanitasi',
            'Instalasi Jenazah'
        ];

        $counter = 1;
        foreach ($roomsSL as $name) {
            $roomId = sprintf('SL-%02d', $counter++);
            DB::table('rooms')->updateOrInsert(
                ['room_id' => $roomId],
                [
                    'room_id' => $roomId,
                    'kategori' => 'Sanitasi & Limbah',
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
