<?php

use Kirby\Exception\Exception;
use Stripe\Stripe;
use Wagnerwagner\Merx\Gateways;

require_once __DIR__."/../shop/CartFunctions.php";
require 'vendor/autoload.php';

CartFunctions::setStripeApiKey();

// You can find your endpoint's secret in your webhook settings
$endpoint_secret = CartFunctions::getStripeWebhookSecret();

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

function fulfill_order($session) {
    $site = site();
    kirby()->impersonate('kirby');

    $orderPage = $site->index()->filterBy("intendedTemplate", "order")->listed()->filter(function($p) use ($session) {
        return $p->stripeSessionId() == $session->id;
    })->first();

    if (!isset($orderPage)) {
        throw new Exception([
            'key' => 'merx.order.not.found',
            'httpCode' => 500,
            'details' => [
                'message' => 'Requested order not found.',
            ],
            'data' => [
            ],
        ]);
    }

    $orderPage->update([
        'paymentComplete' => true,
        'payedDate' => date('c'),
    ]);
}

// Handle the checkout.session.completed event
if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object;

    // Fulfill the purchase...
    fulfill_order($session);
}
http_response_code(200);
