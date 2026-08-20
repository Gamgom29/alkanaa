<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CombinedOrder;
use App\Models\Address;

class TabbyController extends Controller
{
    private function baseUrl(): string
    {
        return config('services.tabby.env') === 'production'
            ? 'https://api.tabby.ai'
            : 'https://api.tabby.ai'; // أحياناً sandbox نفس الدومين مع مفاتيح sandbox
    }

    private function authHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . config('services.tabby.secret_key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    // 1) يبدأ عملية الدفع


    public function start(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->withErrors(['tabby' => 'Please login to continue.']);
        }

        // هات الأوردر المجمّع اللي اتكوّن في CheckoutController
        $combinedId = session('combined_order_id');
        $combined = $combinedId ? CombinedOrder::with('orders')->find($combinedId) : null;

        if (!$combined || $combined->orders->isEmpty()) {
            return back()->withErrors(['tabby' => 'Order not found. Please try again.']);
        }

        // المبلغ الحقيقي
        $amount = number_format((float) $combined->grand_total, 2, '.', '');
        $currency = 'SAR';

        // هات العنوان
        $order = $combined->orders->first();
        $address = Address::find($order->shipping_address);

        // هات رقم الموبايل الحقيقي ونظّفه
        $rawPhone = $user->phone ?? ($address->phone ?? null);
        if (!$rawPhone) {
            return back()->withErrors(['tabby' => 'Customer phone is missing. Please add phone number and try again.']);
        }

        $phone = preg_replace('/\s+/', '', $rawPhone);
        if ($phone[0] !== '+') {
            // لو الرقم سعودي ومكتوب 05xxxxxx
            $phone = '+966' . ltrim($phone, '0');
        }

        // ابنِ الـ items من الكارت
        $carts = Cart::where('user_id', $user->id)->active()->get();
        if ($carts->isEmpty()) {
            return back()->withErrors(['tabby' => 'Your cart is empty.']);
        }

        $items = [];
        foreach ($carts as $cart) {
            $items[] = [
                "title" => optional($cart->product)->name ?? 'Product',
                "quantity" => (int) $cart->quantity,
                "unit_price" => number_format((float) $cart->price, 2, '.', ''),
                "category" => optional(optional($cart->product)->category)->name ?? 'General',
            ];
        }

        // reference ثابت للأوردر
        $orderRef = 'ORD-' . $combined->id;

        $payload = [
            "payment" => [
                "amount" => $amount,
                "currency" => $currency,
                "description" => "Order #{$orderRef}",
                "buyer" => [
                    "email" => $user->email,
                    "phone" => $phone,
                    "name"  => $user->name,
                ],
                "shipping_address" => [
                    "city" => $address->city ?? 'Riyadh',
                    "address" => $address->address ?? 'N/A',
                    "zip" => $address->postal_code ?? '00000',
                ],
                "order" => [
                    "reference_id" => $orderRef,
                    "items" => $items,
                ],
                "success_url" => config('services.tabby.success_url'),
                "cancel_url"  => config('services.tabby.cancel_url'),
            ]
        ];

        Log::info('Tabby payload', ['payload' => $payload]);

        $res = Http::withHeaders($this->authHeaders())
            ->post($this->baseUrl() . '/api/v2/checkout', $payload);

        if (!$res->successful()) {
            Log::error('Tabby start failed', ['status' => $res->status(), 'body' => $res->body()]);
            return back()->withErrors(['tabby' => 'Tabby payment initialization failed.']);
        }

        $data = $res->json();

        $checkoutUrl =
            data_get($data, 'configuration.available_products.installments.0.web_url')
            ?? data_get($data, 'checkout_url');

        if (!$checkoutUrl) {
            Log::error('Tabby checkout url missing', ['data' => $data]);
            return back()->withErrors(['tabby' => 'Tabby checkout URL not found.']);
        }

        return redirect()->away($checkoutUrl);
    }

    public function success(Request $request)
    {
        // هنا تعرض صفحة نجاح "مبدئي"
        // الأفضل تعرض "جاري تأكيد الدفع" وتستنى الويبهوك يغير حالة الطلب
        return view('payment.tabby_success');
    }

    public function cancel(Request $request)
    {
        return view('payment.tabby_cancel');
    }

    // 4) Webhook لتأكيد الدفع
    public function webhook(Request $request)
    {
        // 1) Validate signature لو Tabby بتوفر secret/signature
        // (هتحتاج تبص في docs للحقل والـ header المستخدم)

        $payload = $request->all();

        Log::info('Tabby webhook received', ['payload' => $payload]);

        // 2) استخرج reference_id / checkout_id / status
        $referenceId = data_get($payload, 'order.reference_id') ?? data_get($payload, 'reference_id');
        $status = data_get($payload, 'status');

        // 3) حدّث الطلب عندك: paid/failed/canceled بناءً على status
        // Order::where('reference_id', $referenceId)->update([...])

        return response()->json(['ok' => true]);
    }
}
