        @php
            use Illuminate\Support\Str;
            use Illuminate\Support\Facades\Cookie;

            if (!session()->get('temp_user_id')) {
                $temp_id = Cookie::get('temp_user_id') ?? Str::random(15);
                session()->put('temp_user_id', $temp_id);
                Cookie::queue('temp_user_id', $temp_id, 60 * 24 * 30); // يحفظه لمدة شهر
            }

            $user = auth()->user();
            $temp_user = session()->get('temp_user_id');

            // جلب السلة للمستخدم أو الزائر المؤقت
            $carts = auth()->check()
                ? \App\Models\Cart::where('user_id', auth()->id())
                : \App\Models\Cart::where('temp_user_id', $temp_user);

            $carts = $carts->latest()->get();

            // تهيئة المتغيرات
            $subtotal_for_min_order_amount = 0;
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $coupon_code = null;
            $coupon_discount = 0;
            $total_point = 0;
            $service_total = 0;

            // حساب قيمة الخدمة الإضافية
            foreach ($carts as $cartItem) {
                if (isset($cartItem->add_service) && $cartItem->add_service == 1) {
                    $product = get_single_product($cartItem->product_id);
                    $service_total += ($product->service_fee ?? 0) * $cartItem->quantity;
                }
            }

            // حساب باقي التفاصيل
            foreach ($carts as $cartItem) {
                $product = get_single_product($cartItem->product_id);

                $unitPrice = cart_product_price($cartItem, $product, false, false);
                $unitTax = cart_product_tax($cartItem, $product, false);
                $quantity = $cartItem->quantity;

                $subtotal_for_min_order_amount += $unitPrice * $quantity;
                $subtotal += $unitPrice * $quantity;
                $tax += $unitTax * $quantity;
                $shipping += $cartItem->shipping_cost ?? 0;

                if (get_setting('coupon_system') == 1 && $cartItem->coupon_applied == 1) {
                    $coupon_code = $cartItem->coupon_code;
                    $coupon_discount = $carts->sum('discount');
                }

                if (addon_is_activated('club_point')) {
                    $total_point += ($product->earn_point ?? 0) * $quantity;
                }
            }

            // حساب الإجمالي النهائي
            $total = $subtotal + $tax + $shipping + $service_total;

            if (Session::has('club_point')) {
                $total -= Session::get('club_point');
            }

            if ($coupon_discount > 0) {
                $total -= $coupon_discount;
            }
        @endphp

        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="cartOffcanvasLabel">{{ translate('Cart') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                aria-label="{{ translate('close') }}"></button>
        </div>

        <div class="offcanvas-body p-0">


            <div class="cart-header">
                <div class="help-box">
                    <span>
                        @if (app()->getLocale() == 'sa')
                            متردد أو بحاجة إلى مساعدة؟
                        @elseif (app()->getLocale() == 'cn')
                            需要帮助吗？
                        @else
                            Need help?
                        @endif
                    </span>
                    <i class="fab fa-whatsapp" style="color:#25D366; font-size:16px; margin:2px 5px 0px 5px;"></i>
                    <a href="#" class="text-decoration-none text-dark">
                        @if (app()->getLocale() == 'sa')
                            تحدث مع مختص الآن
                        @elseif (app()->getLocale() == 'cn')
                            立即与专家交谈
                        @else
                            Talk to a specialist now
                        @endif
                    </a>

                </div>

                <div class="cart-top">
                    <div class="cart-title">
                        {{ translate('Shopping Cart') }} <span>({{ sprintf('%d', $carts->count()) }})</span>
                    </div>
                    <button id="openFormBtn" class="download-btn">
                        <i class="fa-solid fa-download"></i>
                        @if (app()->getLocale() == 'sa')
                            حمل عرض السعر
                        @elseif (app()->getLocale() == 'cn')
                            下载报价
                        @else
                            Download Quote
                        @endif
                    </button>

                    <!-- الـ Bottom Sheet -->
                    <div class="bottom-sheet" id="bottomSheet">
                        <div class="bottom-sheet-content">
                            <span class="close-btn" id="closeFormBtn">&times;</span>
                            <h3 class="sheet-title">
                                @if (app()->getLocale() == 'sa')
                                    حمل عرض السعر
                                @elseif (app()->getLocale() == 'cn')
                                    下载报价
                                @else
                                    Download Quote
                                @endif
                            </h3>
                            <form>
                                <div class="form-group">
                                    <input type="text"
                                        @if (app()->getLocale() == 'sa') placeholder="الاسم بالكامل"
                                    @elseif (app()->getLocale() == 'cn')
                                        placeholder="全名"
                                    @else
                                        placeholder="Full Name" @endif
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                        @if (app()->getLocale() == 'sa') placeholder="البريد الإلكتروني"
       @elseif (app()->getLocale() == 'cn')
           placeholder="电子邮箱"
       @else
           placeholder="Email Address" @endif
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="tel"
                                        @if (app()->getLocale() == 'sa') placeholder="رقم الجوال"
       @elseif (app()->getLocale() == 'cn')
           placeholder="手机号码"
       @else
           placeholder="Phone Number" @endif
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        @if (app()->getLocale() == 'sa') placeholder="أدخل رقم ضريبة القيمة المضافة"
       @elseif (app()->getLocale() == 'cn')
           placeholder="输入增值税号"
       @else
           placeholder="Enter VAT Number" @endif>
                                </div>
                                <button type="submit" class="submit-btn">
                                    @if (app()->getLocale() == 'sa')
                                        حمل عرض السعر
                                    @elseif (app()->getLocale() == 'cn')
                                        下载报价
                                    @else
                                        Download Quote
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($carts->count() > 0)
                    @if ($shipping == 0)
                        <div class="free-shipping text-end">🚚 {{ translate('Your order will be shipped for free') }}
                        </div>
                    @else
                        <div class="free-shipping text-end">
                            🚚 {{ translate('Shipping') }}: {{ single_price($shipping) }}
                        </div>
                    @endif
                @endif
            </div>

            <div class="cart-items">
                @forelse ($carts as $cartItem)
                    @php
                        $product = get_single_product($cartItem->product_id);
                        $unitPrice = cart_product_price($cartItem, $product, false, false);
                        $lineTotal = $unitPrice * $cartItem->quantity;
                    @endphp
                    <div class="cart-item">
                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                            alt="{{ $product->getTranslation('name') }}">
                        <div class="item-details">
                            <div class="top-row">
                                <div class="item-name">{{ $product->getTranslation('name') }}</div>
                                <div class="item-price">{{ single_price($lineTotal) }}</div>
                            </div>
                            <div class="actions mt-4">
                                <span class="qty-box">{{ translate('quantity') }}: {{ $cartItem->quantity }}</span>

                                {{-- زرار حذف (لو عندك روت للحذف حطيه هنا) --}}
                                <span class="delete-box" data-id="{{ $cartItem->id }}"
                                    title="{{ translate('Remove') }}">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        {{ translate('Your cart is empty') }}
                    </div>
                @endforelse
            </div>


            <div class="cart-summary">
                <h3 class="summary-title">
                    {{ app()->getLocale() == 'sa' ? 'المبلغ الإجمالي' : (app()->getLocale() == 'cn' ? '总金额' : 'Order Summary') }}
                </h3>

                <div class="summary-row">
                    <span>{{ app()->getLocale() == 'sa' ? 'منتجات' : (app()->getLocale() == 'cn' ? '产品' : 'Products') }}</span>
                    <span>{{ single_price($subtotal) }} <img src="{{ asset('currency-icon.png') }}"
                            alt=""></span>
                </div>

                <div class="summary-row">
                    <span>{{ app()->getLocale() == 'sa' ? 'مصاريف الشحن' : (app()->getLocale() == 'cn' ? '运费' : 'Shipping') }}</span>
                    <span class="{{ $shipping == 0 ? 'free' : '' }}">
                        {{ $shipping == 0 ? (app()->getLocale() == 'sa' ? 'مجانا' : (app()->getLocale() == 'cn' ? '免费' : 'Free')) : single_price($shipping) }}
                        @if ($shipping != 0)
                            <img src="{{ asset('currency-icon.png') }}" alt="">
                        @endif
                    </span>
                </div>

                <div class="summary-row">
                    <span>{{ app()->getLocale() == 'sa' ? 'المبلغ الإجمالي الخاضع للضريبة' : (app()->getLocale() == 'cn' ? '含税金额' : 'Taxable Total') }}</span>
                    <span>{{ single_price($subtotal + $shipping) }} <img src="{{ asset('currency-icon.png') }}"
                            alt=""></span>
                </div>

                <div class="summary-row">
                    <span>{{ app()->getLocale() == 'sa' ? 'إجمالي مبلغ ضريبة القيمة المضافة' : (app()->getLocale() == 'cn' ? '增值税金额' : 'VAT Amount') }}</span>
                    <span>{{ single_price($tax) }} <img src="{{ asset('currency-icon.png') }}" alt=""></span>
                </div>

                <div class="summary-row">
                    <span>{{ app()->getLocale() == 'sa' ? 'رصيد المتجر' : (app()->getLocale() == 'cn' ? '商店余额' : 'Store Credit') }}</span>
                    <span>- {{ single_price(Session::get('club_point') ?? 0) }}</span>
                </div>

                <div class="summary-total">
                    <div>
                        <strong>{{ app()->getLocale() == 'sa' ? 'المجموع' : (app()->getLocale() == 'cn' ? '总计' : 'Total') }}</strong>
                        <span class="note">
                            {{ app()->getLocale() == 'sa' ? '(غير شامل ضريبة القيمة المضافة)' : (app()->getLocale() == 'cn' ? '(含增值税)' : '(Exclusive of VAT)') }}
                        </span>
                    </div>
                    <strong class="price">{{ single_price($total) }} <img src="{{ asset('currency-icon.png') }}"
                            alt=""></strong>
                </div>

                <div class="success-msg">
                    <span class="icon">👍</span>
                    {{ app()->getLocale() == 'sa' ? 'تهانينا! لقد حصلت على أفضل الأسعار في السوق' : (app()->getLocale() == 'cn' ? '恭喜！您已获得市场上最优惠的价格' : 'Congratulations! You’ve got the best prices in the market') }}
                </div>

                <div class="payment-methods">
                    <img src="{{ static_asset('assets/new_logo_images/bank-transfer.png') }}" alt="Bank Transfer">
                    <img src="{{ static_asset('assets/new_logo_images/cash-delivery.png') }}" alt="Cash on Delivery">
                    <img src="{{ static_asset('assets/new_logo_images/apple-pay.png') }}" alt="Apple Pay">
                    <img src="{{ static_asset('assets/new_logo_images/visa.png') }}" alt="Visa">
                    <img src="{{ static_asset('assets/new_logo_images/mastercard.png') }}" alt="MasterCard">
                    <img src="{{ static_asset('assets/new_logo_images/mada.png') }}" alt="Mada">
                </div>
            </div>


            @if ($carts->count() > 0)
                <div class="cart-footer">
                    <div class="footer-wrap">
                        <div class="footer-info">
                            <div class="total-row">
                                <span class="total-label">
                                    {{ translate('Total') }} <small>({{ translate('inclusive_of_vat') }})</small>
                                </span>
                            </div>

                            <div class="price-brand-row">
                                @php $header_logo = get_setting('header_logo'); @endphp
                                @if ($header_logo)
                                    <img src="{{ uploaded_asset($header_logo) }}" alt="brand" class="brand-logo">
                                @endif
                                <span class="price-big">{{ single_price($total) }}</span>
                            </div>

                            @if ($shipping == 0)
                                <div class="best-price-note">
                                    <i class="fas fa-sticky-note"></i>
                                    {{ translate('Best price guaranteed') }}
                                </div>
                            @endif
                        </div>

                        <div class="checkout-col">
                            <a href="{{ route('checkout') }}" class="checkout-btn">
                                {{ translate('Proceed to Checkout') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
