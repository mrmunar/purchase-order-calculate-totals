<?php

namespace App\Http\Controllers;

use App\Integrations\CartonCloudDemoClient;

class PurchaseOrderController extends Controller
{
    private $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartonCloudDemoClient $client)
    {
        $this->client = $client;
    }

    public function getTotals()
    {
        return response()->json($this->client);
    }
}

