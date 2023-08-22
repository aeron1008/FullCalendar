<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeWebhook extends Controller
{
    public function stripe_webhook_events(Request $request)
    {

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

// This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = config('cashier.webhook.secret');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

// Handle the event
        switch ($event->type) {
            case 'customer.subscription.created':
                $subscription = $event->data->object;
            case 'customer.subscription.updated':
                $subscription = $event->data->object;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);

    }


}
