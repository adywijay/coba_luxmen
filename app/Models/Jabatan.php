<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    protected $table = "jabatans";
    //protected $primarykey = "id";
    protected $fillable = [
        'kode_jabatan',
        'nama_jabatan'
    ];

    public function karyawan()
    {
        return $this->hasMany(karyawan::class);
    }
}