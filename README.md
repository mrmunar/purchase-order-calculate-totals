# Purchase Order Calculate Totals Backend

This contains the following for calculating totals:
* A POST API
* A reusable Service

## Prerequisites

* PHP 7.2
* Composer

## Installation

Clone this repo

```bash
git clone https://github.com/mrmunar/purchase-order-calculate-totals.git
```

Install dependencies and libraries

```bash
composer install
```

Start the server

```bash
php -S localhost:8000 -t public
```


## Usage

### API

API for calculating purchase order totals by given array of purchase_order_ids

```bash
[POST] http://localhost:8000/test
```

Request Body

```json
{
	"purchase_order_ids": [2344, 2345, 2346]
}
```

Response Body

```json
[
  {
    "product_type_id": 1,
    "total": 41.5
  },
  {
    "product_type_id": 2,
    "total": 13.8
  },
  {
    "product_type_id": 3,
    "total": 25
  }
]
```

### PurchaseOrderService

The service is located in `app/Services/PurchaseOrderService.php`

Sample Usage:

```php
$input = [2344, 2345, 2346];

$service = new PurchaseOrderService;
$output = $service->calculateTotals($input);

/**
 * $output:
 * 
 * [
 *  {
 *   "product_type_id": 1,
 *   "total": 41.5
 *  },
 *  {
 *   "product_type_id": 2,
 *   "total": 13.8
 *  },
 *  {
 *   "product_type_id": 3,
 *   "total": 25
 *  }
 * ]
 */
```

### CalculateTotalFactory

This uses the Strategy Pattern where it creates an object that calculates the purchase order total based on the `product_type_id`

It is located in `app/Strategies/PurchaseOrder/CalculateTotal/CalculateTotalFactory.php`

## Unit Testing

```bash
./vendor/bin/phpunit --testdox
```

![carton-cloud-exam-backend-screenshot-1.png](https://raw.githubusercontent.com/mrmunar/project-resources/master/carton-cloud-exam-backend/carton-cloud-exam-backend-screenshot-1.png)
