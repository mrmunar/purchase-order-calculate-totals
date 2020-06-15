<?php

namespace App\Strategies\PurchaseOrder\CalculateTotal;

use Illuminate\Support\Collection;

interface TotalCalculationInterface
{
    public function calculateTotal(Collection $collection);
}
