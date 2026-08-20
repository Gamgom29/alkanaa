@extends('frontend.layouts.app')
@section('style')
    <style>
        .login-box {
            background-color: #ffffff;
            border: 1px solid #e3e3e3;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            padding: 30px;
            height: 100%;
            text-align: center;
        }

        .vertical-divider {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vertical-divider::before {
            content: '';
            width: 1px;
            height: 100%;
            background-color: #e0e0e0;
            position: absolute;
        }

        .vertical-divider span {
            background: white;
            padding: 5px 10px;
            color: #777;
            z-index: 1;
            font-weight: 600;
        }

        .login-icon {
            font-size: 48px;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .login-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            text-align: start;
        }
    </style>
@endsection
@section('content')
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white mt-5 mb-5">
        <section class="bg-white overflow-hidden">
            <div class="container">
                <div class="row justify-content-center text-center mb-4">
                    <div class="col-md-8">
                        <h1 class="fs-30 fw-700 text-primary text-uppercase">{{ translate('Welcome Back !') }}</h1>
                        <p class="fs-20 fw-400 text-dark">{{ translate('Login to your account') }}</p>
                    </div>
                </div>

                <div class="row justify-content-center align-items-stretch gx-5">
                    <!-- Customer Login -->
                    <div class="col-xl-5 col-lg-6 mb-4 mb-xl-0">
                        <div class="login-box h-100">
                            <i class="fas fa-user-circle login-icon" style="color: #ae2025;"></i>
                            <div class="login-title">{{ translate('login as a user') }}</div>

                            <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                    <input type="email" class="form-control rounded-0" name="email"
                                        placeholder="{{ translate('johndoe@example.com') }}">
                                </div>

                                <div class="form-group">
                                    <label class="fs-12 fw-700 text-soft-dark">{{ translate('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control rounded-0" name="password"
                                            placeholder="{{ translate('Password') }}">
                                        <i class="password-toggle las la-2x la-eye"></i>
                                    </div>
                                </div>

                                <div class="row mb-1 text-start">
                                    <div class="col-6">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" name="remember">
                                            <span class="fs-12 text-gray-dark">{{ translate('Remember Me') }}</span>
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-2 text-end">
                                    <a href="{{ route('password.request') }}"
                                        class="fs-12 text-gray-dark"><u>{{ translate('Forgot password?') }}</u></a>
                                </div>

                                <div class="mb-4 mt-3">
                                    <button type="submit"
                                        class="btn text-white w-100 rounded-0 fw-700 fs-14" style="background-color: #ae2025">{{ translate('Login') }}</button>
                                </div>

                                <p class="fs-12 text-gray mb-0">
                                    {{ translate("Don't have an account?") }}
                                    <a href="{{ route('user.registration') }}"
                                        class="fs-14 fw-700 animate-underline-primary">
                                        {{ translate('Register Account Now') }}
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!-- Vertical Divider -->
                    <div class="col-xl-1 d-none d-xl-flex vertical-divider">
                        <span>{{ translate('Or') }}</span>
                    </div>

                    <!-- Seller Login -->
                    <div class="col-xl-5 col-lg-6">
                        <div class="login-box h-100">
                            <i class="fas fa-store login-icon" style="color: #ae2025;"></i>
                            <div class="login-title">{{ translate('login as a seller') }}</div>

                            <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                    <input type="email" class="form-control rounded-0" name="email"
                                        placeholder="{{ translate('johndoe@example.com') }}">
                                </div>

                                <div class="form-group">
                                    <label class="fs-12 fw-700 text-soft-dark">{{ translate('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control rounded-0" name="password"
                                            placeholder="{{ translate('Password') }}">
                                        <i class="password-toggle las la-2x la-eye"></i>
                                    </div>
                                </div>

                                <div class="row mb-1 text-start">
                                    <div class="col-6">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" name="remember">
                                            <span class="fs-12 text-gray-dark">{{ translate('Remember Me') }}</span>
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-2 text-end">
                                    <a href="{{ route('password.request') }}"
                                        class="fs-12 text-gray-dark"><u>{{ translate('Forgot password?') }}</u></a>
                                </div>

                                <div class="mb-4 mt-3">
                                    <button type="submit"
                                        class="btn text-white w-100 rounded-0 fw-700 fs-14" style="background-color: #ae2025">{{ translate('Login') }}</button>
                                </div>

                                <p class="fs-12 text-gray mb-0">
                                    {{ translate("Don't have a Seller account") }}
                                    <a href="{{ route('shop-reg.verification') }}"
                                        class="fs-14 fw-700 animate-underline-primary">
                                        {{ translate('Register Now Seller') }}
                                    </a>
                                </p>
                            </form>
                        </div>
                        
                    </div>
                </div>


                <div class="text-center mt-4">
                    <a href="{{ url()->previous() }}" class="fs-14 fw-700 text-primary d-inline-flex align-items-center">
                        <i class="las la-arrow-left fs-20 me-1"></i> {{ translate('Back to Previous Page') }}
                    </a>
                </div>
            </div>
        </section>
    </div>

      <style>
        .mini-cart-toast {
            position: fixed;
            top: 80px;
            z-index: 9999;
            width: min(420px, 92vw);
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            padding: 14px;
            opacity: 0;
            transform: translateX(120%);
            transition: transform .35s ease, opacity .35s ease;
        }

        .mini-cart-toast.rtl {
            right: 16px;
        }

        .mini-cart-toast.ltr {
            left: 16px;
            transform: translateX(-120%);
        }

        .mini-cart-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .mct-head {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #16a34a;
        }

        .mct-close {
            margin-inline-start: auto;
            border: 0;
            background: transparent;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .mct-body {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .mct-thumb {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #eee;
        }

        .mct-title {
            font-weight: 600;
            margin: 0 0 4px;
            font-size: 15px;
        }

        .mct-meta {
            font-size: 13px;
            color: #6b7280;
        }

        .mct-cart-link {
            display: inline-block;
            margin-top: 8px;
            font-size: 13px;
            text-decoration: underline;
        }

        .mct-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .mct-btn {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            cursor: pointer;
            font-weight: 600;
            text-align: center;
        }

        .mct-btn.primary {
            background: #111827;
            color: #fff;
            border-color: #111827;
        }
    </style>
    
    {{-- Host (not required anymore but harmless) --}}
    <div id="miniCartHost"></div>



    @include('frontend.partials.cart.cart_summary_toast')
@endsection

@section('script')
    <script type="text/javascript">
        function filter() {
            $('#search-form').submit();
        }

        function rangefilter(arg) {
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
        // ===== Format price (kept from your code) =====
        function formatPrice(n, cur) {
            try {
                return new Intl.NumberFormat(document.documentElement.lang || 'sa').format(n) + (cur ? (' ' + cur) : '');
            } catch (e) {
                return n + (cur ? (' ' + cur) : '');
            }
        }

        // ===== Show toast near the cart icon with proper arrow and scroll =====
        function mountMiniCartToastNearCart(html) {
            // Remove any existing toast (from anywhere)
            $('.mini-cart-toast').remove();

            // Append, measure, and hide initially
            const $toast = $(html).appendTo('body').css({
                position: 'absolute',
                top: 0,
                left: 0,
                visibility: 'hidden'
            });

            const cartEl = document.getElementById('nav-cart-area');
            if (!cartEl) {
                // Fallback: fixed position if cart icon missing for any reason
                $toast.css({
                    position: 'fixed',
                    visibility: 'visible',
                    top: 80,
                    right: 16
                }).addClass('show');
                return;
            }

            const rect = cartEl.getBoundingClientRect();
            const scrollY = window.scrollY || window.pageYOffset;
            const scrollX = window.scrollX || window.pageXOffset;

            const w = $toast.outerWidth();
            const isRTL = $toast.hasClass('rtl');

            const gap = 10; // distance below the icon
            let top = rect.bottom + scrollY + gap;

            // Align horizontally depending on direction
            let left;
            if (isRTL) {
                // RTL: align left edges
                left = rect.left + scrollX;
            } else {
                // LTR: align right edges
                left = rect.right + scrollX - w;
            }

            // Clamp within viewport
            const minLeft = 8 + scrollX;
            const maxLeft = scrollX + document.documentElement.clientWidth - w - 8;
            left = Math.max(minLeft, Math.min(left, maxLeft));

            // Place and animate
            $toast.css({
                top: top,
                left: left,
                visibility: 'visible',
                opacity: 0,
                transform: 'translateY(-6px)'
            });
            requestAnimationFrame(() => $toast.addClass('show').css({
                opacity: 1,
                transform: 'translateY(0)'
            }));

            // Compute arrow offset so it points to icon center
            const iconCenterX = rect.left + rect.width / 2 + scrollX;
            const toastLeft = left;
            const toastRight = left + w;
            let arrowOffset = isRTL ? (iconCenterX - toastLeft) : (toastRight - iconCenterX);
            const pad = 18;
            arrowOffset = Math.max(pad, Math.min(arrowOffset, w - pad));
            $toast[0].style.setProperty('--arrow-offset', arrowOffset + 'px');

            // Auto close after 6s
            clearTimeout(window.__mctTimer);
            window.__mctTimer = setTimeout(() => {
                $toast.find('.mct-close').trigger('click');
            }, 2500);

            // Smooth scroll to the toast area
            const targetY = Math.max(0, top - 120);
            window.scrollTo({
                top: targetY,
                behavior: 'smooth'
            });
        }

        // Close & remove toast
        $(document).on('click', '.mct-close', function() {
            $(this).closest('.mini-cart-toast').remove();
        });

        // ===== Add-to-Cart with loading state =====
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const id = $btn.data('id');

            const originalHtml = $btn.html();
            $btn.addClass('is-loading').prop('disabled', true)
                .html('<span class="btn-spinner" aria-hidden="true"></span>');

            $.post('{{ route('cart.addToCart') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: 1
            }).done(function(res) {
                if (typeof res.cart_count !== 'undefined') {
                    $('.cart-count-span').text(res.cart_count);
                }
                if (res.modal_view) {
                    mountMiniCartToastNearCart(res.modal_view);
                } else if (res.status != 1) {
                    alert(res.message || 'تعذر الإضافة');
                }
            }).fail(function() {
                alert('تعذر الاتصال بالسيرفر');
            }).always(function() {
                $btn.removeClass('is-loading').prop('disabled', false).html(originalHtml);
            });
        });

        // ===== Sliders (as in your original) =====
        const slider = document.getElementById('slider');
        const nextBtn = document.querySelector('.next-btn');
        const prevBtn = document.querySelector('.prev-btn');
        if (nextBtn && prevBtn && slider) {
            nextBtn.addEventListener('click', () => slider.scrollBy({
                left: -180,
                behavior: 'smooth'
            }));
            prevBtn.addEventListener('click', () => slider.scrollBy({
                left: 180,
                behavior: 'smooth'
            }));
        }

        const sliderarrivals = document.getElementById('slider-arrivals');
        const nextBtnarrivals = document.querySelector('.next-btn-arrivals');
        const prevBtnarrivals = document.querySelector('.prev-btn-arrivals');
        if (nextBtnarrivals && prevBtnarrivals && sliderarrivals) {
            nextBtnarrivals.addEventListener('click', () => sliderarrivals.scrollBy({
                left: -180,
                behavior: 'smooth'
            }));
            prevBtnarrivals.addEventListener('click', () => sliderarrivals.scrollBy({
                left: 180,
                behavior: 'smooth'
            }));
        }

        // فتح الـ Offcanvas عند الضغط على زر "اذهب إلى السلة" داخل التوست
        $(document).on('click', '.go-cart-btn', function(e) {
            e.preventDefault();
            const el = document.getElementById('cartOffcanvas');
            if (!el) {
                window.location.href = "{{ route('cart') }}";
                return;
            }

            // هات أحدث محتوى للأصناف + الملخص بس
            refreshCartToast();
            const off = bootstrap.Offcanvas.getOrCreateInstance(el);
            off.show();
        });


        document.addEventListener("click", function(e) {
            if (e.target && e.target.id === "openFormBtn") {
                const bottomSheet = document.getElementById("bottomSheet");
                if (bottomSheet) bottomSheet.style.display = "flex";
            }

            if (e.target && e.target.id === "closeFormBtn") {
                const bottomSheet = document.getElementById("bottomSheet");
                if (bottomSheet) bottomSheet.style.display = "none";
            }

            if (e.target && e.target.id === "bottomSheet") {
                e.target.style.display = "none";
            }
        });
    </script>
@endsection

