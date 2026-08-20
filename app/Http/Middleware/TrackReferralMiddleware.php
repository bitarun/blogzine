<?php

namespace App\Http\Middleware;

use App\Models\Referral;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TrackReferralMiddleware
{
    /* Practice Bita */
    public function handle(Request $request, Closure $next)
    {
        $referrer = $this->getReferrer($request);

        if ($this->isExternalReferrer($referrer) && !session()->has('tracked_referral')) {
            $this->storeReferral($referrer);
            session()->put('tracked_referral', true);
        }

        return $next($request);
    }

    private function getReferrer(Request $request): string|null
    {
        return $request->headers->has('referer')
            ? parse_url($request->headers->get('referer'), PHP_URL_HOST)
            : null;
    }

    private function storeReferral($referrer): void
    {
        $referrerName = $this->getReferrerName($referrer);

        Referral::create([
            'referrer' => $referrerName,
            'source' => $referrer,
        ]);
    }

    private function isExternalReferrer(?string $referrer): bool
    {
        $appDomain = parse_url(URL::to('/'), PHP_URL_HOST);
        return $referrer !== $appDomain && $referrer !== null;
    }

    private function getReferrerName(?string $referrer): string
    {
        if (!$referrer) {
            return 'direct';
        }

        $referrers = [
            'google.com'    => 'google',
            'bing.com'      => 'bing',
            'instagram.com' => 'instagram',
        ];

        foreach ($referrers as $key => $value) {
            if (str_contains($referrer, $key)) {
                return $value;
            }
        }

        return 'other';
    }
}
