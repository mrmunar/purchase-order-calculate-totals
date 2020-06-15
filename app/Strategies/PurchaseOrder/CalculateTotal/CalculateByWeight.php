<?php

namespace App\Strategies\PurchaseOrder\CalculateTotal;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CalculateByWeight implements TotalCalculationInterface
{
    public function calculateTotal(Collection $collection)
    {
        return $collection->reduce(function($carry, $record) {
            $subTotal = Arr::get($record, 'unit_quantity_initial', 0) * Arr::get($record, 'Product.weight', 0);

            return $carry + $subTotal;
        });
    }
}
