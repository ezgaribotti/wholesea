<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return a list of allowed links', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.links.index'));
    $response->assertOk();
});
