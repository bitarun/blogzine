<?php

namespace App\Http\Middleware;

use App\Models\TrafficStat;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class TrafficStatMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $this->storeTraffic();
        return $next($request);
    }

    public function storeTraffic()
    {
        TrafficStat::create([
            'visit' => Carbon::now()->toDateString(),
        ]);
    }
}
