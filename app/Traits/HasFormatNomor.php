<?php
namespace App\Traits;

trait HasFormatNomor
{
    /**
     * Format phone number based on a given pattern.
     *
     * @param string $phone_number The raw phone number (e.g., 08123456789)
     * @param string $pattern The desired format pattern (default: "(XXX) XXX-XXXX")
     * @return string Formatted phone number
     */
    public function formatNomor($phone_number, $pattern = 'XXXX-XXXX-XXXXX')
    {
        // Hapus semua karakter selain angka
        $cleaned = preg_replace('/[^0-9]/', '', $phone_number);

        // Ganti setiap 'X' dalam pattern dengan digit dari nomor telepon
        $formatted = $pattern;
        foreach (str_split($cleaned) as $digit) {
            $formatted = preg_replace('/X/', $digit, $formatted, 1);
        }

        // Hilangkan sisa 'X' yang tidak terisi dalam pattern
        $formatted = preg_replace('/X+/', '', $formatted);

        return $formatted;
    }
}
