<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class PaymentService
{
    private $http;
    private $baseURL;
    private $timeZoneCode;

    public function __construct($baseURL, $username, $password)
    {
        $this->timeZoneCode = "ALMT";
        $this->baseURL = $baseURL;
        $this->http = Http::withBasicAuth(
            $username,
            $password,
        )->withOptions([
            'verify' => false
        ]);
    }

    public function getSubscription($subscription_id)
    {
        return $this->http->post("{$this->baseURL}/subscriptions/get", [
            'Id' => $subscription_id,
        ])->throw()->json()['Model'];
    }

    public function getTransactionsForDate($date)
    {
        return $this->http->post("{$this->baseURL}/payments/list", [
            'Date' => $date,
            'TimeZone' => $this->timeZoneCode
        ])->throw()->json()['Model'];
    }
}
