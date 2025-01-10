<?php

namespace App\Helpers;

use Midtrans\Config;

class MidtransHelper
{
    public static function config()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        if (empty(Config::$serverKey)) {
            throw new \Exception("Server Key tidak ditemukan, pastikan telah diset di .env");
        }
    }
    // private $serverKey;
    // private $isProduction;
    // private $apiUrl;

    // public function __construct()
    // {
    //     $this->serverKey = env('MIDTRANS_SERVER_KEY');
    //     $this->isProduction = env('MIDTRANS_IS_PRODUCTION', false);
    //     $this->apiUrl = $this->isProduction
    //         ? 'https://app.midtrans.com/snap/v1/transactions'
    //         : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    // }

    // public function getSnapToken($transactionDetails)
    // {
    //     $payload = json_encode($transactionDetails);

    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => $this->apiUrl,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => $payload,
    //         CURLOPT_HTTPHEADER => [
    //             'Authorization: Basic ' . base64_encode($this->serverKey . ':'),
    //             'Content-Type: application/json',
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     if ($err) {
    //         throw new \Exception("cURL Error: $err");
    //     }

    //     $responseData = json_decode($response, true);

    //     if (isset($responseData['token'])) {
    //         return $responseData['token'];
    //     } else {
    //         throw new \Exception("Midtrans Error: " . $responseData['message']);
    //     }
    // }
}
