<?php

namespace App\Helpers;

class AlgorithmHelper
{
    const TYPE_SORTING_BUBBLE = 'sorting_bubble';
    const TYPE_SORTING_SELECTION = 'sorting_selection';
    const TYPE_SORTING_INSERTS = 'sorting_inserts';
    const TYPE_SORTING_GNOME = 'sorting_gnome';
    const TYPE_SORTING_QUICK = 'sorting_quick';
    const TYPE_SORTING_QUICK_ARRAYS = 'sorting_quick_arrays';
    const TYPE_SORTING_QUICK_REPLACES = 'sorting_quick_replaces';

    public static $sortingTypes =  [
        self::TYPE_SORTING_BUBBLE,
        self::TYPE_SORTING_INSERTS,
        self::TYPE_SORTING_SELECTION,
        self::TYPE_SORTING_GNOME,
        self::TYPE_SORTING_QUICK,
        self::TYPE_SORTING_QUICK_ARRAYS,
        self::TYPE_SORTING_QUICK_REPLACES,
    ];
}