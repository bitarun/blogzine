<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyApiService
{
    protected string $apiUrl;
    public function __construct()
    {
        $apiKey = config('services.currency.api_key');
        $this->apiUrl = "https://BrsApi.ir/Api/Market/Gold_Currency.php?key={$apiKey}";
    }

    public function fetchCurrencyData()
    {
        try {

            $response = Http::get($this->apiUrl);
            if ($response->successful()) {
                $data = $response->json();
                return array_merge(...array_values($data));
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return [];
    }
}
