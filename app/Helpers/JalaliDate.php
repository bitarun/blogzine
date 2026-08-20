<?php

use Carbon\Carbon;

if (!function_exists('jalaliDateFormatA')) {
    function jalaliDateFormatA($date): string
    {
        return verta($date)->format('d F، Y');
    }
}

if (!function_exists('humanReadableDate')) {
    function humanReadableDate($date): string
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
