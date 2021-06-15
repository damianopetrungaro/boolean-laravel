<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Braintree\Gateway as Gateway;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request, Gateway $gateway): RedirectResponse
    {
        $data = $request->all();


        $nonceFromTheClient = $data["payment_method_nonce"];

        $clientToken = $gateway->clientToken()->generate();

        $result = $gateway->transaction()->sale([
            'amount' => $data["amount"],
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // return response()->json($result);
        return redirect()->route('paid');
    }
}
