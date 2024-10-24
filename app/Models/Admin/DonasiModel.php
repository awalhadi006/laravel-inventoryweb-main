<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiModel extends Model
{
    use HasFactory;
    protected $table = "tbl_donasi";
    protected $primaryKey = 'donasi_id';
    protected $fillable = [
        'donasi_pj',
        'donasi_slug',
        'donasi_anggota',
        'donasi_lokasi',
        'donasi_alamat',
        'donasi_tanggal',
        'donasi_keterangan',
        'donasi_jumlah',
    ];
}
