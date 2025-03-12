<?php

namespace Modules\Orders\src\Services;

use Illuminate\Support\Facades\URL;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService
{
    public static function createSession(int $orderId, string $email, array $items): object
    {
        $config = to_object(config('common.stripe'));

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
                    'unit_amount_decimal' => $product->unit_price,
                ],
                'quantity' => $item->quantity,
            ];
        });

        $parameters = ['order_id' => $orderId];

        $payload = [
            'mode' => $config->mode,
            'client_reference_id' => $orderId,
            'customer_email' => $email,
            'line_items' => $lineItems,
            'invoice_creation' => [
                'enabled' => true,
            ],
            'success_url' => URL::signedRoute('stripe.success', $parameters),
            'cancel_url' => URL::signedRoute('stripe.cancel', $parameters),
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

    public static function retrieveInvoice(string $id): object
    {
        $secretKey = config('common.stripe.secret_key');
        $client = new StripeClient($secretKey);

        try {
            $invoice = $client->invoices->retrieve($id);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to retrieve Stripe invoice.');
        }
        return $invoice;
    }
}
