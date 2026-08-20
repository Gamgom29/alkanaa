@extends('frontend.layouts.app')

@section('style')
    <style>
        .section-title {
            font-size: 28px;
            font-weight: bold;
            color: #1d2d50;
            margin-bottom: 15px;
        }

        .section-text {
            font-size: 20px;
            color: #333;
            line-height: 1.8;
        }

        @media screen and (max-width:1000px) {
            .about-section {
                padding: 20px
            }

            .box {
                flex-direction: column-reverse
            }
        }
    </style>

  

@endsection

@section('content')
    {{-- @php
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
    @endphp --}}
    @if (app()->getLocale() == 'sa')
        <section class="about-section mt-5">
            <div class="container">
                <h2 class="text-center mb-5">من نحن</h2>
                <div class="row justify-content-center mb-5">
                    <!-- عن القناعة -->
                    <div>
                        <h3 class="section-title">عن القناعة</h3>
                        <p class="section-text">
                            بدأت مسيرة القناعة في عام ٢٠٠٢ كإحدى حلقات سلسلة المصانع التي بدأت في عام ١٩٦٨ وكأول مصنع سعودي
                            في مجال صناعة المعدات وحفظ الأطعمة؛ وذلك عندما استشعر الشيخ غالب نصر أهمية تطوير صناعة المعدات
                            الخاصة بصناعة وحفظ الأطعمة في المملكة العربية السعودية لتلبية احتياجات السوق المحلي المتزايد من
                            هذه المنتجات.
                        </p>
                        <p class="section-text">
                            وبأفكاره الناجحة وتوجيهاته تم إنشاء وتطوير عدة مشاريع صناعية عالية الكفاءة لتحقيق هدف البناء
                            والدعم لاقتصاد المملكة العربية السعودية فبدأنا بإنتاج الشوايات والبرادات وسرعان ما تم توسيع
                            الإنتاج ليشمل مصانع معدات المطابخ والأفران المتطورة.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">مسيرتنا</h3>
                        <p class="section-text">
                            بدأت مسيرة القناعة في سنة ٢٠٠٢ كأحدى حلقات سلسلة المصانع التي بدأت في عام ١٩٦٨ كأول مصنع سعودي
                            في مجال صناعة وحفظ الأطعمة في المملكة العربية السعودية لتلبية احتياجات السوق المحلي المتزايد من
                            هذه المنتجات.
                        </p>
                        <p class="section-text">
                            وبأفكاره الناجحة وتوجيهاته تم إنشاء وتطوير عدة مشاريع صناعية عالية الكفاءة لتحقيق هدفه البناء
                            والداعم لاقتصاد المملكة العربية السعودية، فبدأنا بإنتاج الشوايات والبرادات وسرعان ما تم توسيع
                            الإنتاج ليشمل مصانع معدات المطابخ والأفران.
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about6.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5 box">
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about4.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">رحلتنا</h3>
                        <p class="section-text">
                            دخلت الشّركة في بداية الألفية الثانية مرحلة جديدة لإعادة تنظيم وتخطيط نشاطها، حيث كان هدفها
                            توفير أفضل المنتجات بأسعار منافسة ليتمكن صناع الأغذية من استخدام منتجات عالية الجودة وبأسعار
                            مدروسة.
                            <br>
                            وبذلك حققت القناعة هدفها ببناء وتشغيل مصنعها الجديد والاستحواذ على النسبة الأكبر من السوق المحلي
                            وبعض الأسواق الخارجية.
                        </p>
                        <p class="section-text">
                            وتزامنًا مع ذلك قمنا بإنشاء خط إنتاج كبير في مدينة جدة ويُعد الأول من نوعه في الشرق الأوسط وقارة
                            أفريقيا. <br>
                            وفي أواخر عام ٢٠١٠ تم الاستحواذ على مصنع ثلاجات العرض وتطويره.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">استراتيجيتنا</h3>
                        <p class="section-text">
                            تركز استراتيجيتنا الحالية على الابتكار والتطوير والتوسّع الإقليمي، وبالنسبة لمعدات المطابخ
                            ونظرًا لما شهده سوق المملكة العربية السعودية من نمو كبير فقد تم إضافة خط إنتاج في عام ٢٠١٠ ورفع
                            الطاقة الإنتاجية والقوى العاملة وتطوير الجودة لنواكب مجريات السوق المحلي والخارجي وإطلاق علامتنا
                            التجارية.
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about8.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div>
                        <h3 class="section-title">التزامنا بتقديم الأفضل</h3>
                        <p class="section-text">
                            دخلت القناعة في بداية مرحلة جديدة لإعادة تنظيم وتخطيط أنشطتها وهدفها هو تقديم أفضل المنتجات
                            بأسعار منافسة ليتمكن صناع الأغذية من استخدام منتجات عالية الجودة وبأسعار معقولة. وتحقيق النجاح
                            في تحقيق هدفها وعملها وتشغيلها في صناعة معدات صناعة حفظ الأطعمة ليحل محل المنتجات المستوردة رغم
                            محاولات لمنافستها إلا أننا سننجح في تحقيق النجاح في النسبة الأكبر من السوق المحلي وبعض الأسواق
                            الخارجية. وتزامن ذلك مع إنشاء خط إنتاج كبير في مدينة نيويورك. أول من سيُقام في الشرق الأوسط
                            وقارة أفريقيا. وفي أواخر العام، تم الاستحواذ على مصنع ثلاجات العرض وتطويره، وشهد هذا العام إنشاء
                            مصنع شركة قناعة لصناعة الأرفف.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @elseif(App::getLocale() == 'en')
        <section class="about-section mt-5">
            <div class="container">
                <h2 class="text-center mb-5">About Us</h2>
                <div class="row justify-content-center mb-5">
                    <div>
                        <h3 class="section-title">About Al-Qanaa</h3>
                        <p class="section-text">
                            Al-Qanaa journey started in 2002 as one of the links in a chain of factories that began in 1968,
                            becoming the first Saudi factory specializing in manufacturing food equipment and preservation
                            products. Sheikh Ghaleb Nasr recognized the importance of developing the food equipment industry
                            in Saudi Arabia to meet the growing local market demand.
                        </p>
                        <p class="section-text">
                            With his successful ideas and guidance, several high-efficiency industrial projects were
                            established and developed to support Saudi Arabia's economy. We started producing grills and
                            refrigerators, and soon expanded production to include advanced kitchen equipment and oven
                            factories.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">Our Journey</h3>
                        <p class="section-text">
                            Al-Qanaa journey began in 2002 as one of the links in the chain of factories that started in
                            1968, as the first Saudi factory specialized in manufacturing and preserving food products to
                            meet the increasing demand of the local market.
                        </p>
                        <p class="section-text">
                            With successful visions and guidance, several high-efficiency industrial projects were
                            established to build and support Saudi Arabia's economy. We began producing grills and
                            refrigerators, and quickly expanded production to include kitchen equipment and ovens.
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about6.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5 box">
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about4.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">Our Path</h3>
                        <p class="section-text">
                            In the early 2000s, the company entered a new phase to reorganize and plan its operations. Its
                            goal was to provide the best products at competitive prices, enabling food industry
                            professionals to access high-quality products at reasonable costs. <br>
                            Thus, Al-Qanaa achieved its goal by building and operating its new factory and capturing the
                            largest share of the local market and some foreign markets.
                        </p>
                        <p class="section-text">
                            At the same time, we established a large production line in Jeddah, which was the first of its
                            kind in the Middle East and Africa. <br>
                            By the end of 2010, Al-Qanaa acquired and developed a display refrigerator factory.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">Our Strategy</h3>
                        <p class="section-text">
                            Our current strategy focuses on innovation, development, and regional expansion. Regarding
                            kitchen equipment, and due to the significant growth in the Saudi market, we added a production
                            line in 2010, increased production capacity and workforce, and enhanced quality to keep pace
                            with local and international market developments and launched our brand.
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about8.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div>
                        <h3 class="section-title">Our Commitment to Excellence</h3>
                        <p class="section-text">
                            Al-Qanaa entered a new phase to reorganize and plan its activities, aiming to provide the best
                            products at competitive prices so food industry professionals can access high-quality products
                            at affordable prices. Al-Qanaa succeeded in achieving its goals, working in manufacturing food
                            preservation equipment to replace imported products. Despite attempts to compete with it, we
                            succeeded in capturing the largest share of the local market and some foreign markets. This
                            coincided with establishing a major production line in New York City, the first of its kind in
                            the Middle East and Africa. By the end of the year, Al-Qanaa acquired and developed a display
                            refrigerator factory, and this year witnessed the establishment of Al-Qanaa's shelf
                            manufacturing plant.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @elseif(App::getLocale() == 'cn')
        <section class="about-section mt-5">
            <div class="container">
                <h2 class="text-center mb-5">关于我们</h2>
                <div class="row justify-content-center mb-5">
                    <div>
                        <h3 class="section-title">关于 Al-Qanaa</h3>
                        <p class="section-text">
                            Al-Qanaa 的旅程始于 2002 年，作为自 1968 年开始的一系列工厂链中的一环，成为沙特阿拉伯首家专门生产食品设备和保存产品的工厂。Ghaleb Nasr
                            先生意识到，在沙特阿拉伯发展食品设备产业的重要性，以满足不断增长的本地市场需求。
                        </p>
                        <p class="section-text">
                            在他成功的构想和指导下，建立和开发了多个高效的工业项目，以支持沙特阿拉伯经济。我们开始生产烤炉和冷柜，并迅速扩展生产线，包括先进的厨房设备和烤箱制造。
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">我们的历程</h3>
                        <p class="section-text">
                            Al-Qanaa 的旅程始于 2002 年，作为自 1968 年开始的一系列工厂链中的一环，成为沙特阿拉伯首家专门生产和保存食品设备的工厂，以满足不断增长的本地市场需求。
                        </p>
                        <p class="section-text">
                            在成功的愿景和指导下，建立了多个高效的工业项目，旨在建设并支持沙特阿拉伯经济。我们开始生产烤炉和冷柜，并迅速扩大生产线，包括厨房设备和烤箱制造。
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about6.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5 box">
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about4.jpeg') }}" style="width: 100%;">
                    </div>
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">我们的旅程</h3>
                        <p class="section-text">
                            在 21 世纪初，公司进入了重新组织和规划其业务的新阶段。其目标是以具有竞争力的价格提供最佳产品，使食品行业的从业者能够以合理的价格使用高质量的产品。<br>
                            因此，Al-Qanaa 实现了建设和运营新工厂的目标，并占据了本地市场以及部分海外市场的最大份额。
                        </p>
                        <p class="section-text">
                            同时，我们在吉达建立了一条大型生产线，这是中东和非洲地区首创。<br>
                            到 2010 年底，Al-Qanaa 收购并开发了展示冷柜工厂。
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-6 my-auto">
                        <h3 class="section-title">我们的战略</h3>
                        <p class="section-text">
                            我们当前的战略专注于创新、开发和区域扩张。针对厨房设备，由于沙特市场的快速增长，我们在 2010
                            年增加了一条生产线，提高了生产能力和劳动力，并改进了质量，以跟上本地和国际市场的发展，并推出了我们的品牌。
                        </p>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <img src="{{ static_asset('assets/front_img/about8.jpeg') }}" style="width: 100%;">
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div>
                        <h3 class="section-title">我们对卓越的承诺</h3>
                        <p class="section-text">
                            Al-Qanaa 进入了重新组织和规划活动的新阶段，旨在以具有竞争力的价格提供最好的产品，使食品行业的从业者能够以合理的价格使用高质量的产品。Al-Qanaa
                            成功实现了目标，在制造食品保存设备方面取得了成功，取代了进口产品。尽管存在竞争，但我们成功占据了本地市场以及部分海外市场的最大份额。这与在纽约市建立的大型生产线同时发生，这是中东和非洲地区首创。到年底，Al-Qanaa
                            收购并开发了展示冷柜工厂，今年见证了 Al-Qanaa 架子制造厂的成立。
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

