<?php

namespace App\Helpers;

class AlgorithmHelper
{
    const TYPE_SORTING_BUBBLE = 'sorting_bubble';
    const TYPE_SORTING_SELECTION = 'sorting_selection';
    const TYPE_SORTING_INSERTS = 'sorting_inserts';

    public static $sortingTypes =  [
        self::TYPE_SORTING_BUBBLE,
        self::TYPE_SORTING_INSERTS,
        self::TYPE_SORTING_SELECTION,
    ];
}