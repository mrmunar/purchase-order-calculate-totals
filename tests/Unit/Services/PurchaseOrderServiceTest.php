<?php

namespace Tests\Unit\Services;

use App\Services\PurchaseOrderService;
use Tests\TestCase;

class PurchaseOrderServiceTest extends TestCase
{
    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new PurchaseOrderService;
    }

    public function test_service_calculate_totals_success()
    {
        $input = [2344, 2345, 2346];

        $output = $this->service->calculateTotals($input);
        $this->assertEquals($output, [
            [
                'product_type_id' => 1,
                'total' => 41.5
            ],
            [
                'product_type_id' => 2,
                'total' => 13.8
            ],
            [
                'product_type_id' => 3,
                'total' => 25
            ]
        ]);
    }

    public function test_service_empty_input_calculate_totals_failed()
    {
        $this->expectExceptionMessage('Purchase order ids required');

        $input = [];

        $output = $this->service->calculateTotals($input);
    }
}
