<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    public function createTransaction()
    {
        return view('website.orders.paypal.index');
    }

    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => 1000
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        //dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $startTime = date("Y-m-d");
            $delivered_at = date('Y-m-d', strtotime('+1 day', strtotime($startTime)));

            $user_id = Auth::user()->id;
            $user = User::with('products', 'addresses')->find($user_id);
            if (empty($user->addresses[0]->id)) {
                return redirect()->route('profile.edit');
            }
            //dd($user);
            $discountedProducts = DB::table('products_discount')->get();

            $total_price = 0;
            foreach ($user->products as $product) {
                foreach ($discountedProducts as $sale) {
                    if ($sale->name_en == $product->name_en) {
                        $total_price += ($sale->price_after_discount) * ($product->pivot->quantity);
                    }
                }
                $total_price += ($product->price * $product->pivot->quantity);
            }
            $order = new Order();
            $order->payment_method = "PayPal";
            $order->status = 0;
            $order->delivered_at = $delivered_at;
            $order->address_id = $user->addresses[0]->id;
            $order->total_price = $total_price;
            $order->save();

            $products = Product::query()->where('id', $product->id)->with('users')->first();
            $newQuantity = ($products->quantity) - ($product->pivot->quantity);
            Product::query()->where('id', $product->id)->update(['quantity' => $newQuantity]);
            Cart::query()->where('user_id', $user_id)->delete();
            return redirect()
                ->route('payment.success')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function success(){
        return view('website.orders.paypal.success');
    }
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
