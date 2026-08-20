<?php

if (!function_exists('getAvatarImage'))
{
    function getAvatarImage($fileName = null)
    {
        $fileName = $fileName ?: 'avatar.png';
        return asset('uploads/images/avatars/' . $fileName);
    }
}
