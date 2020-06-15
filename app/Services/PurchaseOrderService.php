<?php

namespace App\Services;

use App\Integrations\CartonCloudDemoClient;
use App\Strategies\PurchaseOrder\CalculateTotal\CalculateTotalFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PurchaseOrderService
{
    private $client;

    public function __construct()
    {
        $this->client = new CartonCloudDemoClient;
    }
    public function calculateTotals(array $purchaseOrderIds)
    {
        $dataFromApiCollection = $this->getDataFromApi($purchaseOrderIds);

        $productTypeIds = $this->getProductTypeIds($dataFromApiCollection);

        return $this->getTotalsPerProductType($productTypeIds, $dataFromApiCollection);
    }

    private function getDataFromApi(array $purchaseOrderIds): Collection
    {
        $dataCollection = new Collection();

        foreach ($purchaseOrderIds as $purchaseOrderId) {
            $responseData = $this->client->fetchPurchaseOrders($purchaseOrderId);
            $dataCollection = $dataCollection->concat($responseData);
        }

        return $dataCollection;
    }

    private function getProductTypeIds(Collection $dataCollection): Collection
    {
        return $dataCollection
            ->unique('product_type_id')
            ->map(function ($purchaseOrder) {
                return Arr::get($purchaseOrder, 'product_type_id', null);
            });
    }

    private function getTotalsPerProductType(Collection $productTypeIds, Collection $dataFromApiCollection): Collection
    {
        $productTypeTotals = new Collection();

        foreach ($productTypeIds as $productTypeId) {
            $filteredCollection = $this->filterByProductTypeId((int) $productTypeId, $dataFromApiCollection);

            $calculationMethod = CalculateTotalFactory::getCalculationMethod($productTypeId);

            $productTypeTotals = $productTypeTotals->push([
                'product_type_id' => (int) $productTypeId,
                'total' => $calculationMethod->calculateTotal($filteredCollection)
            ]);
        }

        return $productTypeTotals;
    }

    private function filterByProductTypeId(int $productTypeId, Collection $dataFromApiCollection): Collection
    {
        return $dataFromApiCollection
            ->filter(function ($purchaseOrder) use ($productTypeId) {
                return (int) Arr::get($purchaseOrder, 'product_type_id', null) === $productTypeId;
            });
    }
}
