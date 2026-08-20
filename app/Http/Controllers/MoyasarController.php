<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MoyasarController extends Controller
{
    // 1) Create Payment + Redirect URL
    public function create(Request $request)
    {
        // هنا بنبعت نفس فورم الشيك آوت، فهنستقبل total وغيره
        // خليك عملي: ابعت total من الفورم (هقولك تضيفه في Step 5)
        $request->validate([
            'amount_sar' => 'required|numeric|min:1',
            'order_ref'  => 'required|string',
            'name'       => 'nullable|string',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string',
        ]);

        $amountHalalah = (int) round($request->amount_sar * 100);

        $payload = [
            "amount" => $amountHalalah,
            "currency" => "SAR",
            "description" => "Order #" . $request->order_ref,
            "callback_url" => config('services.moyasar.return_url'),
            "return_url" => config('services.moyasar.return_url'),
            "source" => [
                "type" => "creditcard",
            ],
            "metadata" => [
                "order_ref" => $request->order_ref,
            ],
        ];


        $secretKey = config('services.moyasar.secret_key');

        $res = Http::withBasicAuth($secretKey, '')
            ->acceptJson()
            ->post('https://api.moyasar.com/v1/payments', $payload);

        if (!$res->successful()) {
            return back()->withErrors(['moyasar' => 'Moyasar error: ' . $res->body()]);
        }

        $data = $res->json();

        // مهم: خزّن payment_id عندك كـ Pending
        // انت عندك Orders/CombinedOrders.. اختار أبسط حاجة عندك.
        // هنا مثال سريع: جدول بسيط "payment_sessions" (لو مش موجود اعمل migration)
        DB::table('payment_sessions')->insert([
            'order_ref' => $request->order_ref,
            'gateway' => 'moyasar',
            'payment_id' => $data['id'] ?? null,
            'status' => $data['status'] ?? 'initiated',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Moyasar بيرجع pay_url عادة داخل source أو داخل روابط
        // في حالات كتير تلاقيه: $data['source']['transaction_url'] أو $data['source']['redirect_url']
        // فنعمل fallback:
        $redirectUrl =
            $data['source']['transaction_url'] ??
            $data['source']['redirect_url'] ??
            $data['transaction_url'] ??
            null;

        if (!$redirectUrl) {
            return back()->withErrors(['moyasar' => 'No redirect URL from Moyasar. Response: ' . $res->body()]);
        }

        return redirect()->away($redirectUrl);
    }

    // 2) Return URL بعد الدفع
    public function return(Request $request)
    {
        // Moyasar بيرجع payment_id أو id حسب السيناريو
        $paymentId = $request->get('id') ?? $request->get('payment_id');

        if (!$paymentId) {
            return redirect('/')->withErrors(['moyasar' => 'Missing payment id']);
        }

        $secretKey = config('services.moyasar.secret_key');

        $res = Http::withBasicAuth($secretKey, '')
            ->acceptJson()
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if (!$res->successful()) {
            return redirect('/')->withErrors(['moyasar' => 'Could not verify payment']);
        }

        $payment = $res->json();

        // حدّث حالتك عندك
        DB::table('payment_sessions')
            ->where('payment_id', $paymentId)
            ->update([
                'status' => $payment['status'] ?? 'unknown',
                'updated_at' => now(),
            ]);

        // لو paid -> كمل إنشاء الأوردر/علّم الدفع مدفوع
        if (($payment['status'] ?? '') === 'paid') {

            $combinedId = $payment['metadata']['combined_order_id'] ?? null;

            if ($combinedId) {
                // هنا اعمل update بسيط في orders -> payment_status = paid (لو عندك العمود)
                // أو اعمل redirect لصفحة order_confirmed الموجودة عندك
                return redirect()->route('order_confirmed')->with('success', 'Payment successful');
            }

            return redirect()->route('order_confirmed')->with('success', 'Payment successful');
        }


        return redirect('/checkout')->withErrors(['moyasar' => 'Payment not completed']);
    }

    // 3) Webhook (اختياري بس أقوى)
    public function webhook(Request $request)
    {
        // لو عندك webhook secret و signature validation من Moyasar ضيفها هنا
        $payload = $request->all();

        $paymentId = $payload['id'] ?? null;
        $status = $payload['status'] ?? null;

        if ($paymentId) {
            DB::table('payment_sessions')
                ->where('payment_id', $paymentId)
                ->update([
                    'status' => $status ?? 'unknown',
                    'updated_at' => now(),
                ]);
        }

        return response()->json(['ok' => true]);
    }
}
