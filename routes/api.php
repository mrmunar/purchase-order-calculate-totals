<?php

$router->group(['prefix' => 'test'], function () use ($router) {
    $router->post('/', [
        'as' => 'purchase-order.get-totals',
        'uses' => 'PurchaseOrderController@getTotals'
    ]);
});
