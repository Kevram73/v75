<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class BinancePayService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('BINANCE_MERCHANT_API_KEY');
        $this->apiSecret = env('BINANCE_MERCHANT_SECRET_KEY');
        $this->baseUrl = env('BINANCE_SERVICE_BASE_URL');
    }

    public function createOrder($amount, $currency = 'USDT', $goods)
    {
        $url = $this->baseUrl . '/binancepay/openapi/v2/order';
    
        $nonce = $this->generateNonce();
        $timestamp = round(microtime(true) * 1000);
    
        $params = [
            "env" => [
                "terminalType" => "APP"
            ],
            "merchantTradeNo" => mt_rand(982538, 9825382937292),
            "orderAmount" => $amount,
            "currency" => $currency,
            "goods" => $goods
        ];
    
        $json_request = json_encode($params);
        $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";
        $signature = strtoupper(hash_hmac('SHA512', $payload, $this->apiSecret));
    
        $headers = [
            'BinancePay-Timestamp' => $timestamp,
            'BinancePay-Nonce' => $nonce,
            'BinancePay-Certificate-SN' => $this->apiKey,
            'BinancePay-Signature' => $signature
        ];
    
        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $params // Using 'json' instead of 'body'
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Log the error or handle it as per your application's requirements
            return ['error' => $e->getMessage()];
        }
    }
    

    protected function generateNonce()
    {
        return Str::random(32);
    }
}
