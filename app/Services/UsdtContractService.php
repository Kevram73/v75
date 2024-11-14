<?php

namespace App\Services;

use Web3\Web3;
use Web3\Contract;
use Illuminate\Support\Facades\Log;

class USDTService
{
    protected $web3;
    protected $contract;
    protected $walletAddress;
    protected $walletPrivateKey;
    protected $usdtContractAddress;

    public function __construct()
    {
        $this->web3 = new Web3(env('ETHEREUM_NETWORK'));
        $this->contract = new Contract($this->web3->provider, $this->getAbi());
        $this->walletAddress = env('WALLET_ADDRESS');
        $this->walletPrivateKey = env('WALLET_PRIVATE_KEY');
        $this->usdtContractAddress = env('USDT_CONTRACT_ADDRESS');
    }

    private function getAbi()
    {
        return '[...]';  // ERC20 ABI JSON here (you can find the USDT contract ABI on Etherscan)
    }

    public function getBalance()
    {
        $balance = 0;
        $this->contract->at($this->usdtContractAddress)->call('balanceOf', $this->walletAddress, function ($err, $result) use (&$balance) {
            if ($err !== null) {
                Log::error('Error fetching USDT balance: ' . $err->getMessage());
                return;
            }
            $balance = hexdec($result[0]->toString()) / pow(10, 6);  // USDT has 6 decimals
        });
        return $balance;
    }

    public function transfer($toAddress, $amount)
    {
        $amountInWei = bcmul($amount, bcpow(10, 6));  // Convert amount to Wei (6 decimals for USDT)
        $transaction = [
            'from' => $this->walletAddress,
            'to' => $this->usdtContractAddress,
            'data' => $this->contract->at($this->usdtContractAddress)->getData('transfer', $toAddress, $amountInWei),
            'gas' => '0x5208',  // Gas limit
            'gasPrice' => '0x09184e72a000'  // Gas price
        ];

        // Sign and send the transaction
        // Implementation may vary based on chosen library for signing transactions

        return "Transaction sent";
    }
}
