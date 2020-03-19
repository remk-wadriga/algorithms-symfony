<?php

namespace App\Helpers;

use Faker\Factory;

class ArrayHelper
{
    public static function generateArray(int $length = 100, int $min = 0, int $max = 100): array
    {
        $faker = Factory::create();
        $result = [];

        for ($i = 0; $i < $length; $i++) {
            $result[$i] = $faker->numberBetween($min, $max);
        }

        return  $result;
    }
}