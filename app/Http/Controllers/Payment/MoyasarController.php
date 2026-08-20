<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\CombinedOrder;

class MoyasarController extends Controller
{

    public function pay(Request $request)
    {
        $combined_order_id = session('combined_order_id');

        if (!$combined_order_id) {
            flash(translate('Something went wrong. Please try again.'))->error();
            return redirect()->route('checkout');
        }

        $combinedOrder = CombinedOrder::findOrFail($combined_order_id);

        // Moyasar amount بالهللة
        $amountHalalah = (int) round($combinedOrder->grand_total * 100);

        $orderRef = 'CO-' . $combined_order_id;

        $returnUrl = config('services.moyasar.return_url'); // لازم يكون URL كامل https://...

        $payload = [
            "amount" => $amountHalalah,
            "currency" => "SAR",
            "description" => "Order #" . $orderRef,

            // مهم: return_url هو اللي هيرجع عليه بعد الدفع
            "callback_url" => $returnUrl,
            "return_url"   => $returnUrl,

            "metadata" => [
                "combined_order_id" => $combined_order_id,
                "order_ref" => $orderRef,
            ],

            // ✅ الحل: redirect بدل creditcard
            "source" => [
                "type" => "redirect",
            ],
        ];

        $secretKey = config('services.moyasar.secret_key');

        $res = Http::withBasicAuth($secretKey, '')
            ->acceptJson()
            ->post('https://api.moyasar.com/v1/payments', $payload);

        if (!$res->successful()) {
            flash('Moyasar error: ' . $res->body())->error();
            return redirect()->route('checkout');
        }

        $data = $res->json();

        DB::table('payment_sessions')->insert([
            'order_ref' => $orderRef,
            'gateway' => 'moyasar',
            'payment_id' => $data['id'] ?? null,
            'status' => $data['status'] ?? 'initiated',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // في redirect flow غالبًا بتبقى هنا:
        $redirectUrl =
            $data['source']['transaction_url'] ??
            $data['source']['redirect_url'] ??
            $data['transaction_url'] ??
            null;

        if (!$redirectUrl) {
            flash('No redirect URL from Moyasar: ' . json_encode($data))->error();
            return redirect()->route('checkout');
        }

        return redirect()->away($redirectUrl);
    }

    // public function form($combined_order_id)
    // {
    //     $combinedOrder = \App\Models\CombinedOrder::findOrFail($combined_order_id);

    //     // خزن عشان callback يعرف يرجع لأي order
    //     session(['moyasar_combined_order_id' => $combined_order_id]);

    //     return view('frontend.payment.moyasar_form', [
    //         'amountHalalah' => (int) round($combinedOrder->grand_total * 100),
    //         'description'   => 'Order #CO-' . $combined_order_id,
    //         'publishableKey' => config('services.moyasar.publishable_key'),
    //         'callbackUrl'   => route('moyasar.callback'),
    //     ]);
    // }

    // public function callback(Request $request)
    // {
    //     $paymentId = $request->query('id');
    //     $combinedId = session('moyasar_combined_order_id');

    //     if (!$paymentId || !$combinedId) {
    //         flash('Invalid payment callback.')->error();
    //         return redirect()->route('checkout');
    //     }

    //     $secretKey = config('services.moyasar.secret_key');

    //     $res = \Illuminate\Support\Facades\Http::withBasicAuth($secretKey, '')
    //         ->acceptJson()
    //         ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

    //     if (!$res->successful()) {
    //         flash('Failed to verify payment.')->error();
    //         return redirect()->route('checkout');
    //     }

    //     $payment = $res->json();

    //     // تحقق: status + amount + currency
    //     $combinedOrder = \App\Models\CombinedOrder::findOrFail($combinedId);
    //     $expectedAmount = (int) round($combinedOrder->grand_total * 100);

    //     if (($payment['status'] ?? null) === 'paid'
    //         && (int)($payment['amount'] ?? 0) === $expectedAmount
    //         && ($payment['currency'] ?? null) === 'SAR'
    //     ) {

    //         // هنا علّم الأوردر paid (نفس منطق checkout_done عندك)
    //         // أو نادِ دالة عندك تعمل تحديث لكل orders تحت combined
    //         return app(\App\Http\Controllers\CheckoutController::class)
    //             ->checkout_done($combinedId, json_encode($payment));
    //     }

    //     flash('Payment not completed.')->warning();
    //     return redirect()->route('checkout');
    // }

    // public function form($combined_order_id)
    // {
    //     $combinedOrder = CombinedOrder::findOrFail($combined_order_id);

    //     return view('frontend.payment.moyasar_form', [
    //         'amountHalalah'  => (int) round($combinedOrder->grand_total * 100),
    //         'description'    => 'Order #CO-' . $combined_order_id,
    //         'publishableKey' => config('services.moyasar.public_key'),
    //         'callbackUrl'    => route('moyasar.callback', ['combined_order_id' => $combined_order_id]),
    //     ]);
    // }

    public function form($combined_order_id)
    {
        $combinedOrder = CombinedOrder::findOrFail($combined_order_id);

        return view('frontend.payment.moyasar_form', [
            'amountHalalah'  => (int) round($combinedOrder->grand_total * 100),
            'description'    => 'Order #CO-' . $combined_order_id,
            'publishableKey' => config('services.moyasar.public_key'),
            'callbackUrl'    => route('moyasar.callback', [
                'combined_order_id' => $combined_order_id
            ]),
        ]);
    }


    // public function callback(Request $request, $combined_order_id)
    // {
    //     $paymentId = $request->query('id'); // Moyasar بيرجع id في query

    //     if (!$paymentId) {
    //         flash('Invalid payment callback.')->error();
    //         return redirect()->route('checkout');
    //     }

    //     $combinedOrder = CombinedOrder::findOrFail($combined_order_id);
    //     $expectedAmount = (int) round($combinedOrder->grand_total * 100);

    //     $secretKey = config('services.moyasar.secret_key');

    //     $res = Http::withBasicAuth($secretKey, '')
    //         ->acceptJson()
    //         ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

    //     if (!$res->successful()) {
    //         flash('Failed to verify payment.')->error();
    //         return redirect()->route('checkout');
    //     }

    //     $payment = $res->json();

    //     if (($payment['status'] ?? null) === 'paid'
    //         && (int)($payment['amount'] ?? 0) === $expectedAmount
    //         && ($payment['currency'] ?? null) === 'SAR'
    //     ) {
    //         return app(\App\Http\Controllers\CheckoutController::class)
    //             ->checkout_done($combined_order_id, json_encode($payment));
    //     }

    //     flash('Payment not completed.')->warning();
    //     return redirect()->route('checkout');
    // }

    public function callback(Request $request)
    {
        $paymentId = $request->query('id');
        $combined_order_id = $request->query('combined_order_id');

        if (!$paymentId || !$combined_order_id) {
            flash('Invalid payment callback.')->error();
            return redirect()->route('checkout');
        }

        $combinedOrder = CombinedOrder::findOrFail($combined_order_id);
        $expectedAmount = (int) round($combinedOrder->grand_total * 100);

        $secretKey = config('services.moyasar.secret_key');

        $res = Http::withBasicAuth($secretKey, '')
            ->acceptJson()
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if (!$res->successful()) {
            flash('Failed to verify payment.')->error();
            return redirect()->route('checkout');
        }

        $payment = $res->json();

        if (($payment['status'] ?? null) === 'paid'
            && (int)($payment['amount'] ?? 0) === $expectedAmount
            && ($payment['currency'] ?? null) === 'SAR'
        ) {
            return app(\App\Http\Controllers\CheckoutController::class)
                ->checkout_done($combined_order_id, json_encode($payment));
        }

        flash('Payment not completed.')->warning();
        return redirect()->route('checkout');
    }
}
