<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class CartonCloudDemoClient
{
    public function __construct()
    {
        $this->url = config('integration.cartoncloud_demo.purchase_orders.url');
    }

    public function fetchPurchaseOrders(int $id)
    {
        $defaultParameters = '?version=5&associated=true';

        return $this->url . '/' . $id . $defaultParameters;

        // $response = Http::get($this->url . '/' . $id . $defaultParameters);

        // return $response->json();
    }
}
