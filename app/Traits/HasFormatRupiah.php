<?php
namespace App\Traits;

trait HasFormatRupiah
{
    public function formatRupiah($angka, $prefix = 'Rp. ')
    {
        return $prefix . number_format($angka, 0, ',', '.');
    }
}
