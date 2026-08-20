<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TabbyController extends Controller
{
    public function pay(Request $request)
    {
        // ينده على الكنترولر اللي انت عامله بالفعل
        return app(\App\Http\Controllers\TabbyController::class)->start($request);
    }
}