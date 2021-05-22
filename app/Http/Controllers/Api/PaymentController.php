<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;

class PaymentController extends Controller
{
    public function pay(Request $request) {
        $data = $request->all();

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '4wvx6k87m9sxq5k3',
            'publicKey' => 'p4rqqmp276684b36',
            'privateKey' => 'c7e93c2e0a9728be721a0140af83f1ae'
        ]);

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
          return redirect()->route('payed');
    }
}
