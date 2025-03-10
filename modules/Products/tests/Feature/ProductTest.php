<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Products\src\Entities\Product;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of products', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('api.products.index'));
    $response->assertOk();
});

test('should store a new product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->make();
    $response = $this->postJson(route('api.products.store'), $product->toArray());
    $response->assertOk();
});

test('should return a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->getJson(route('api.products.show', ['product' => $product]));
    $response->assertOk();
});

test('should update a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->putJson(route('api.products.update', [
        'product' => $product
    ]), Product::factory()->make(['active' => false])->toArray());
    $response->assertOk();
});

test('should delete a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->deleteJson(route('api.products.destroy', ['product' => $product]));
    $response->assertOk();
});
