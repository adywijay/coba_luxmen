<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;
    protected $table = "hak_akses";
    //protected $primarykey = "id";
    protected $fillable = ['nama_akses'];

    public function karyawan()
    {
        return $this->hasMany(karyawan::class);
    }
}