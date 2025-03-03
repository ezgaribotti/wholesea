<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of operators', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->get(route('api.operators.index'));
    $response->assertOk();
});

test('should store a new operator', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $operator = Operator::factory()->make();
    $password = 'password';

    $response = $this->postJson(route('api.operators.store'), array_merge($operator->toArray(), [
        'password' => $password,
        'password_confirmation' => $password
    ]));
    $response->assertOk();
});

test('should return an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->get(route('api.operators.show', ['operator' => $operator]));
    $response->assertOk();
});

test('should update an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->putJson(route('api.operators.update', [
        'operator' => $operator
    ]), Operator::factory()->make(['status' => 'blocked'])->toArray());
    $response->assertOk();
});

test('should delete an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->delete(route('api.operators.destroy', ['operator' => $operator]));
    $response->assertOk();
});
