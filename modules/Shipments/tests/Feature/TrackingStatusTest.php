<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of tracking statuses', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.tracking-statuses.index'));
    $response->assertOk();
});
