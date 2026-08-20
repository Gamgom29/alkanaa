@extends('frontend.layouts.app')

@section('style')
    <style>
        .servicess {
            margin: 5% 0px;
        }

        .servicess .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .servicess h2 {
            color: #333;
            text-align: center;
            font-size: 24px;
        }

        .how-to-order {

            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .how-to-order h4 {
            font-weight: bold;
            color: #1d2d50;
        }

        .steps-wrapper .step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
        }

        .steps-wrapper .circle {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 32px;
            height: 32px;
            background-color: #1d2d50;
            color: white;
            border-radius: 50%;
            font-weight: bold;
            margin: 0px 5px;
            flex-shrink: 0;
        }

        .why-installation {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .why-installation h4 {
            font-weight: bold;
            color: #1d2d50;
        }

        .benefits-list li {
            display: flex;
            align-items: start;
            margin-bottom: 12px;
            font-size: 16px;
            color: #333;
        }

        .check-icon {
            margin: 0px 5px;
            font-size: 18px;
            color: green;
            flex-shrink: 0;
        }
    </style>
    <style>
        .steps-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .step-box {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            flex: 1 1 calc(20% - 20px);
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .step-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            background-color: #ae2025;
            color: #fff;
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 20px;
            font-weight: bold;
        }

        .step-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #222;
        }

        .step-description {
            font-size: 14px;
            color: #666;
        }

        @media screen and (max-width:1000px) {
            .steps-container {
                display: block;
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
                max-width: 100%;
                margin: auto;
            }

            .step-title,
            .step-description {
                overflow-y: hidden !important;
            }

        }
    </style>
@endsection

@section('content')
    @if (app()->getLocale() == 'sa')
        <section class="servicess">
            <div class="container">
                <h2>عروض الأسعار </h2>
                <p style="text-align: center; color: #555;">نوفر لك إمكانية طلب عرض سعر مخصص للمنتجات التي تختارها بسهولة
                    وسرعة.
                </p>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="steps-container">

                            <div class="step-box">
                                <div class="step-number">1</div>
                                <div class="step-title">تصفح المنتجات</div>
                                <div class="step-description">تجوّل بين أقسام الموقع واختر المنتجات التي تلبّي احتياجاتك
                                    وتثير
                                    اهتمامك.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">2</div>
                                <div class="step-title">أضف إلى السلة</div>
                                <div class="step-description">اضغط على زر "أضف إلى السلة" لكل منتج ترغب في الاستعلام عن سعره
                                    أو
                                    طلبه لاحقًا.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">3</div>
                                <div class="step-title">انتقل إلى السلة</div>
                                <div class="step-description">بعد الانتهاء من اختيار المنتجات، انتقل إلى صفحة السلة لمراجعة
                                    الطلب بالكامل.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">4</div>
                                <div class="step-title">اختر "طلب عرض سعر"</div>
                                <div class="step-description">
                                    في صفحة السلة .. قم بالضغط على طلب عرض السعر.
                                </div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">5</div>
                                <div class="step-title">أرسل الطلب</div>
                                <div class="step-description">بمجرد ارسال الطلب ، سيصل اليك عرض السعر عبر البريد الالكتروني
                                    المسجل للحساب</div>
                            </div>

                        </div>


                    </div>

                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a type="button" href="{{ route('search') }}"
                        class="text-decoration-none text-white w-25 text-center rounded-1"
                        style="background-color: #242e40; padding: 10px 15px;"> العودة لصفحة المنتجات</a>
                </div>
                <div class="why-installation my-5">
                    <h4 class="mb-4 text-center">ملاحظات مهمة</h4>
                    <ul class="benefits-list list-unstyled d-flex flex-wrap justify-content-center gap-4">
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            لا يترتب عليك أي التزام عند طلب عرض السعر.
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            يمكنك التواصل معنا في أي وقت لمزيد من الاستفسارات.
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            تأكد من إدخال بريد إلكتروني صحيح ليصل اليك عرض السعر
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            يرجى التأكد من إدخال اسم الشركة، السجل التجاري، والرقم الضريبي بشكل صحيح
                        </li>
                    </ul>

                    <div class="mt-5 text-center">
                        <h5 class="fw-bold mb-2">هل لديك أي أسئلة؟</h5>
                        <p>
                            لا تتردد في التواصل معنا عبر صفحة
                            <a href="{{ route('contact.us') }}">اتصل بنا</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>
    @elseif(App::getLocale() == 'en')
        <section class="servicess">
            <div class="container">
                <h2>Price Quotations</h2>
                <p style="text-align: center; color: #555;">We provide you with the ability to request a customized price
                    quotation for the products you choose easily and quickly.</p>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="steps-container">

                            <div class="step-box">
                                <div class="step-number">1</div>
                                <div class="step-title">Browse Products</div>
                                <div class="step-description">Explore the site sections and choose the products that meet
                                    your needs and spark your interest.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">2</div>
                                <div class="step-title">Add to Cart</div>
                                <div class="step-description">Click the "Add to Cart" button for each product you want to
                                    inquire about or order later.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">3</div>
                                <div class="step-title">Go to Cart</div>
                                <div class="step-description">Once you've selected your products, go to the cart page to
                                    review your full order.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">4</div>
                                <div class="step-title">Select "Request a Quote"</div>
                                <div class="step-description">On the cart page, click on Request a Quote.</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">5</div>
                                <div class="step-title">Submit Your Request</div>
                                <div class="step-description">Once the request is submitted, the quote will be sent to the
                                    email address registered to your account.</div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-center mt-4">
                    <a type="button" href="{{ route('search') }}"
                        class="text-decoration-none text-white w-25 text-center rounded-1"
                        style="background-color: #242e40; padding: 10px 15px;">Back to Products Page</a>
                </div>
                <div class="why-installation my-5">
                    <h4 class="mb-4 text-center">Important Notes</h4>
                    <ul class="benefits-list list-unstyled d-flex flex-wrap justify-content-center gap-4">
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            There is no obligation when requesting a quotation.
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            You can contact us anytime for further inquiries.
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            Make sure to enter a valid email address to receive the quotation.
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            Please make sure to enter the company name, commercial registration, and tax number correctly.

                        </li>
                    </ul>

                    <div class="mt-5 text-center">
                        <h5 class="fw-bold mb-2">Do you have any questions?</h5>
                        <p>
                            Feel free to contact us via our
                            <a href="{{ route('contact.us') }}">Contact Us</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>
    @elseif(App::getLocale() == 'cn')
        <section class="servicess">
            <div class="container">
                <h2>价格报价</h2>
                <p style="text-align: center; color: #555;">我们为您提供方便快捷的方式，为您选择的产品请求定制报价。</p>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="steps-container">

                            <div class="step-box">
                                <div class="step-number">1</div>
                                <div class="step-title">浏览产品</div>
                                <div class="step-description">浏览网站各个分类，选择满足您需求并引起您兴趣的产品。</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">2</div>
                                <div class="step-title">加入购物车</div>
                                <div class="step-description">点击每个您想了解价格或稍后购买的商品旁边的“加入购物车”按钮。</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">3</div>
                                <div class="step-title">前往购物车</div>
                                <div class="step-description">选择好产品后，前往购物车页面查看完整订单。</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">4</div>
                                <div class="step-title">选择“请求报价”</div>
                                <div class="step-description">在购物车页面，点击 请求报价。</div>
                            </div>

                            <div class="step-box">
                                <div class="step-number">5</div>
                                <div class="step-title">提交请求</div>
                                <div class="step-description">提交请求后，报价将发送至您账户注册的电子邮箱。</div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a type="button" href="{{ route('search') }}"
                        class="text-decoration-none text-white w-25 text-center rounded-1"
                        style="background-color: #242e40; padding: 10px 15px;">返回产品页面</a>
                </div>
                <div class="why-installation my-5">
                    <h4 class="mb-4 text-center">重要注意事项</h4>
                    <ul class="benefits-list list-unstyled d-flex flex-wrap justify-content-center gap-4">
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            请求报价无需承担任何义务。
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            您可以随时联系我们进行进一步咨询。
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            请确保输入有效的电子邮箱地址，以便及时接收详情。
                        </li>
                        <li class="px-3">
                            <span class="check-icon">✅</span>
                            请确保正确填写公司名称、商业注册号和税号。

                        </li>
                    </ul>

                    <div class="mt-5 text-center">
                        <h5 class="fw-bold mb-2">有任何问题吗？</h5>
                        <p>
                            欢迎通过我们的
                            <a href="{{ route('contact.us') }}">联系我们</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>
    @endif


    
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

