<?php

namespace App\Services;

use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;

class StripeService
{
    public function createCheckout(Payment $payment)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $transaction = $payment->transaction;
        $book = $transaction->book;

        if ($transaction->type === 'purchase') {
            $unitPrice = $book->purchase_price;
        } else {

            $days = Carbon::parse($transaction->rental_start)
                ->diffInDays(Carbon::parse($transaction->rental_end));

            $days = max(1, $days);

            $unitPrice = $book->rental_price * $days;
        }

        return Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($payment->currency),
                    'product_data' => [
                        'name' => $book->title,
                    ],
                    'unit_amount' => (int) ($unitPrice * 100),
                ],
                'quantity' => max(1, (int) $transaction->quantity),
            ]],

            'metadata' => [
                'payment_id' => $payment->id,
            ],

            'success_url' => route('payment.success') . '?payment_id=' . $payment->id,
            'cancel_url'  => route('payment.cancel') . '?payment_id=' . $payment->id,
        ]);
    }
}