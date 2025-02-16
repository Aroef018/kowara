<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TextHelper {
    public static function limitLines($text, $maxLines = 3, $maxChars = 50)
    {
        // Ganti enter (\n) dengan spasi
        $text = preg_replace('/\s+/', ' ', $text); // Menghapus enter dan spasi berlebih

        // Pisahkan teks menjadi baris-baris berdasarkan panjang maksimum karakter
        $lines = explode("\n", wordwrap($text, $maxChars, "\n", true));
        $result = '';

        foreach ($lines as $index => $line) {
            if ($index >= $maxLines) break; // Batasi jumlah baris sesuai $maxLines
            $result .= $line . "\n";
        }

        return nl2br(trim($result)); // Tambahkan tag <br> untuk baris baru
    }
}
