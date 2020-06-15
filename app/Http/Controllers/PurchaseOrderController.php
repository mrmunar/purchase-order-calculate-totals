<?php

namespace App\Http\Controllers;

class PurchaseOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getTotals()
    {
        return response()->json(['data' => 'PurchaseOrderController@getTotals']);
    }
}

