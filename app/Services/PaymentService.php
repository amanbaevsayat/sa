<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class PaymentService
{
    private $http;
    private $baseURL;

    public function __construct($baseURL, $username, $password)
    {
        $this->baseURL = $baseURL;
        $this->http = Http::withBasicAuth(
            $username,
            $password,
        );
    }

    public function getSubscription($subscription_id)
    {
        return $this->http->post("{$this->baseURL}/subscriptions/get", [
            'Id' => $subscription_id,
        ])->throw()->json()['Model'];
    }
}
