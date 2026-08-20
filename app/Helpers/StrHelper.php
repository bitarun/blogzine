<?php

if (!function_exists('excerpt')) {
    function excerpt($str, $limit = 50, $end = '...'): string
    {
        $text = strip_tags($str);

        if (mb_strlen($text <= $limit)) {
            return $text;
        }

        return mb_substr($text, 0, $limit) . $end;
    }
}

if (! function_exists('makeSlug')) {
    function makeSlug(string $string): string
    {
        $string = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹','٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
            ['0','1','2','3','4','5','6','7','8','9','0','1','2','3','4','5','6','7','8','9'],
            $string
        );

        $string = preg_replace('/[^a-zA-Z0-9آ-ی\s]+/u', '', $string);
        $string = preg_replace('/[\s\-]+/', ' ', $string);

        return trim(str_replace(' ', '-', $string));
    }
}
