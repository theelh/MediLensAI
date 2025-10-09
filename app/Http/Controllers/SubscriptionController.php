<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    // Display available plans
    public function choosePlans()
    {
        return view('subscription.choose');
    }

    // Show the user's current subscription
    public function show()
    {
        return view('subscription.show');
    }

    // Cancel the user's current subscription
    public function cancelPlan()
    {
        $user = auth()->user();
        $user->update(['is_subscribed' => false]);

        return redirect()->route('subscription.show')
            ->with('success', 'Your subscription has been canceled successfully.');
    }

    // Create a Stripe checkout session
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Pro Plan',
                    ],
                    'unit_amount' => 999, // $9.99
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('subscription.success'),
            'cancel_url' => route('subscription.cancel'),
        ]);

        return redirect($session->url);
    }

    // Success page after payment
    public function success()
    {
        $user = auth()->user();
        $user->update(['is_subscribed' => true]);

        return view('subscription.success');
    }

    // Cancel view if payment is aborted
    public function cancel()
    {
        return view('subscription.cancel');
    }
}
