<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostTableKaryawan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            [
                'nama_karyawan' => "Immanuel Khan D.P",
                'jabatan_id' => 7,
                'akses_id' => 1,
                'tahun_masuk' => 2020,
                'tgl_masuk' => Carbon::now()->toDateTimeString(),
                'tgl_keluar' => Carbon::now()->toDateTimeString(),
                'status' => 'Nonaktif',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nama_karyawan' => "Grace racetho HP",
                'jabatan_id' => 9,
                'akses_id' => 3,
                'tahun_masuk' => 2020,
                'tgl_masuk' => Carbon::now()->toDateTimeString(),
                'tgl_keluar' => Carbon::now()->toDateTimeString(),
                'status' => 'Nonaktif',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nama_karyawan' => "Bangun Siangan Jr",
                'jabatan_id' => 6,
                'akses_id' => 1,
                'tahun_masuk' => 2020,
                'tgl_masuk' => Carbon::now()->toDateTimeString(),
                'tgl_keluar' => Carbon::now()->toDateTimeString(),
                'status' => 'Nonaktif',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nama_karyawan' => "Samandimins Ag",
                'jabatan_id' => 10,
                'akses_id' => 4,
                'tahun_masuk' => 2015,
                'tgl_masuk' => Carbon::now()->toDateTimeString(),
                'tgl_keluar' => Carbon::now()->toDateTimeString(),
                'status' => 'Nonaktif',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}