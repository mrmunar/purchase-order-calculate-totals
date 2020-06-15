<?php

namespace Tests\Unit\Services;

use App\Strategies\PurchaseOrder\CalculateTotal\CalculateByVolume;
use Tests\TestCase;

class CalculateByVolumeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->caculateByVolume = new CalculateByVolume;
    }

    public function test_calculate_by_volume_success()
    {
        $input = collect([
            [
                'unit_quantity_initial' => 8,
                'Product' => [
                    'volume' => 0.5
                ]
            ],
            [
                'unit_quantity_initial' => 2,
                'Product' => [
                    'volume' => 0.3
                ]
            ],
            [
                'unit_quantity_initial' => 3,
                'Product' => [
                    'volume' => 0.1
                ]
            ]
        ]);

        $output = $this->caculateByVolume->calculateTotal($input);
        $this->assertEquals($output, 4.9);
    }

    public function test_calculate_by_volume_empty_collection_failed()
    {
        $input = collect([]);

        $output = $this->caculateByVolume->calculateTotal($input);
        $this->assertEquals($output, null);
    }

    public function test_calculate_by_volume_invalid_data_type_input_failed()
    {
        $this->expectException(\TypeError::class);

        $input = 'string';
        $this->caculateByVolume->calculateTotal($input);
    }
}
