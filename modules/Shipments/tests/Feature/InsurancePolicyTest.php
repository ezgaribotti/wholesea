<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of insurance policies', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.insurance-policies.index'));
    $response->assertOk();
});
