<?php

namespace App\Helpers;

class Angka
{
    private static $romans = [
        'X' => 10,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    public static function romawi(int $number): string
    {
        $number = intval($number);
        $result = '';

        foreach (static::$romans as $roman => $value) {
            // Determine the number of matches
            $matches = intval($number / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $number = $number % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }

    public static function ganjilAtauGenap(int $angka): string
    {
        if ($angka % 2 == 0)
            return 'genap';

        return 'ganjil';
    }
}
