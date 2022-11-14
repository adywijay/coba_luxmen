<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableJabatans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            [
                'kode_jabatan' => "CEO",
                'nama_jabatan' => "Chief Executive Officer"
            ],
            [
                'kode_jabatan' => "CFO",
                'nama_jabatan' => "Chief Financial; Officer"
            ],
            [
                'kode_jabatan' => "COO",
                'nama_jabatan' => "Chief Operation Officer"
            ],
            [
                'kode_jabatan' => "CTO",
                'nama_jabatan' => "Chief Technology Officer"
            ],
            [
                'kode_jabatan' => "IT-Dev.Jr",
                'nama_jabatan' => "IT-Developer.Junior"
            ],
            [
                'kode_jabatan' => "IT-Dev.Mr",
                'nama_jabatan' => "IT-Developer.Middle"
            ],
            [
                'kode_jabatan' => "IT-Dev.Sr",
                'nama_jabatan' => "IT-Developer.Senior"
            ],
        ]);
    }
}