<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Services\Dashboard\StatisticsService;
use App\Services\Dashboard\TrafficStatService;

class DashboardController extends Controller
{
    protected TrafficStatService $trafficStatService;
    protected StatisticsService $statisticsService;
    public function __construct(TrafficStatService $trafficStatService, StatisticsService $statisticsService)
    {
        $this->trafficStatService = $trafficStatService;
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        $referrals = $this->getReferrals();
        $trafficStats = $this->trafficStatService->getTrafficMonthly();
        $statistics = $this->statisticsService->getCount();

        return view('dashboard.index', compact('referrals', 'trafficStats', 'statistics'));
    }

    private function getReferrals()
    {
        return Referral::selectRaw('referrer, count(*) as count')
            ->groupBy('referrer')
            ->get();
    }
}
