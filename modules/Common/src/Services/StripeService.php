<?php

namespace Modules\Common\src\Services;

use Illuminate\Support\Facades\URL;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService
{
    public static function createSession(int $referenceId, string $trackingCode, string $email, array $items, array $routeNames, float $shippingCost = 0): object
    {
        $config = to_object(config('common.stripe'));

        $lineItems = [];
        collect($items)->each(function ($item) use (&$lineItems, $config) {
            $item = to_object($item);

            $lineItems[] = [
                'price_data' => [
                    'currency' => $config->currency,
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount_decimal' => $item->unit_amount,
                ],
                'quantity' => $item->quantity,
            ];
        });

        $payload = [
            'mode' => $config->mode,
            'client_reference_id' => $referenceId,
            'customer_email' => $email,
            'line_items' => $lineItems,
            'expires_at' => now()->addMinutes(30)->timestamp,
            'shipping_options' => []
        ];

        if ($shippingCost) {
            $shippingRate = array_merge($config->shipping_rate, [
                'fixed_amount' => [
                    'amount' => $shippingCost,
                    'currency' => $config->currency,
                ],
            ]);

            $payload['shipping_options'][] = [
                'shipping_rate_data' => $shippingRate
            ];
        }

        $parameters = [
            'reference_id' => $referenceId,
            'tracking_code' => $trackingCode, // It is used to recover the payment
        ];

        foreach ($routeNames as $key => $name) {
            $payload[$key] = URL::signedRoute($name, $parameters);
        }

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
        $secretKey = config('common.stripe.secret_key');

        $client = new StripeClient($secretKey);
        try {
            $session = $client->checkout->sessions->retrieve($id);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to retrieve Stripe checkout session.');
        }
        return $session;
    }

    public static function expireSession(string $id): void
    {
        $secretKey = config('common.stripe.secret_key');

        $client = new StripeClient($secretKey);
        try {
            $client->checkout->sessions->expire($id);

        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to expire Stripe checkout session.');
        }
    }
}
