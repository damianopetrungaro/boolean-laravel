<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function payment(Gateway $gateway): View
    {
        $clientToken = $gateway->clientToken()->generate();

        return view('guests.payment', compact('clientToken'));
    }

    public function paid(): View
    {
        return view('guests.paid');
    }
}
