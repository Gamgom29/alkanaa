@php $rtl = in_array(app()->getLocale(), ['sa','ar','fa','ur','he']); @endphp
<div class="mini-cart-toast {{ $rtl ? 'rtl' : 'ltr' }}" aria-live="polite" aria-hidden="false">
    <div class="mct-head">
        <span>✓ @if (app()->getLocale() == 'sa')
                تم الاضافه الي السله
            @elseif(app()->getLocale() == 'cn')
                已添加到购物车
            @else
                Added to Cart
            @endif
        </span>
        <button class="mct-close" type="button" aria-label="{{ translate('close') }}">×</button>
    </div>

    <div class="mct-body">
        <img class="mct-thumb" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->name }}">
        <div>
            <p class="mct-title">{{ $product->name }}</p>
            <div class="mct-meta">
                <span class="mct-price">{{ $product->unit_price }}</span>
                <span> · </span>
                <span class="mct-qty">{{ translate('quantity') }}: {{ $cart->quantity }}</span>
            </div>


            <button class="mct-btn go-cart-btn p-1 mt-2" type="button">
                @if (app()->getLocale() == 'sa')
                    اذهب إلى السلة
                @elseif(app()->getLocale() == 'cn')
                    去购物车
                @else
                    View Cart
                @endif
            </button>

            {{-- <a href="{{ route('cart') }}" class="mct-cart-link">@if (app()->getLocale() == 'sa') اذهب الي السله @elseif(app()->getLocale() == 'cn') 去购物车 @else View Cart @endif</a> --}}
        </div>
    </div>

    <div class="mct-actions">
        @auth
            <a href="{{ route('checkout') }}" class="mct-btn primary">
                @if (app()->getLocale() == 'sa')
                    إتمام الشراء
                @elseif(app()->getLocale() == 'cn')
                    去购物车
                @else
                    Proceed to Checkout
                @endif
            </a>
        @endauth
        @guest
            <a href="{{ route('user.login') }}" class="mct-btn">
                @if (app()->getLocale() == 'sa')
                    تسجيل الدخول
                @elseif(app()->getLocale() == 'cn')
                    登录
                @else
                    Login
                @endif
            </a>
        @endguest
    </div>
</div>
