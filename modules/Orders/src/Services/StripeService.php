<?php

namespace Modules\Orders\src\Services;

use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService
{
    public static function createSession(string $trackingNumber, string $email, array $items): object
    {
        $config = to_object(config('stripe'));
        $lineItems = [];
        collect($items)->each(function ($item) use (&$lineItems, $config) {
            $item = to_object($item);
            $product = $item->product;

            $lineItems[] = [
                'price_data' => [
                    'currency' => $config->currency,
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount_decimal' => floatval($product->unit_price),
                ],
                'quantity' => $item->quantity,
            ];
        });

        $identifier = [
            'tracking_number' => $trackingNumber
        ];

        $payload = [
            'client_reference_id' => $trackingNumber,
            'line_items' => $lineItems,
            'customer_email' => $email,
            'invoice_creation' => [
                'enabled' => true,
            ],
            'mode' => $config->mode,
            'success_url' => route('api.stripe.success', $identifier),
            'cancel_url' => route('api.stripe.cancel', $identifier),
        ];

        $client = new StripeClient($config->secret_key);
        try {
            $session = $client->checkout->sessions->create($payload);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to create Stripe checkout session.');
        }
        return $session;
    }

    public static function retrieveSession(string $id): object
    {
        $config = to_object(config('stripe'));
        $client = new StripeClient($config->secret_key);

        try {
            $session = $client->checkout->sessions->retrieve($id);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to retrieve Stripe checkout session.');
        }
        return $session;
    }
}
