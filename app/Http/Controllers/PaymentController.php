<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Services\StripeService;
use Stripe\Webhook;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function checkout(Payment $payment)
    {
        if ($payment->transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $session = $this->stripe->createCheckout($payment);

        return redirect($session->url);
    }

    public function success()
    {
        return redirect()->route('transactions.index')
            ->with('success', 'Payment processing...');
    }

    
    public function cancel(Request $request)
    {
        $payment = Payment::find($request->payment_id);

        if ($payment && $payment->status === 'pending') {

            $payment->update([
                'status' => 'failed',
            ]);

            $payment->transaction->update([
                'status' => 'cancelled',
            ]);
        }

        return redirect('/')
            ->with('error', 'Payment cancelled');
    }

    
    public function webhook(Request $request)
    {
        
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $signature, $secret);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid'], 400);
        }

        if ($event->type === 'checkout.session.completed') {

    $session = $event->data->object;
    $paymentId = $session->metadata->payment_id ?? null;

    if ($paymentId) {

        $payment = Payment::with('transaction')->find($paymentId);

        if ($payment && $payment->status !== 'success') {

            $payment->update([
                'status' => 'success',
                'provider_payment_id' => $session->payment_intent,
            ]);

            $transaction = $payment->transaction;

            $transaction->update([
                'status' => 'paid',
                'code_retrait' => strtoupper(Str::random(8)),
            ]);

            $stock = Stock::where('book_id', $transaction->book_id)
                ->where('library_id', $transaction->library_id)
                ->first();

            if ($stock && $stock->quantity >= $transaction->quantity) {
                $stock->decrement('quantity', $transaction->quantity);
            }
        }
    }
}

        return response()->json(['ok' => true]);
        
    }
}