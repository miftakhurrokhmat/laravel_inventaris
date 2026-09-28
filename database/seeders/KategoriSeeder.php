<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = now();
        DB::table('kategori')->insert([
            ['nama' => 'Elektronik', 'deskripsi' => 'Perangkat elektronik kantor', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Furniture', 'deskripsi' => 'Meja, kursi, almari', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Kendaraan', 'deskripsi' => 'Aset transportasi', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
