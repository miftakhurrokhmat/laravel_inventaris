<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = now();
        DB::table('kondisi')->insert([
            ['nama' => 'Baik', 'keterangan' => 'Barang layak pakai', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Rusak Ringan', 'keterangan' => 'Masih bisa diperbaiki', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Rusak Berat', 'keterangan' => 'Perlu penggantian', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
