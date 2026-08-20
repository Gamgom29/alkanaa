@php
    // Reuse the cart passed in by the controller when there is one;
    // otherwise resolve it here so this partial still works when
    // @include'd directly.
    $carts = $carts ?? \App\Utility\CartUtility::current_user_cart_query(true)->latest()->get();

    $subtotal_for_min_order_amount = 0;
    $subtotal = 0;
    $tax = 0;
    $shipping = 0;
    $coupon_code = null;
    $coupon_discount = 0;
    $total_point = 0;
    $service_total = 0;

    foreach ($carts as $cartItem) {
        if (isset($cartItem->add_service) && $cartItem->add_service == 1) {
            $product = get_single_product($cartItem->product_id);
            $service_total += ($product->service_fee ?? 0) * $cartItem->quantity;
        }
    }

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

    $total = $subtotal + $tax + $shipping + $service_total;

    if (Session::has('club_point')) {
        $total -= Session::get('club_point');
    }

    if ($coupon_discount > 0) {
        $total -= $coupon_discount;
    }
@endphp

<x-drawer-shell id="cart-drawer" side="{{ app()->getLocale() == 'sa' ? 'start' : 'end' }}" width="max-w-xl">
    <div x-data="{ quoteFormOpen: false }" class="flex h-full flex-col">
        <div class="p-5 border-b border-neutral-100 bg-neutral-50">
            <div class="flex items-center gap-2 rounded-md border border-success/30 bg-success/5 p-2.5 text-sm text-neutral-700">
                <i class="fab fa-whatsapp text-success text-base"></i>
                <span class="font-medium">
                    @if (app()->getLocale() == 'sa') متردد أو بحاجة إلى مساعدة؟
                    @elseif (app()->getLocale() == 'cn') 需要帮助吗？
                    @else Need help?
                    @endif
                </span>
                <a href="#" class="text-neutral-900 underline">
                    @if (app()->getLocale() == 'sa') تحدث مع مختص الآن
                    @elseif (app()->getLocale() == 'cn') 立即与专家交谈
                    @else Talk to a specialist now
                    @endif
                </a>
            </div>

            <div class="flex items-center justify-between mt-3">
                <div class="text-base font-semibold text-neutral-900">
                    @if (app()->getLocale() == 'sa') سلة الشراء @elseif (app()->getLocale() == 'cn') 购物车 @else Shopping Cart @endif
                    <span class="text-primary">({{ sprintf('%d', $carts->count()) }})</span>
                </div>
                <button type="button" x-on:click="quoteFormOpen = true" class="inline-flex items-center gap-2 rounded-md bg-primary px-3 py-2 text-sm font-medium text-white hover:bg-primary-dark">
                    <i class="fa-solid fa-download"></i>
                    @if (app()->getLocale() == 'sa') حمل عرض السعر
                    @elseif (app()->getLocale() == 'cn') 下载报价
                    @else Download Quote
                    @endif
                </button>
            </div>

            @if ($carts->count() > 0)
                <div class="text-end text-sm mt-2 {{ $shipping == 0 ? 'text-success font-medium' : 'text-neutral-600' }}">
                    🚚
                    @if ($shipping == 0)
                        @if (app()->getLocale() == 'sa') شحن مجانا @elseif (app()->getLocale() == 'cn') 免运费 @else Free Shipping @endif
                    @else
                        {{ translate('Shipping') }}: {{ single_price($shipping) }}
                    @endif
                </div>
            @endif
        </div>

        <!-- Download Quote bottom sheet -->
        <div
            x-show="quoteFormOpen"
            x-transition.opacity
            class="fixed inset-0 z-[60] flex items-end justify-center bg-neutral-900/40"
            x-on:click.self="quoteFormOpen = false"
            style="display: none;"
        >
            <div
                x-show="quoteFormOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0"
                class="w-full max-w-xl rounded-t-2xl bg-white p-6 shadow-md"
            >
                <button type="button" x-on:click="quoteFormOpen = false" class="float-left text-2xl text-neutral-400 hover:text-neutral-900" aria-label="{{ translate('Close') }}">&times;</button>
                <h3 class="text-center text-lg font-semibold text-neutral-800 mb-4">
                    @if (app()->getLocale() == 'sa') حمل عرض السعر
                    @elseif (app()->getLocale() == 'cn') 下载报价
                    @else Download Quote
                    @endif
                </h3>
                <form action="{{ route('quotation.post') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" class="w-full rounded-md border border-neutral-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                        placeholder="@if (app()->getLocale() == 'sa') الاسم بالكامل @elseif (app()->getLocale() == 'cn') 全名 @else Full Name @endif" required>
                    <input type="email" class="w-full rounded-md border border-neutral-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                        placeholder="@if (app()->getLocale() == 'sa') البريد الإلكتروني @elseif (app()->getLocale() == 'cn') 电子邮箱 @else Email Address @endif" required>
                    <input type="tel" class="w-full rounded-md border border-neutral-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                        placeholder="@if (app()->getLocale() == 'sa') رقم الجوال @elseif (app()->getLocale() == 'cn') 手机号码 @else Phone Number @endif" required>
                    <input type="text" class="w-full rounded-md border border-neutral-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                        placeholder="@if (app()->getLocale() == 'sa') أدخل رقم ضريبة القيمة المضافة @elseif (app()->getLocale() == 'cn') 输入增值税号 @else Enter VAT Number @endif">
                    <button type="submit" class="w-full rounded-md bg-info py-3 font-medium text-white hover:opacity-90">
                        @if (app()->getLocale() == 'sa') حمل عرض السعر
                        @elseif (app()->getLocale() == 'cn') 下载报价
                        @else Download Quote
                        @endif
                    </button>
                </form>
            </div>
        </div>

        <div class="cart-items flex-1 overflow-y-auto bg-neutral-50 p-4 space-y-3">
            @forelse ($carts as $cartItem)
                @php
                    $product = get_single_product($cartItem->product_id);
                    $product_stock = $product->stocks->where('variant', $cartItem->variation)->first();
                    $unitPrice = $product->unit_price;
                    $lineTotal = $unitPrice * $cartItem->quantity;

                    $minQty = max(1, (int) ($product->min_qty ?? 1));
                    $maxQty = $product_stock ? (int) $product_stock->qty : null;
                @endphp

                <div class="flex items-start gap-3 rounded-md border border-neutral-100 bg-white p-3">
                    <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}" class="size-15 shrink-0 rounded border border-neutral-200 object-contain p-1">
                    <div class="flex-1 flex flex-col gap-2">
                        <div class="flex items-center justify-between gap-2">
                            <div class="text-sm font-semibold text-neutral-800">{{ $product->getTranslation('name') }}</div>
                            <div class="text-sm font-bold text-neutral-800 whitespace-nowrap">{{ single_price($lineTotal) }}</div>
                        </div>
                        <div class="flex items-center justify-end flex-wrap gap-2">
                            <div
                                class="qty-control inline-flex h-9 items-center gap-1.5 rounded-md border border-neutral-200 bg-neutral-50 px-1.5"
                                data-id="{{ $cartItem->id }}" data-min="{{ $minQty }}"
                                @if (!is_null($maxQty)) data-max="{{ $maxQty }}" @endif
                                data-name="{{ e($product->getTranslation('name')) }}"
                            >
                                <button type="button" class="qty-btn qty-minus flex size-7 items-center justify-center rounded shadow-[0_0_0_1px_theme(colors.neutral.200)_inset] font-bold hover:bg-white" aria-label="decrease">&minus;</button>
                                <input type="number" class="qty-input w-12 border-0 bg-transparent text-center text-sm focus:outline-none" value="{{ $cartItem->quantity }}" min="{{ $minQty }}" step="1" @if ($maxQty) max="{{ $maxQty }}" @endif inputmode="numeric" pattern="[0-9]*">
                                <button type="button" class="qty-btn qty-plus flex size-7 items-center justify-center rounded shadow-[0_0_0_1px_theme(colors.neutral.200)_inset] font-bold hover:bg-white" aria-label="increase">&plus;</button>
                            </div>
                            <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem->id }})" class="delete-box flex h-9 items-center justify-center rounded-md bg-danger/10 px-2.5 text-danger hover:bg-danger/20" title="{{ translate('Remove') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        <small class="qty-msg hidden text-xs text-danger"></small>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-neutral-500">
                    {{ translate('Your cart is empty') }}
                </div>
            @endforelse
        </div>

        <div class="cart-summary bg-neutral-50 px-5 py-4 border-t border-neutral-100">
            <h3 class="text-base font-semibold text-neutral-800 mb-3">
                {{ app()->getLocale() == 'sa' ? 'المبلغ الإجمالي' : (app()->getLocale() == 'cn' ? '总金额' : 'Order Summary') }}
            </h3>

            <div class="flex justify-between text-sm text-neutral-700 mb-1.5">
                <span>{{ app()->getLocale() == 'sa' ? 'منتجات' : (app()->getLocale() == 'cn' ? '产品' : 'Products') }}</span>
                <span>{{ single_price($subtotal) }}</span>
            </div>
            <div class="flex justify-between text-sm text-neutral-700 mb-1.5">
                <span>{{ app()->getLocale() == 'sa' ? 'مصاريف الشحن' : (app()->getLocale() == 'cn' ? '运费' : 'Shipping') }}</span>
                <span class="{{ $shipping == 0 ? 'text-success font-semibold' : '' }}">
                    {{ $shipping == 0 ? (app()->getLocale() == 'sa' ? 'مجانا' : (app()->getLocale() == 'cn' ? '免费' : 'Free')) : single_price($shipping) }}
                </span>
            </div>
            <div class="flex justify-between text-sm text-neutral-700 mb-1.5">
                <span>{{ app()->getLocale() == 'sa' ? 'المبلغ الإجمالي الخاضع للضريبة' : (app()->getLocale() == 'cn' ? '含税金额' : 'Taxable Total') }}</span>
                <span>{{ single_price($subtotal + $shipping) }}</span>
            </div>
            <div class="flex justify-between text-sm text-neutral-700 mb-1.5">
                <span>{{ app()->getLocale() == 'sa' ? 'إجمالي مبلغ ضريبة القيمة المضافة' : (app()->getLocale() == 'cn' ? '增值税金额' : 'VAT Amount') }}</span>
                <span>{{ single_price($tax) }}</span>
            </div>
            @if (Session::get('club_point'))
                <div class="flex justify-between text-sm text-neutral-700 mb-1.5">
                    <span>{{ app()->getLocale() == 'sa' ? 'رصيد المتجر' : (app()->getLocale() == 'cn' ? '商店余额' : 'Store Credit') }}</span>
                    <span>- {{ single_price(Session::get('club_point') ?? 0) }}</span>
                </div>
            @endif

            <div class="flex items-baseline justify-between mt-3 pt-3 border-t border-neutral-200">
                <div>
                    <strong class="text-neutral-900">{{ app()->getLocale() == 'sa' ? 'المجموع' : (app()->getLocale() == 'cn' ? '总计' : 'Total') }}</strong>
                    <span class="text-xs text-neutral-500 ms-1">
                        {{ app()->getLocale() == 'sa' ? '(شامل ضريبة القيمة المضافة)' : (app()->getLocale() == 'cn' ? '(含增值税)' : '(Inclusive of VAT)') }}
                    </span>
                </div>
                <strong class="text-lg text-success">{{ single_price($total) }}</strong>
            </div>

            <div class="mt-3 rounded-md bg-success/10 px-3 py-2 text-sm text-success">
                👍
                {{ app()->getLocale() == 'sa' ? 'تهانينا! لقد حصلت على أفضل الأسعار في السوق' : (app()->getLocale() == 'cn' ? '恭喜！您已获得市场上最优惠的价格' : 'Congratulations! You’ve got the best prices in the market') }}
            </div>

            <div class="flex flex-wrap gap-2.5 mt-3">
                <img src="{{ static_asset('assets/new_logo_images/bank-transfer.png') }}" alt="Bank Transfer" class="h-10">
                <img src="{{ static_asset('assets/new_logo_images/cash-delivery.png') }}" alt="Cash on Delivery" class="h-10">
                <img src="{{ static_asset('assets/new_logo_images/apple-pay.png') }}" alt="Apple Pay" class="h-10">
                <img src="{{ static_asset('assets/new_logo_images/visa.png') }}" alt="Visa" class="h-10">
                <img src="{{ static_asset('assets/new_logo_images/mastercard.png') }}" alt="MasterCard" class="h-10">
                <img src="{{ static_asset('assets/new_logo_images/mada.png') }}" alt="Mada" class="h-10">
            </div>
        </div>

        @if ($carts->count() > 0)
            <div class="cart-footer border-t border-neutral-200 bg-white p-4 shrink-0">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1">
                        <div class="text-xs text-neutral-500">{{ translate('Total') }} ({{ translate('inclusive_of_vat') }})</div>
                        <div class="flex items-center gap-2 mt-1">
                            @php $header_logo = get_setting('header_logo'); @endphp
                            @if ($header_logo)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="brand" class="h-7 object-contain">
                            @endif
                            <span class="text-base font-bold text-neutral-900">{{ single_price($total) }}</span>
                        </div>
                        @if ($shipping == 0)
                            <div class="inline-flex items-center gap-1.5 rounded bg-neutral-100 px-2 py-1 text-xs text-neutral-700 mt-1.5">
                                <i class="fas fa-sticky-note text-warning"></i>
                                @if (app()->getLocale() == 'sa') ضمنت احسن سعر @elseif (app()->getLocale() == 'cn') 最佳价格 @else Best price guaranteed @endif
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('checkout') }}" class="shrink-0 rounded-md bg-primary px-5 py-3 text-sm font-semibold text-white hover:bg-primary-dark whitespace-nowrap">
                        {{ translate('Proceed to Checkout') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-drawer-shell>

<script>
    (function waitForJQ() {
        if (!window.jQuery) {
            return setTimeout(waitForJQ, 30);
        }

        (function ($) {
            'use strict';

            const LOCALE = '{{ app()->getLocale() }}';
            const $cart = $('#cart-drawer');

            function showMsg($wrap, txt) {
                if (!txt) return;
                let $m = $wrap.siblings('.qty-msg');
                if (!$m.length) return;
                $m.stop(true, true).text(txt).removeClass('hidden').delay(2000).fadeOut(200);
            }

            window.refreshCartToast = function () {
                const url = '{{ route('cart.offcanvas') }}';
                return $.get(url)
                    .done(function (res) {
                        const $html = $('<div>').html(res.html);

                        $('#cart-drawer .cart-items').replaceWith($html.find('.cart-items'));
                        $('#cart-drawer .cart-summary').replaceWith($html.find('.cart-summary'));

                        const $newFooter = $html.find('.cart-footer');
                        const $curFooter = $('#cart-drawer .cart-footer');

                        if ($newFooter.length) {
                            if ($curFooter.length) {
                                $curFooter.replaceWith($newFooter);
                            } else {
                                $('#cart-drawer').append($newFooter);
                            }
                        } else {
                            $curFooter.remove();
                        }

                        $('.cart-count-span').text(res.count);
                    })
                    .fail(function () {
                        console.warn('refreshCartToast: request failed');
                    });
            };

            window.openCartOffcanvas = function () {
                try {
                    const p = window.refreshCartToast();
                    if (p && typeof p.always === 'function') {
                        p.always(function () {
                            window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: 'cart-drawer' } }));
                        });
                    } else {
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: 'cart-drawer' } }));
                    }
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: 'cart-drawer' } }));
                }
            };

            $(document).on('click', '.go-cart-btn', function (e) {
                e.preventDefault();
                window.openCartOffcanvas();
            });

            window.updateQuantity = window.updateQuantity || function (key, el) {
                $.post('{{ route('cart.updateQuantity') }}', {
                    _token: AIZ.data.csrf,
                    id: key,
                    quantity: el.value
                })
                    .done(function (data) {
                        if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data.cart_count);
                        if ($('#cart-details').length) $('#cart-details').html(data.cart_view);
                        window.refreshCartToast && window.refreshCartToast();
                    });
            };

            window.removeFromCartView = window.removeFromCartView || function (e, key) {
                e && e.preventDefault();
                $.post('{{ route('cart.removeFromCart') }}', {
                    _token: AIZ.data.csrf,
                    id: key
                })
                    .done(function (data) {
                        if (typeof updateNavCart === 'function') updateNavCart(data.nav_cart_view, data.cart_count);
                        if ($('#cart-details').length) $('#cart-details').html(data.cart_view);
                        window.refreshCartToast && window.refreshCartToast();
                        window.notify('success', "{{ translate('Item_has_been_removed_from_cart') }}");
                    });
            };

            $cart.on('click', '.qty-plus', function () {
                const $wrap = $(this).closest('.qty-control');
                const $input = $wrap.find('.qty-input');
                const id = $wrap.data('id');

                let v = parseInt($input.val(), 10);
                if (isNaN(v)) v = 0;
                v += 1;
                $input.val(v);
                window.updateQuantity(id, $input[0]);
            });

            $cart.on('click', '.qty-minus', function () {
                const $wrap = $(this).closest('.qty-control');
                const $input = $wrap.find('.qty-input');
                const id = $wrap.data('id');

                let v = parseInt($input.val(), 10);
                if (isNaN(v) || v <= 1) {
                    const msg = LOCALE === 'sa' ? 'أقل كمية هي 1' : LOCALE === 'cn' ? '最小数量为 1' : 'Minimum quantity is 1';
                    showMsg($wrap, msg);
                    v = 1;
                } else {
                    v -= 1;
                }
                $input.val(v);
                window.updateQuantity(id, $input[0]);
            });

            $cart.on('change', '.qty-input', function () {
                const $wrap = $(this).closest('.qty-control');
                const id = $wrap.data('id');
                let v = parseInt(this.value, 10);

                if (isNaN(v) || v < 1) {
                    v = 1;
                    const msg = LOCALE === 'sa' ? 'أقل كمية هي 1' : LOCALE === 'cn' ? '最小数量为 1' : 'Minimum quantity is 1';
                    showMsg($wrap, msg);
                }
                this.value = v;
                window.updateQuantity(id, this);
            });
        })(window.jQuery);
    })();
</script>
