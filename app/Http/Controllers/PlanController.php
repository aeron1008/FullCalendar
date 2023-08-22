<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use App\Models\Plan;
use Stripe\Checkout\Session;

class PlanController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $user = appUser();

        if ($user->isAdmin) {
            return redirect()->route('admin.home');
        }

        if (!$user->subscribedtoprice( config('services.stripe.price'))) {
            $plans = Plan::query()->get();
            return view("plans", compact("plans"));
        } else {
            $sub_plan = $user->subscriptionPrice(config('services.stripe.price'));
            $onTrial = $sub_plan->onTrial();
            $userOnGracePeriod = $user->subscriptionPrice(config('services.stripe.price'))->onGracePeriod();

            return view("plans", compact('sub_plan', 'onTrial', 'userOnGracePeriod'));
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request)
    {
        if (appUser()->isAdmin) {
            return redirect()->route('admin.home');
        }

        $intent = appUser()->createSetupIntent();

        return view("subscription", compact("plan", "intent"));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    {
        $user = appUser();

        if ($user->isAdmin) {
            return redirect()->route('admin.home');
        }

        $customerId = $user->stripe_id;

        if (empty($customerId)) {
            $customer = $user->createAsStripeCustomer();
            $customerId = $customer->id;
        }


//        $plan = Plan::query()->find($request->plan);

        $status = 'success';
        $message = 'Subscription purchase successfully!';

//        try {
//            $subscription = $user->newSubscription($request->plan_slug, $plan->stripe_plan)
//                ->trialDays(Plan::BASIC_PLAN_TRIAL)
//                ->create($request->token);
//        } catch (Exception $e) {
//            $message = $e->getMessage();
//            $status = 'error';
//        }

        \Stripe\Stripe::setApiKey(config('cashier.secret'));

        $session = Session::create([
            'line_items' => [
                [
                    'price' => config('services.stripe.price'),
                    'quantity' => 1
                ],
            ],
            'customer' => $customerId,
            'mode' => 'subscription',
            'success_url' => config('services.stripe.success'),
            'cancel_url' => config('services.stripe.fail'),
            'billing_address_collection' => "required",
            'currency' => "eur",
	    'locale' => "hr",
	    "automatic_tax" =>  ["enabled" => true],
	    "tax_id_collection" => [ "enabled" => true ],
            'customer_update' => [
                'name' => 'auto',
                'address' => 'auto'
            ],
            'payment_method_collection' => "always",
            'phone_number_collection' => [
                'enabled' => true,
            ],
            'subscription_data' => [
                'trial_period_days' => Plan::BASIC_PLAN_TRIAL,
            ],
        ]);

        return redirect()->away($session->url);

//        return view("subscription_success", compact('status', 'message'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cancel(Request $request)
    {
        $user = appUser();

        if ($user->isAdmin) {
            return redirect()->route('admin.home');
        }


        $status = 'success';
        $message = 'Subscription Renewal Canceled successfully!';
        try {
            // use cancelNow() for the immediate stripe cancellation
            $user->subscriptionPrice(config('services.stripe.price'))
                ->cancel();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $status = 'error';
        }

        return view("subscription_success", compact('status', 'message'));
    }
}