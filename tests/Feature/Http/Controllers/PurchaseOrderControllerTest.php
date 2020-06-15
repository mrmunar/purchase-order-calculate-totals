<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class PurchaseOrderControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_see_route_success()
    {
        $this->assertNotEmpty(route('test.purchase-order.get-totals'));
    }

    public function test_post_calculate_totals_success()
    {
        $input = [
            'purchase_order_ids' => [2344, 2345, 2346]
        ];

        $this->post(route('test.purchase-order.get-totals'), $input)
            ->seeJsonEquals([
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

        $this->assertResponseOk();
    }

    public function test_post_empty_calculate_totals_failed()
    {
        $input = [];

        $this->post(route('test.purchase-order.get-totals'), $input)
            ->seeJsonEquals([
                'purchase_order_ids' => ['The purchase order ids field is required.']
            ]);

        $this->assertResponseStatus(422);
    }

    public function test_post_string_id_input_calculate_totals_failed()
    {
        $input = [
            'purchase_order_ids' => [1, 2, 3, 'invalid-string-id']
        ];

        $this->post(route('test.purchase-order.get-totals'), $input);


        $this->assertJson($this->response->getContent());
        $this->assertStringContainsString('must be an integer.', $this->response->getContent());

        $this->assertResponseStatus(422);
    }
}
