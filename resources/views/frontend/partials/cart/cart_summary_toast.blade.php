<style>
    .summary-row span {
        font-weight: 700;
    }

    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -420px;
        width: 420px;
        height: 100%;
        background: #fff;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
        transition: right 0.4s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .cart-sidebar.active {
        right: 0;
    }

    .cart-header {
        padding: 20px;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    .location {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .help-box {
        background-color: #f8f8f8;
        padding: 10px;
        border: 1px solid #25D366;
        color: #444;
        display: flex;
        gap: 6px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .help-box span {
        color: #009688;
        font-weight: bold;
    }

    .free-shipping {
        color: #28a745;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .cart-items {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background-color: #fafafa;
        border-radius: 5px;
    }

    .cart-item {
        border-bottom: 1px solid #eee;
        padding: 10px;
        margin-bottom: 10px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #fff;
        border-radius: 5px;
    }

    .cart-item img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 3px;
        background: #fff;
    }

    .item-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .item-name {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        flex: 1;
    }

    .item-price {
        font-size: 14px;
        color: #444;
        font-weight: bold;
        white-space: nowrap;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 5px;
        margin-top: 5px;
    }

    .qty-box {
        padding: 5px 8px;
        background: #f0f0f0;
        border-radius: 4px;
        font-size: 13px;
    }

    .delete-box {
        padding: 5px 8px;
        background: #ffe5e5;
        border-radius: 4px;
        color: #d9534f;
        cursor: pointer;
    }

    .delete-box:hover {
        background: #ffcccc;
    }

    .delete-box i {
        font-size: 14px;
    }

    .cart-footer {
        border-top: 1px solid #ddd;
        padding: 15px;
        background-color: #fff;
    }

    .footer-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .footer-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 15px;
    }

    .total-row small {
        font-weight: 400;
        font-size: 12px;
        color: #666;
    }

    .price-brand-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .brand-logo {
        height: 28px;
        object-fit: contain;
    }

    .price-big {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        white-space: nowrap;
    }

    .best-price-note {
        background: #f5f5f5;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 12px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
    }

    .best-price-note i {
        color: #ff9800;
    }

    .checkout-col {
        display: flex;
        align-items: center;
    }

    .checkout-btn {
        background-color: #ae2025;
        color: #fff;
        padding: 12px 18px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        border-radius: 6px;
        white-space: nowrap;
    }

    .checkout-btn:hover {
        background-color: #ae2025;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 22px;
        border: none;
        background: none;
        cursor: pointer;
    }

    .cart-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
    }

    .cart-title {
        font-size: 16px;
        color: #333;
    }

    .cart-title span {
        color: #ff9800;
    }

    .pdf-btn {
        background-color: #ff9800;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 4px;
    }

    .pdf-btn:hover {
        background-color: #e68a00;
    }

    .cart-summary {
        background: #f9fafb;
        padding: 10px 20px;
        border-radius: 10px;
        direction: rtl;
    }

    .summary-title {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
        color: #333;
    }

    .summary-row .free {
        color: green;
        font-weight: bold;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-top: 15px;
        font-size: 16px;
    }

    .summary-total .note {
        font-size: 12px;
        color: #777;
        margin-right: 5px;
    }

    .price {
        font-size: 18px;
        color: green;
    }

    .success-msg {
        background: #eaf8ea;
        color: #0a8a0a;
        padding: 8px 10px;
        border-radius: 6px;
        font-size: 13px;
        margin-top: 10px;
    }

    .payment-methods {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .payment-methods img {
        height: 80px;
    }

    .bottom-sheet {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        justify-content: flex-end;
        z-index: 999;
    }

    /* محتوى الـ Bottom Sheet */
    .bottom-sheet-content {
        background: #fff;
        width: 100%;
        padding: 20px;
        border-radius: 20px 20px 0 0;
        animation: slideUp 0.3s ease;
    }

    .bottom-sheet-content h3 {
        text-align: center;
        margin-bottom: 15px;
    }

    .bottom-sheet-content input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .submit-btn {
        width: 100%;
        background: #20b2aa;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
    }

    .submit-btn:hover {
        background: #1d9d95;
    }

    /* زر الإغلاق */
    .close-btn {
        font-size: 24px;
        float: left;
        cursor: pointer;
    }

    .download-btn {
        background: #ae2025;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
    }

    /* خلفية التعتيم */
    .bottom-sheet {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        justify-content: flex-end;
        z-index: 999;
    }

    /* محتوى الـ Bottom Sheet */
    .bottom-sheet-content {
        background: #fff;
        width: 100%;
        max-width: 600px;
        margin: auto;
        padding: 25px 20px;
        border-radius: 20px 20px 0 0;
        animation: slideUp 0.3s ease;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
    }

    .sheet-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
        color: #444;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .bottom-sheet-content input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: border 0.2s;
    }

    .bottom-sheet-content input:focus {
        border-color: #20b2aa;
    }

    .submit-btn {
        width: 100%;
        background: #20b2aa;
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .submit-btn:hover {
        background: #1d9d95;
    }

    /* زر الإغلاق */
    .close-btn {
        font-size: 26px;
        float: left;
        cursor: pointer;
        color: #666;
    }

    .close-btn:hover {
        color: #000;
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }

    .qty-control {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f5f5f5;
        border-radius: 6px;
        padding: 4px 6px;
        border: 1px solid #e5e5e5;
    }

    .qty-btn {
        border: 0;
        background: #fff;
        width: 28px;
        height: 28px;
        line-height: 28px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 0 0 1px #ddd inset;
    }

    .qty-btn:disabled {
        opacity: .5;
        cursor: not-allowed
    }

    .qty-input {
        width: 56px;
        text-align: center;
        border: 0;
        background: transparent;
        font-size: 14px;
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    @keyframes qty-shake {
        0% {
            transform: translateX(0)
        }

        25% {
            transform: translateX(-3px)
        }

        50% {
            transform: translateX(3px)
        }

        75% {
            transform: translateX(-2px)
        }

        100% {
            transform: translateX(0)
        }
    }

    .qty-control.shake {
        animation: qty-shake .35s linear;
    }

    .qty-msg {
        font-size: 12px;
        color: #ae2025;
        margin-top: 6px
    }

    /* اجعل الـqty + remove في نفس السطر، والرسالة على سطر جديد */
    .actions {
        display: flex;
        align-items: center;
        /* توحيد الارتفاع العمودي */
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
        /* عشان نقدر ننزّل الرسالة تحت */
    }

    /* ارتفاع موحّد للبلوكين */
    .actions .qty-control {
        height: 36px;
    }

    .actions .delete-box {
        display: inline-flex;
        /* يوسّط الأيقونة */
        align-items: center;
        justify-content: center;
        height: 36px;
        padding: 0 10px;
        /* نفس ارتفاع/إحساس الـqty-control */
    }

    /* نزّل الرسالة تحتهم وما تكسّر السطر الرئيسي */
    .actions .qty-msg {
        order: 3;
        flex-basis: 100%;
        margin-top: 6px;
        /* نفس المارجن القديم لو تحب */
    }
</style>

@php
    // Reuse the cart passed in by the controller when there is one;
    // otherwise resolve it here so this partial still works when
    // @include'd directly.
    $carts = $carts ?? \App\Utility\CartUtility::current_user_cart_query(true)->latest()->get();

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

        $unitPrice = $product->unit_price;
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



<!-- Offcanvas (مرة واحدة بس في الصفحة) -->
<div class="offcanvas @if (app()->getLocale() == 'sa') offcanvas-start @else offcanvas-end @endif" style="width: 600px; padding-bottom:80px;" tabindex="-1" id="cartOffcanvas"
    aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="cartOffcanvasLabel">{{ translate('Cart') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
            aria-label="{{ translate('close') }}"></button>
    </div>

    <div class="offcanvas-body rtl p-0">
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
                  @if (app()->getLocale() == 'sa') سلة الشراء @elseif (app()->getLocale() == 'cn') 购物车 @else Shopping Cart @endif<span>({{ sprintf('%d', $carts->count()) }})</span>
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
                        <form action="{{ route('quotation.post') }}" method="POST" id="quotationForm">
                            @csrf
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

            <script>
                const openFormBtn = document.getElementById("openFormBtn");
                const closeFormBtn = document.getElementById("closeFormBtn");
                const bottomSheet = document.getElementById("bottomSheet");

                openFormBtn.addEventListener("click", () => {
                    bottomSheet.style.display = "flex";
                });

                closeFormBtn.addEventListener("click", () => {
                    bottomSheet.style.display = "none";
                });

                bottomSheet.addEventListener("click", (e) => {
                    if (e.target === bottomSheet) {
                        bottomSheet.style.display = "none";
                    }
                });
            </script>

            @if ($carts->count() > 0)
                @if ($shipping == 0)
                    <div class="free-shipping text-end">🚚  
                        @if (app()->getLocale() == 'sa') شحن مجانا @elseif (app()->getLocale() == 'cn') 免运费 @else Free Shipping @endif
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
                {{-- @php
                    $product = get_single_product($cartItem->product_id);
                    $unitPrice = cart_product_price($cartItem, $product, false, false);
                    $lineTotal = $unitPrice * $cartItem->quantity;
                @endphp --}}
                @php
                    $product = get_single_product($cartItem->product_id);
                    $product_stock = $product->stocks->where('variant', $cartItem->variation)->first();
                    $unitPrice = $product->unit_price;
                    //cart_product_price($cartItem, $product, false, false);
                    $lineTotal = $unitPrice * $cartItem->quantity;

                    $minQty = max(1, (int) ($product->min_qty ?? 1));
                    $maxQty = $product_stock ? (int) $product_stock->qty : null; // لو مفيش ستوك سيبها فاضية
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
                            {{-- <span class="qty-box">{{ translate('quantity') }}: {{ $cartItem->quantity }}</span> --}}
                            <div class="qty-control" data-id="{{ $cartItem->id }}" data-min="{{ $minQty }}"
                                @if (!is_null($maxQty)) data-max="{{ $maxQty }}" @endif
                                data-name="{{ e($product->getTranslation('name')) }}">

                                <button type="button" class="qty-btn qty-minus" aria-label="decrease">−</button>
                                <input type="number" class="qty-input" value="{{ $cartItem->quantity }}"
                                    min="{{ $minQty }}" step="1"
                                    @if ($maxQty) max="{{ $maxQty }}" @endif
                                    inputmode="numeric" pattern="[0-9]*">
                                <button type="button" class="qty-btn qty-plus" aria-label="increase">+</button>
                            </div>
                            <small class="qty-msg text-danger d-block mt-1"></small>

                            {{-- زرار حذف (لو عندك روت للحذف حطيه هنا) --}}
                            <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem->id }})">
                                <span class="delete-box" data-id="{{ $cartItem->id }}"
                                    title="{{ translate('Remove') }}">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </a>
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
                <span>{{ single_price($subtotal) }} <img src="{{ asset('currency-icon.png') }}" alt=""></span>
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
                        {{ app()->getLocale() == 'sa' ? '(شامل ضريبة القيمة المضافة)' : (app()->getLocale() == 'cn' ? '(含增值税)' : '(Inclusive of VAT)') }}
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
                                @if (app()->getLocale() == 'sa') ضمنت احسن سعر @elseif (app()->getLocale() == 'cn') 最佳价格 @else Best price guaranteed @endif
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
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
<script>
    /* ========= Cart Offcanvas + Qty (No Limits) ========= */
    (function waitForJQ() {
        if (!window.jQuery) {
            return setTimeout(waitForJQ, 30);
        }

        (function($) {
            'use strict';

            const LOCALE = '{{ app()->getLocale() }}';
            const $cart = $('#cartOffcanvas');
            const SEND_TO_SERVER = true; // خلّيها false لاختبار الفرونت فقط

            /* ------- helpers ------- */
            function showMsg($wrap, txt) {
                if (!txt) return;
                let $m = $wrap.siblings('.qty-msg');
                if (!$m.length) {
                    $m = $('<small class="qty-msg text-danger d-block mt-1"></small>');
                    $wrap.after($m);
                }
                $m.stop(true, true).text(txt).show().delay(2000).fadeOut(200);
            }

            /* ترجيع الدالة المفقودة: تجيب HTML وتحدّث العناصر داخل الأوف-كانفس */
            /*window.refreshCartToast = function(){
              const url = '{{ route('cart.offcanvas') }}';
              return $.get(url)
                .done(function(res){
                  const $html = $('<div>').html(res.html);
                  $('#cartOffcanvas .cart-items').replaceWith($html.find('.cart-items'));
                  $('#cartOffcanvas .cart-summary').replaceWith($html.find('.cart-summary'));
                  $('.cart-count-span').text(res.count);
                  $('#cartOffcanvas .cart-title span').text('(' + res.count + ')');
                })
                .fail(function(){
                  // بس ما نمنع الفتح حتى لو فشل الجلب
                  console.warn('refreshCartToast: request failed');
                });
            };*/
            window.refreshCartToast = function() {
                const url = '{{ route('cart.offcanvas') }}';
                return $.get(url)
                    .done(function(res) {
                        const $html = $('<div>').html(res.html);

                        // items + summary
                        $('#cartOffcanvas .cart-items').replaceWith($html.find('.cart-items'));
                        $('#cartOffcanvas .cart-summary').replaceWith($html.find('.cart-summary'));

                        // ====== NEW: handle footer ======
                        const $newFooter = $html.find('.cart-footer'); // اللي راجع من السيرفر
                        const $curFooter = $('#cartOffcanvas .cart-footer'); // اللي ظاهر حاليًا

                        if ($newFooter.length) {
                            // فيه Footer جديد
                            if ($curFooter.length) {
                                $curFooter.replaceWith($newFooter);
                            } else {
                                // لو مكنش موجود، ضيفه آخر الـ offcanvas-body
                                $('#cartOffcanvas .offcanvas-body').append($newFooter);
                            }
                        } else {
                            // السيرفر رجّع مفيش Footer (يعني السلة فاضية) → شيله لو موجود
                            $curFooter.remove();
                        }
                        // ================================

                        // العداد والعنوان
                        $('.cart-count-span').text(res.count);
                        $('#cartOffcanvas .cart-title span').text('(' + res.count + ')');
                    })
                    .fail(function() {
                        console.warn('refreshCartToast: request failed');
                    });
            };


            /* فتح الأوف-كانفس بأمان حتى لو refresh رمى خطأ */
            window.openCartOffcanvas = function() {
                const el = document.getElementById('cartOffcanvas');
                if (!el) {
                    return;
                }
                try {
                    const p = window.refreshCartToast();
                    // لو p موجود (jqXHR)، افتح بعد ما يخلّص؛ ولو مش موجود افتح فورًا
                    if (p && typeof p.always === 'function') {
                        p.always(function() {
                            bootstrap.Offcanvas.getOrCreateInstance(el).show();
                        });
                    } else {
                        bootstrap.Offcanvas.getOrCreateInstance(el).show();
                    }
                } catch (e) {
                    bootstrap.Offcanvas.getOrCreateInstance(el).show();
                }
            };

            // زرار "اذهب للسلة" لو موجود
            $(document).on('click', '.go-cart-btn', function(e) {
                e.preventDefault();
                openCartOffcanvas();
            });

            /* ------- API fallbacks ------- */
            window.updateQuantity = window.updateQuantity || function(key, el) {
                if (!SEND_TO_SERVER) return;
                $.post('{{ route('cart.updateQuantity') }}', {
                        _token: AIZ.data.csrf,
                        id: key,
                        quantity: el.value
                    })
                    .done(function(data) {
                        if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data
                            .cart_count);
                        if ($('#cart-details').length) $('#cart-details').html(data.cart_view);
                        window.refreshCartToast && window.refreshCartToast();
                    });
            };

            window.removeFromCartView = window.removeFromCartView || function(e, key) {
                e && e.preventDefault();
                $.post('{{ route('cart.removeFromCart') }}', {
                        _token: AIZ.data.csrf,
                        id: key
                    })
                    .done(function(data) {
                        if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data
                            .cart_count);
                        if ($('#cart-details').length) $('#cart-details').html(data.cart_view);
                        window.refreshCartToast && window.refreshCartToast();
                        AIZ?.plugins?.notify && AIZ.plugins.notify('success',
                            "{{ translate('Item_has_been_removed_from_cart') }}");
                    });
            };

            /* ------- QTY: no max limit ------- */
            $cart.on('click', '.qty-plus', function() {
                const $wrap = $(this).closest('.qty-control');
                const $input = $wrap.find('.qty-input');
                const id = $wrap.data('id');

                let v = parseInt($input.val(), 10);
                if (isNaN(v)) v = 0;
                v += 1;
                $input.val(v);
                updateQuantity(id, $input[0]);
            });

            $cart.on('click', '.qty-minus', function() {
                const $wrap = $(this).closest('.qty-control');
                const $input = $wrap.find('.qty-input');
                const id = $wrap.data('id');

                let v = parseInt($input.val(), 10);
                if (isNaN(v) || v <= 1) {
                    const msg = LOCALE === 'sa' ? 'أقل كمية هي 1' : LOCALE === 'cn' ? '最小数量为 1' :
                        'Minimum quantity is 1';
                    showMsg($wrap, msg);
                    v = 1;
                } else {
                    v -= 1;
                }
                $input.val(v);
                updateQuantity(id, $input[0]);
            });

            $cart.on('change', '.qty-input', function() {
                const $wrap = $(this).closest('.qty-control');
                const id = $wrap.data('id');
                let v = parseInt(this.value, 10);

                if (isNaN(v) || v < 1) {
                    v = 1;
                    const msg = LOCALE === 'sa' ? 'أقل كمية هي 1' : LOCALE === 'cn' ? '最小数量为 1' :
                        'Minimum quantity is 1';
                    showMsg($wrap, msg);
                }
                this.value = v;
                updateQuantity(id, this);
            });

        })(window.jQuery);
    })();
</script>


{{-- <script>
    const LOCALE = '{{ app()->getLocale() }}';
    const $cart = $('#cartOffcanvas');

    function buildMsg(kind, {
        name,
        min,
        max
    }) {
        if (LOCALE === 'sa') {
            return kind === 'max' ?
                `المتاح حاليًا من "${name}" ${max} فقط.` :
                `أقل كمية يمكن طلبها من "${name}" هي ${min}.`;
        } else if (LOCALE === 'cn') {
            return kind === 'max' ?
                `当前“${name}”仅剩 ${max} 件。` :
                `“${name}”的最小订购量为 ${min} 件。`;
        } else {
            return kind === 'max' ?
                `Only ${max} of "${name}" available right now.` :
                `The minimum order quantity for "${name}" is ${min}.`;
        }
    }

    function showInlineMsg(wrap, msg) {
        let $msg = wrap.next('.qty-msg');
        if (!$msg.length) {
            $msg = $('<small class="qty-msg text-danger d-block mt-1"></small>');
            wrap.after($msg);
        }
        $msg.text(msg).stop(true, true).fadeIn(0).delay(2500).fadeOut(200);
        wrap.addClass('shake');
        setTimeout(() => wrap.removeClass('shake'), 400);
    }

    function notifyLimit(wrap, kind) {
        const name = wrap.data('name') || '{{ translate('this item') }}';
        const min = parseInt(wrap.data('min')) || 1;
        const rawMax = wrap.data('max');
        const hasMax = typeof rawMax !== 'undefined' && rawMax !== '' && !isNaN(parseInt(rawMax));
        const max = hasMax ? parseInt(rawMax) : Infinity;
        const msg = buildMsg(kind, {
            name,
            min,
            max
        });
        showInlineMsg(wrap, msg);
    }

    function syncQtyState(scope) {
        $(scope).find('.qty-control').each(function() {
            const min = parseInt($(this).data('min')) || 1;
            const rawMax = $(this).data('max');
            const hasMax = typeof rawMax !== 'undefined' && rawMax !== '' && !isNaN(parseInt(rawMax));
            const max = hasMax ? parseInt(rawMax) : Infinity;
            const val = parseInt($(this).find('.qty-input').val()) || min;
            // الجديد (يبقي clickable ويعرض الرسالة):
            const minBtn = $(this).find('.qty-minus');
            const plusBtn = $(this).find('.qty-plus');

            const tMin = (LOCALE === 'sa') ? `الحد الأدنى ${min}` :
                (LOCALE === 'cn') ? `最小数量 ${min}` : `Min ${min}`;
            const tMax = (LOCALE === 'sa') ? `الحد الأقصى ${isFinite(max)?max:'∞'}` :
                (LOCALE === 'cn') ? `最大数量 ${isFinite(max)?max:'∞'}` : `Max ${isFinite(max)?max:'∞'}`;

            minBtn.attr('aria-disabled', val <= min).attr('title', val <= min ? tMin : '');
            plusBtn.attr('aria-disabled', isFinite(max) && val >= max).attr('title', (isFinite(max) && val >=
                max) ? tMax : '');

        });
    }

    // بعد أي Refresh
    function refreshCartToast() {
        $.get('{{ route('cart.offcanvas') }}', function(res) {
            var $html = $('<div>').html(res.html);
            $('#cartOffcanvas .cart-items').replaceWith($html.find('.cart-items'));
            $('#cartOffcanvas .cart-summary').replaceWith($html.find('.cart-summary'));
            $('.cart-count-span').text(res.count);
            $('#cartOffcanvas .cart-title span').text('(' + res.count + ')');
            syncQtyState('#cartOffcanvas');
        });
    }



    // افتح الأوف-كانفس واعمِل تحديث قبل العرض
    function openCartOffcanvas() {
        refreshCartToast();
        const cartCanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
        cartCanvas.show();
    }

    // بدل ما تعتمد على removeFromCart() بتاعة الثيم، خلّي في فيو التوست
    // الدالة دي تبعت حذف وتحدّث التوست + الناف
    function removeFromCartView(e, key) {
        e.preventDefault();
        $.post('{{ route('cart.removeFromCart') }}', {
            _token: AIZ.data.csrf,
            id: key
        }, function(data) {
            // تحديث الناف والصفحة الرئيسية (لو أنت عليها)
            if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data.cart_count);
            if ($('#cart-details').length) {
                $('#cart-details').html(data.cart_view);
                if (AIZ?.extra?.plusMinus) AIZ.extra.plusMinus();
            }
            // الأهم: حدّث التوست
            refreshCartToast();
            if (AIZ?.plugins?.notify) AIZ.plugins.notify('success',
                "{{ translate('Item has been removed from cart') }}");
        });
    }

    // لو بتعدّل الكمية من أي مكان: بعد الـsuccess حدّث التوست برضه
    function updateQuantity(key, element) {
        $.post('{{ route('cart.updateQuantity') }}', {
            _token: AIZ.data.csrf,
            id: key,
            quantity: element.value
        }, function(data) {
            if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data.cart_count);
            if ($('#cart-details').length) {
                $('#cart-details').html(data.cart_view);
                if (AIZ?.extra?.plusMinus) AIZ.extra.plusMinus();
            }
            refreshCartToast();
        });
    }
    // زيادة
    $cart.on('click', '.qty-plus', function() {
        const wrap = $(this).closest('.qty-control');
        const input = wrap.find('.qty-input');
        const rawMax = wrap.data('max');
        const hasMax = typeof rawMax !== 'undefined' && rawMax !== '' && !isNaN(parseInt(rawMax));
        const max = hasMax ? parseInt(rawMax) : Infinity;
        const id = wrap.data('id');

        let val = parseInt(input.val()) || 0;
        if (val >= max) {
            notifyLimit(wrap, 'max');
            syncQtyState($cart);
            return;
        }
        val += 1;
        input.val(val);
        updateQuantity(id, input[0]);
        syncQtyState($cart);
    });

    // نقصان
    $cart.on('click', '.qty-minus', function() {
        const wrap = $(this).closest('.qty-control');
        const input = wrap.find('.qty-input');
        const min = parseInt(wrap.data('min')) || 1;
        const id = wrap.data('id');

        let val = parseInt(input.val()) || min;
        if (val <= min) {
            notifyLimit(wrap, 'min');
            syncQtyState($cart);
            return;
        }
        val -= 1;
        input.val(val);
        updateQuantity(id, input[0]);
        syncQtyState($cart);
    });

    // كتابة يدويًا
    $cart.on('change', '.qty-input', function() {
        const wrap = $(this).closest('.qty-control');
        const id = wrap.data('id');
        const min = parseInt(wrap.data('min')) || 1;
        const rawMax = wrap.data('max');
        const hasMax = typeof rawMax !== 'undefined' && rawMax !== '' && !isNaN(parseInt(rawMax));
        const max = hasMax ? parseInt(rawMax) : Infinity;

        let old = parseInt(this.defaultValue) || min;
        let v = parseInt(this.value) || min;

        if (v > max) {
            v = max;
            notifyLimit(wrap, 'max');
        }
        if (v < min) {
            v = min;
            notifyLimit(wrap, 'min');
        }

        this.value = v;
        if (v !== old) updateQuantity(id, this);
        syncQtyState($cart);
    });
    syncQtyState('#cartOffcanvas');
</script> --}}
