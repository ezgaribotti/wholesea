<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Customers\src\Entities\Customer;
use Modules\Customers\src\Entities\CustomerAddress;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of addresses', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customer = Customer::factory()->create();
    $response = $this->getJson(route('api.customer-addresses.index', [
        'customer_id' => $customer->id
    ]));
    $response->assertOk();
});

test('should store a new address', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $address = CustomerAddress::factory()->make();
    $response = $this->postJson(route('api.customer-addresses.store'), $address->toArray());
    $response->assertOk();
});

test('should delete an address', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $address = CustomerAddress::factory()->create();
    $response = $this->deleteJson(route('api.customer-addresses.destroy', [
        'customer_address' => $address
    ]));
    $response->assertOk();
});
