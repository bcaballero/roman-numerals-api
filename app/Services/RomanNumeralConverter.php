<?php

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{
    public function convertInteger(int $number): string
    {
        $map = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];
        
        $roman_numeral = '';

        while ($number > 0)
        {
            foreach ($map as $roman => $int)
            {
                if($number >= $int)
                {
                    $number -= $int;
                    $roman_numeral .= $roman;
                    break;
                }
            }
        }
        
        return $roman_numeral;
    }
}
