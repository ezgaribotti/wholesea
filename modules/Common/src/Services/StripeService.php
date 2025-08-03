<?php

namespace Modules\Common\src\Services;

use Illuminate\Support\Facades\URL;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService
{
    public static function createSession(int $referenceId, string $trackingCode, string $email, array $items, array $routeNames): object
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
                    'unit_amount_decimal' => round($item->unit_amount * 100),
                ],
                'quantity' => $item->quantity,
            ];
        });

        $payload = [
            'mode' => $config->mode,
            'client_reference_id' => $referenceId,
            'customer_email' => $email,
            'line_items' => $lineItems,
            'expires_at' => now()->addMinutes(140)->timestamp,
        ];
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
