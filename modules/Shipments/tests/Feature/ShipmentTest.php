<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Shipments\src\Entities\Shipment;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of shipments', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.shipments.index'));
    $response->assertOk();
});

test('should return a shipment', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $shipment = Shipment::factory()->create();
    $response = $this->getJson(route('api.shipments.show', ['shipment' => $shipment]));
    $response->assertOk();
});
