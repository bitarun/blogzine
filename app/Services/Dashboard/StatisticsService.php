<?php

namespace App\Services\Dashboard;

use App\Models\Article;
use App\Models\TrafficStat;
use App\Models\User;

class StatisticsService
{
    const THRESHOLD = [
        1_000_000 => 'M',
        1_000 => 'K',
    ];

    public function getCount()
    {
        return [
            'users' => $this->numberFormat($this->users()),
            'articles' => $this->numberFormat($this->articles()),
            'likes' => $this->numberFormat($this->likes()),
            'visitors' => $this->numberFormat($this->visitors()),
        ];
    }

    private function users()
    {
        return User::count();
    }

    private function articles()
    {
        return Article::count();
    }

    private function likes()
    {
        return Article::sum('likes');
    }

    private function visitors()
    {
        return TrafficStat::count();
    }

    private function numberFormat($number)
    {
        foreach (self::THRESHOLD as $threshold => $suffix) {
            if ($number >= $threshold) {
                return round($number / $threshold, '1') . $suffix;
            }
        }
        return $number;
    }
}
