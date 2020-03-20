<?php

namespace App\Helpers;

class IntegerHelper
{
    public static function float2string(float $floatVal, int $decimals = 6): string
    {
        $floatVal = (string)$floatVal;
        if (preg_match("/(\d\.\d+)E-(\d+)/", $floatVal, $matches)) {
            list($time, $exp) = array_slice($matches, 1, 2);
            $time = str_replace('.', '', $time);
            $floatVal = '0.' . str_repeat('0', $exp - 1) . substr($time, 0, -$exp);
        }
        $pointPos = strpos($floatVal, '.');
        if ($pointPos === false) {
            return $floatVal;
        }
        return substr($floatVal, 0, $decimals + $pointPos + 1);
    }
}