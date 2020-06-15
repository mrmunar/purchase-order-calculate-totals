<?php

namespace Tests\Unit\Services;

use App\Strategies\PurchaseOrder\CalculateTotal\CalculateByVolume;
use App\Strategies\PurchaseOrder\CalculateTotal\CalculateByWeight;
use App\Strategies\PurchaseOrder\CalculateTotal\CalculateTotalFactory;
use Tests\TestCase;

class CalculateTotalFactoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_factory_calculate_by_weight_id1_success()
    {
        $calculationMethod = CalculateTotalFactory::getCalculationMethod(1);
        $this->assertInstanceOf(CalculateByWeight::class, $calculationMethod);
    }

    public function test_factory_calculate_by_weight_id3_success()
    {
        $calculationMethod = CalculateTotalFactory::getCalculationMethod(3);
        $this->assertInstanceOf(CalculateByWeight::class, $calculationMethod);
    }

    public function test_factory_calculate_by_volume_id2_success()
    {
        $calculationMethod = CalculateTotalFactory::getCalculationMethod(2);
        $this->assertInstanceOf(CalculateByVolume::class, $calculationMethod);
    }
}
