<?php

namespace App\Http\Controllers;

use App\Integrations\CartonCloudDemoClient;
use App\Services\PurchaseOrderService;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    private $client;
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PurchaseOrderService $service)
    {
        $this->service = $service;
    }

    public function getTotals(Request $request)
    {
        $purchaseOrderIds = $request->input('purchase_order_ids');

        $productTypeTotals = $this->service->calculateTotals($purchaseOrderIds);

        return response()->json($productTypeTotals);
    }
}
