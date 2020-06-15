<?php

$router->group(['prefix' => 'test'], function () use ($router) {
    $router->post('/', [
        'as' => 'test.purchase-order.get-totals',
        'uses' => 'PurchaseOrderController@getTotals'
    ]);
});
