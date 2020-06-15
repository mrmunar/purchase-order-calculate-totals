<?php

namespace Tests\Unit\Services;

use App\Strategies\PurchaseOrder\CalculateTotal\CalculateByWeight;
use Tests\TestCase;

class CalculateByWeightTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->caculateByWeight = new CalculateByWeight;
    }

    public function test_calculate_by_weight_success()
    {
        $input = collect([
            [
                'unit_quantity_initial' => 8,
                'Product' => [
                    'weight' => 0.5
                ]
            ],
            [
                'unit_quantity_initial' => 2,
                'Product' => [
                    'weight' => 0.3
                ]
            ],
            [
                'unit_quantity_initial' => 3,
                'Product' => [
                    'weight' => 0.1
                ]
            ]
        ]);

        $output = $this->caculateByWeight->calculateTotal($input);
        $this->assertEquals($output, 4.9);
    }

    public function test_calculate_by_wight_empty_collection_failed()
    {
        $input = collect([]);

        $output = $this->caculateByWeight->calculateTotal($input);
        $this->assertEquals($output, null);
    }

    public function test_calculate_by_weight_invalid_data_type_input_failed()
    {
        $this->expectException(\TypeError::class);

        $input = 'string';
        $this->caculateByWeight->calculateTotal($input);
    }
}
