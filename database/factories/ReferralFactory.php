<?php

namespace Database\Factories;

use App\Models\Referral;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReferralFactory extends Factory
{
    protected $model = Referral::class;

    public function definition(): array
    {
        $referrers = [
            'google.com' => 'google',
            'bing.com' => 'bing',
            'instagram.com' => 'instagram',
            'facebook.com' => 'facebook',
            '127.0.0.1' => 'other',
        ];

        $key = array_rand($referrers);

        return [
            'referrer' => $referrers[$key],
            'source'   => $key,
        ];
    }
}
