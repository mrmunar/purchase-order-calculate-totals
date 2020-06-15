<?php

namespace App\Integrations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CartonCloudDemoClient
{
    public function __construct()
    {
        $this->url = config('integration.cartoncloud_demo.purchase_orders.url');
        $this->username = config('integration.cartoncloud_demo.purchase_orders.username');
        $this->password = config('integration.cartoncloud_demo.purchase_orders.password');
    }

    private function http()
    {
        return Http::withBasicAuth($this->username, $this->password);
    }

    public function fetchPurchaseOrders(int $id)
    {
        try {
            $defaultParameters = '?version=5&associated=true';

            $response = $this->http()->get($this->url . '/' . $id . $defaultParameters);

            return Arr::get($response->json(), 'data.PurchaseOrderProduct', []);
        } catch (\Exception $error) {
            throw new \Exception('Cannot connect to Carton Cloud Demo client');
        }
    }
}
