@extends('frontend.layouts.app')

@section('style')
    <style>
        .branches-section {
            background-color: #f9f9f9;
            direction: rtl;
        }

        .branch-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .branch-box h5 {
            color: #1d2d50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .branch-box p {
            color: #333;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .branch-box p,
        .branch-box h5 {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .branch-box i {
            min-width: 20px;
            text-align: center;
        }


        .contact-us h2 {
            font-size: 30px;
            font-weight: bolder;
            line-height: 1.1em;
            color: #11232A;
            margin-bottom: 25px;
            font-style: normal;
        }

        .contact-us p {
            color: #7A7A7A;
            font-size: 18px;
            font-weight: 600;
        }


        .contact h3 {
            font-weight: bolder;
            font-size: 35px;
            margin-bottom: 30px;
        }

        .contact p {
            width: 80%;
        }

        .submit-mail {
            background-color: #ae2025;
            color: #FFFFFF;
            border-radius: 2px;
            margin-top: 20px;
            padding: 10px;
        }

        .submit-mail:hover {
            background-color: rgb(152, 37, 50);
            color: #FFFFFF;
            border: 2px solid #FFFFFF;
        }
    </style>
@endsection

@section('content')
    @php
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
    @endphp
    @if (app()->getLocale() == 'sa')
        <section class="mt-xl-5 mt-lg-5 mt-md-5 contact-us">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-xl-6 my-auto mx-auto">
                        <h2 style="line-height: 55px!important;">
                            ابق على تواصل معنا
                        </h2>
                        <p class="mt-4">
                            القناعة مصنع سعودي رائد في مجال صناعة معدات المطابخ وحفظ الأطعمة، بخبرة تمتد لأكثر من 20 عامًا
                            في
                            تلبية احتياجات قطاع الضيافة والمطاعم.
                        </p>

                    </div>
                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 branches-section py-5">
            <div class="container">
                <h2 class="text-center mb-5">فروعنا</h2>
                <div class="row gy-4">

                    <!-- جدة -->
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>معرض جدة</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>طريق المدينة قبل مسجد الملك سعود مقابل مركز سلمى
                            </p>
                            <p><i class="fas fa-envelope m-1"></i>ص-ب ٣٣٣٩٠ جدة ٢١٤٤٨</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966126324117</p>
                        </div>
                    </div>

                    <!-- الدمام -->
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>معرض الدمام</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>شارع الخزان - عمارة الحيمود</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0138342117</p>
                        </div>
                    </div>

                    <!-- المصنع -->
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-industry m-1"></i>المصنع</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>جدة - المدينة الصناعية الأولى - المرحلة الثالثة</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0509290374</p>
                        </div>
                    </div>

                    <!-- الرياض -->
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>معرض الرياض</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>٢٧٢٧ الوشم - حي المربع</p>
                            <p><i class="fas fa-map-marker-alt m-1"></i>المملكة العربية السعودية، الرياض</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966 11 404 2417</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 mb-xl-5 mb-lg-5 mb-md-5 contact" id="suggestions">
            <div class="container">
                <div class="row justify-content-center box">
                    <div class="col-xl-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d14858208.470501209!2d46.7075344!3d24.6067117!3m2!1i1024!2i768!4f13.1!2m1!1z2LTYsdmD2Ycg2KfZhNmC2YbYp9i52Ycg2KfZhNiz2LnZiNiv2YrZh-KArQ!5e0!3m2!1sen!2seg!4v1752509905863!5m2!1sen!2seg"
                            style="border:0; width: 100%; height: 550px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-xl-6 my-auto mx-auto">
                        <h3>
                            اترك رسالتك
                        </h3>
                        <p>
                            إذا كان لديكم أي اقتراحات أو شكاوى، يرجى التواصل معنا عبر الارقام التالية أو اترك رسالتك
                        </p>
                        <div>
                            <form id="contactFormSa">
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="الاسم*" name="name">
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="الجوال*" name="phone">
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="email" class="form-control" placeholder="الايميل*" name="email">
                                </div>
                                <div class="mb-3 form-input">
                                    <textarea class="form-control" placeholder="اترك رسالتك هنا ...." name="content"></textarea>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 text-center">
                                        <button type="submit" class="btn submit-mail w-100 rounded-0">
                                            ارسال
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif(App::getLocale() == 'en')
        <section class="mt-xl-5 mt-lg-5 mt-md-5 contact-us">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-xl-6 my-auto mx-auto">
                        <h2 style="line-height: 55px!important;">
                            Stay Connected With Us
                        </h2>
                        <p class="mt-4">
                            Al Qana'a is a leading Saudi factory in the field of kitchen equipment and food preservation,
                            with over 20 years of experience in meeting the needs of the hospitality and restaurant sector.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 branches-section py-5">
            <div class="container">
                <h2 class="text-center mb-5">Our Branches</h2>
                <div class="row gy-4">

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>Jeddah Showroom</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>Madina Road before King Saud Mosque, opposite Salma
                                Center</p>
                            <p><i class="fas fa-envelope m-1"></i>P.O. Box 33390, Jeddah 21448</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966126324117</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>Dammam Showroom</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>Al Khazan Street - Al Haimoud Building</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0138342117</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-industry m-1"></i>Factory</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>Jeddah - First Industrial City - Phase 3</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0509290374</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>Riyadh Showroom</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>2727 Al Wushm - Al Murabba District</p>
                            <p><i class="fas fa-map-marker-alt m-1"></i>Saudi Arabia, Riyadh</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966 11 404 2417</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 mb-xl-5 mb-lg-5 mb-md-5 contact" id="suggestions">
            <div class="container">
                <div class="row justify-content-center box">
                    <div class="col-xl-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d14858208.470501209!2d46.7075344!3d24.6067117!3m2!1i1024!2i768!4f13.1!2m1!1z2LTYsdmD2Ycg2KfZhNmC2YbYp9i52Ycg2KfZhNiz2LnZiNiv2YrZh-KArQ!5e0!3m2!1sen!2seg!4v1752509905863!5m2!1sen!2seg"
                            style="border:0; width: 100%; height: 550px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-xl-6 my-auto mx-auto">
                        <h3>Leave Your Message</h3>
                        <p>If you have any suggestions or complaints, please contact us via the numbers below or leave your
                            message.</p>
                        <div>
                            <form id="contactFormEn">
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="Name*" name="name"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="Mobile*" name="phone"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="email" class="form-control" placeholder="Email*" name="email"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <textarea class="form-control" placeholder="Your message..." name="content" required></textarea>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 text-center">
                                        <button type="submit" class="btn submit-mail w-100 rounded-0">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif(App::getLocale() == 'cn')
        <section class="mt-xl-5 mt-lg-5 mt-md-5 contact-us">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-xl-6 my-auto mx-auto">
                        <h2 style="line-height: 55px!important;">
                            与我们保持联系
                        </h2>
                        <p class="mt-4">
                            Al Qana'a 是沙特阿拉伯领先的厨房设备和食品保鲜工厂，在满足酒店和餐饮行业需求方面拥有 20 多年的经验。
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 branches-section py-5">
            <div class="container">
                <h2 class="text-center mb-5">我们的分店</h2>
                <div class="row gy-4">

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>吉达展厅</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>麦地那路，国王苏德清真寺前，对面萨尔玛中心</p>
                            <p><i class="fas fa-envelope m-1"></i>信箱 33390，吉达 21448</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966126324117</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>达曼展厅</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>Al Khazan 街 - Al Haimoud 大厦</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0138342117</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-industry m-1"></i>工厂</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>吉达 - 第一工业城 - 第三阶段</p>
                            <p><i class="fas fa-phone-alt m-1"></i>0509290374</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="branch-box">
                            <h5><i class="fas fa-store-alt m-1"></i>利雅得展厅</h5>
                            <p><i class="fas fa-map-marker-alt m-1"></i>2727 Al Wushm - Al Murabba 区</p>
                            <p><i class="fas fa-map-marker-alt m-1"></i>沙特阿拉伯，利雅得</p>
                            <p><i class="fas fa-phone-alt m-1"></i>+966 11 404 2417</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-xl-5 mt-lg-5 mt-md-5 mb-xl-5 mb-lg-5 mb-md-5 contact" id="suggestions">
            <div class="container">
                <div class="row justify-content-center box">
                    <div class="col-xl-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d14858208.470501209!2d46.7075344!3d24.6067117!3m2!1i1024!2i768!4f13.1!2m1!1z2LTYsdmD2Ycg2KfZhNmC2YbYp9i52Ycg2KfZhNiz2LnZiNiv2YrZh-KArQ!5e0!3m2!1sen!2eg!4v1752509905863!5m2!1sen!2eg"
                            style="border:0; width: 100%; height: 550px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-xl-6 my-auto mx-auto">
                        <h3>留下您的留言</h3>
                        <p>如有任何建议或投诉，请通过以下号码联系我们或留下您的留言。</p>
                        <div>
                            <form id="contactFormCn">
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="姓名*" name="name"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="text" class="form-control" placeholder="手机*" name="phone"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <input type="email" class="form-control" placeholder="邮箱*" name="email"
                                        required>
                                </div>
                                <div class="mb-3 form-input">
                                    <textarea class="form-control" placeholder="请在此输入您的留言..." name="content" required></textarea>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 text-center">
                                        <button type="submit" class="btn submit-mail w-100 rounded-0">
                                            发送
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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



@section('script')
    <script>
        $('form').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var $form = $(this);

            $.ajax({
                url: '{{ route('contact.send') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $form.find('[name="name"]').val(),
                    phone: $form.find('[name="phone"]').val(),
                    email: $form.find('[name="email"]').val(),
                    content: $form.find('[name="content"]').val(),
                },
                success: function(response) {
                    var locale = '{{ app()->getLocale() }}';
                    if (locale === 'sa') {
                        alert('تم إرسال طلبك بنجاح!');
                    } else if (locale === 'en') {
                        alert('Your request has been sent successfully!');
                    } else if (locale === 'cn') {
                        alert('您的请求已成功发送！');
                    }
                    $form[0].reset();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });

            return false;
        });
    </script>
@endsection
