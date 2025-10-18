<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyConverterService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://open.er-api.com/v6/latest/'; // Or any other free API

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('CURRENCY_API_KEY'); // You might not need this for open.er-api.com
    }

    public function getExchangeRates(string $baseCurrency): array
    {
        $cacheKey = 'currency_rates_' . strtoupper($baseCurrency);

        return Cache::remember($cacheKey, 60 * 12, function () use ($baseCurrency) { // Cache for 12 hours
            try {
                $response = $this->client->get("{$this->baseUrl}{$baseCurrency}");
                $data = json_decode($response->getBody()->getContents(), true);

                if (isset($data['rates'])) {
                    return $data['rates'];
                }
            } catch (\Exception $e) {
                Log::error("Failed to fetch currency rates for {$baseCurrency}: " . $e->getMessage());
            }
            return []; // Return empty on failure
        });
    }

    public function convert(float $amount, string $fromCurrency, string $toCurrency): float
    {
        $fromCurrency = strtoupper($fromCurrency);
        $toCurrency = strtoupper($toCurrency);

        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        $rates = $this->getExchangeRates($fromCurrency);

        if (empty($rates) || !isset($rates[$toCurrency])) {
            Log::warning("Could not convert {$fromCurrency} to {$toCurrency}. Using original amount.");
            return $amount; // Fallback to original amount if conversion fails
        }

        return $amount * $rates[$toCurrency];
    }
}