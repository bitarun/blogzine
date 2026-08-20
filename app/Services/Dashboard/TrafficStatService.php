<?php

namespace App\Services\Dashboard;

use App\Models\TrafficStat;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TrafficStatService
{
    public function getTrafficMonthly()
    {
        $dates = $this->fetchVisitsDate();
        $jalaliDates = $this->convertToJalali($dates);
        return $this->groupDatesByMonth($jalaliDates);
    }

    private function fetchVisitsDate(): Collection
    {
        $startDate = Carbon::now()->subMonths(10)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        return TrafficStat::whereBetween('visit', [$startDate, $endDate])->orderBy('visit', 'desc')->get();
    }

    private function convertToJalali($dates)
    {
        return $dates->map(function ($date)
        {
            if (empty($date->visit) || $date->visit === '0000-00-00') {
                return null;
            }

            //$gregorianDate = Carbon::parse($date->visit)->toDate();
            //$jalaliDate = verta($date->visit)->format('Y F');

            return [
                'yearMonth' => verta($date->visit)->format('y F'),
                'count' => 1,
            ];
        })->filter();
    }

    private function groupDatesByMonth($jalaliDates)
    {
        return $jalaliDates->groupBy('yearMonth')->map(function ($group) {
            return [
                'yearMonth' => $group->first()['yearMonth'],
                'count' => $group->sum('count'),
            ];
        })->values()->toArray();
    }
}
