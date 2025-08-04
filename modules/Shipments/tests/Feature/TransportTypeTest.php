<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of transport types', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.transport-types.index'));
    $response->assertOk();
});
