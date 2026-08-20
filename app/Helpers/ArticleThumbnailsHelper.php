<?php

if (!function_exists('largeThumbnail')) {
    function largeThumbnail($fileName)
    {
        return asset('uploads/images/thumbnails/large/' . $fileName);
    }
}

if (!function_exists('mediumThumbnail')) {
    function mediumThumbnail($fileName)
    {
        return asset('uploads/images/thumbnails/medium/' . $fileName);
    }
}

if (!function_exists('smallThumbnail')) {
    function smallThumbnail($fileName)
    {
        return asset('uploads/images/thumbnails/small/' . $fileName);
    }
}
