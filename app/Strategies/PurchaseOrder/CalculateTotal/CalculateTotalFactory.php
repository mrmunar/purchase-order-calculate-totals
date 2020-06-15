<?php

namespace App\Strategies\PurchaseOrder\CalculateTotal;

class CalculateTotalFactory
{
    public static function getCalculationMethod(int $productTypeId)
    {
        switch ($productTypeId) {
            case 1:
            case 3:
                return new CalculateByWeight;
                break;
            case 2:
                return new CalculateByVolume;
                break;
            default:
                throw new \InvalidArgumentException(
                    'Product Type ID (' . $productTypeId . ') is not supported'
                );
        }
    }
}
