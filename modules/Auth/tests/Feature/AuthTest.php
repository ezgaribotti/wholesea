<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should log in and return an access token', function () {
    $operator = Operator::factory()->create();

    $response = $this->postJson(route('api.login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'password',
    ]);
    $response->assertOk();
});

test('should return an error when the credentials are wrong', function () {
    $operator = Operator::factory()->create();

    $response = $this->postJson(route('api.login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'wrong',
    ]);
    $response->assertStatus(401);
});

test('should return an error when the operator is suspended or blocked', function () {
    $operator = Operator::factory()->create(['status' => 'suspended']);

    $response = $this->postJson(route('api.login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'password',
    ]);
    $response->assertStatus(403);
});

test('should return the authenticated operator', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->get(route('api.current-operator'));
    $response->assertOk();
});

test('should log out successfully', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->post(route('api.logout'));
    $response->assertOk();
});
