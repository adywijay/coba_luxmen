<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = "karyawans";
    // protected $primarykey = "id";
    protected $fillable = [
        'nama_karyawan',
        'jabatan_id',
        'akses_id',
        'tahun_masuk',
        'tgl_masuk',
        'tgl_keluar',
        'status'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function hak_akses()
    {
        return $this->belongsTo(HakAkses::class, 'akses_id', 'id');
    }
}