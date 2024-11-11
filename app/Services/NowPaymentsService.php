<?php

namespace App\Services;

use GuzzleHttp\Client;

class NowPaymentsService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('nowpayments.base_url'),
            'headers' => ['x-api-key' => config('nowpayments.api_key')]
        ]);
    }

    public function createPayment($amount, $currency)
    {
        $response = $this->client->post('payment', [
            'json' => [
                'price_amount' => $amount,
                'price_currency' => $currency,
                'pay_currency' => $currency, // Optional: specify the currency the user will pay with
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
