@if (App::getLocale() == 'eg' || App::getLocale() == 'sa')
    <footer class="bg-dark text-white pt-5 pb-4 rtl">
        <div class="container">
            <div class="row justify-content-center">
                <!-- عن القناعة -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">{{ get_setting('footer_title', null, App::getLocale()) ?? 'عن القناعة' }}
                    </h5>
                    <ul class="list-unstyled">
                        @php
                            $widget_one_labels = json_decode(
                                get_setting('widget_one_labels', null, App::getLocale()),
                                true,
                            );
                            $widget_one_links = json_decode(get_setting('widget_one_links'), true);
                        @endphp
                        @if ($widget_one_labels && count($widget_one_labels))
                            @foreach ($widget_one_labels as $key => $label)
                                @php
                                    $link = $widget_one_links[$key] ?? '#';
                                @endphp
                                <li>
                                    <a href="{{ $link }}" class="text-white text-decoration-none d-block mb-2">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('about.us') }}" class="text-white text-decoration-none d-block mb-2">عن
                                    متجر القناعة</a>
                            </li>
                            <li><a href="{{ route('contact.us') }}"
                                    class="text-white text-decoration-none d-block mb-2">تواصل معنا</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-white text-decoration-none d-block mb-2">
                                    @if (app()->getLocale() == 'sa')
                                        الأسئلة الشائعة
                                    @elseif(app()->getLocale() == 'cn')
                                        常见问题
                                    @else
                                        FAQs
                                    @endif
                                </a>
                            </li>

                        @endif
                    </ul>
                </div>

                <!-- بيانات الحساب -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3"> صفحات مهمة</h5>
                    <ul class="list-unstyled">
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="text-white text-decoration-none d-block mb-2">حسابي</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}"
                                    class="text-white text-decoration-none d-block mb-2">تسجيل الدخول</a></li>
                        @endauth
                        <li><a href="{{ route('cart') }}" class="text-white text-decoration-none d-block mb-2">سلة
                                التسوق</a></li>
                        <li><a href="{{ route('purchase_history.index') }}"
                                class="text-white text-decoration-none d-block mb-2">طلباتي</a></li>
                        <li><a href="{{ route('contact.us') }}"
                                class="text-white text-decoration-none d-block mb-2">عنـاويني</a></li>
                        <li>
                            <a href="{{ route('orders.track') }}" class="text-white text-decoration-none d-block mb-2">
                                @if (app()->getLocale() == 'sa')
                                    تتبع طلبك
                                @elseif(app()->getLocale() == 'cn')
                                    订单追踪
                                @else
                                    Track Your Order
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- السياسات -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">السياسات والأحكام</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('terms') }}" class="text-white text-decoration-none d-block mb-2">سياسات
                                الشحن</a></li>
                        <li><a href="{{ route('privacypolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">سياسات الخصوصية</a></li>
                        <li><a href="{{ route('supportpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">سياسات الضمان</a></li>
                        <li><a href="{{ route('returnpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">سياسات الاسترجاع والاستبدال</a>
                        </li>
                        <li><a href="{{ route('sellerpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">سياسات التعامل مع العملاء</a></li>
                    </ul>
                </div>

                <!-- سجل كبائع الآن -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">سجّل كبائع وابدأ في بيع منتجاتك معنا اليوم!</h5>
                    {{-- @if (get_setting('newsletter_activation')) --}}
                    <a href="{{ route('seller.login') }}" class="btn w-75"
                        style="background-color: #ae2025; color: #fff;">

                        {{ translate('Register Now') }}
                    </a>
                    {{-- @endif --}}

                    <div class="mt-4">
                        <h6 class="fw-bold">تواصل معنا</h6>
                        <div class="d-flex flex-wrap justify-content-start mt-3 gap-2">
                            @if (get_setting('facebook_link'))
                                <a href="{{ get_setting('facebook_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/facebook.png') }}" alt="Facebook"
                                        width="30" height="30">
                                </a>
                            @endif
                            @if (get_setting('linkedin_link'))
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/linkedin.png') }}" alt="LinkedIn"
                                        width="30" height="30">
                                </a>
                            @endif


                            @if (get_setting('instagram_link'))
                                <a href="{{ get_setting('instagram_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/instagram.png') }}" alt="Instagram"
                                        width="32" height="32">
                                </a>
                            @endif





                            @if (get_setting('snapchat_link'))
                                <a href="{{ get_setting('snapchat_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/snapchat.png') }}" alt="Snapchat"
                                        width="30" height="30">
                                </a>
                            @endif

                            @if (get_setting('threads_link'))
                                <a href="{{ get_setting('threads_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/threads.png') }}" alt="Threads"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('twitter_link'))
                                <a href="{{ get_setting('twitter_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/twitter.png') }}" alt="Twitter"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('youtube_link'))
                                <a href="{{ get_setting('youtube_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/youtube.png') }}" alt="YouTube"
                                        width="32" height="32">
                                </a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
            <hr class="border-secondary" />
            <div class="text-center" style="overflow-y: hidden !important;">
                الرقم الضريبي: {{ get_setting('tax_number') ?? '300036125800003' }} | رقم السجل التجاري:
                {{ get_setting('commercial_registration_number') ?? '700318115' }}
                <br />
                حقوق النشر © {{ date('Y') }} متجر القناعة
            </div>
        </div>

        <!-- زر واتساب -->
        @if (get_setting('whatsapp_number'))
            <a href="https://wa.me/{{ get_setting('whatsapp_number') }}" target="_blank"
                class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif text-decoration-none">
                <i class="fab fa-whatsapp"></i>
            </a>
        @else
            <a href="https://wa.me/966565124444" target="_blank" class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif">
                <i class="fab fa-whatsapp"></i>
            </a>
        @endif

    </footer>
@elseif(App::getLocale() == 'cn')
    <footer class="bg-dark text-white pt-5 pb-4 ltr">
        <div class="container">
            <div class="row justify-content-center">
                <!-- About -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">{{ get_setting('footer_title', null, App::getLocale()) ?? '关于 AlKanaa' }}
                    </h5>
                    <ul class="list-unstyled">
                        @php
                            $widget_one_labels = json_decode(
                                get_setting('widget_one_labels', null, App::getLocale()),
                                true,
                            );
                            $widget_one_links = json_decode(get_setting('widget_one_links'), true);
                        @endphp
                        @if ($widget_one_labels && count($widget_one_labels))
                            @foreach ($widget_one_labels as $key => $label)
                                @php
                                    $link = $widget_one_links[$key] ?? '#';
                                @endphp
                                <li>
                                    <a href="{{ $link }}"
                                        class="text-white text-decoration-none d-block mb-2">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('about.us') }}" class="text-white text-decoration-none d-block mb-2">关于 AlKanaa
                                    商店</a></li>
                            <li><a href="{{ route('blog') }}" class="text-white text-decoration-none d-block mb-2">博客</a></li>
                            <li><a href="{{ route('contact.us') }}" class="text-white text-decoration-none d-block mb-2">联系我们</a></li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-white text-decoration-none d-block mb-2">
                                    @if (app()->getLocale() == 'sa')
                                        الأسئلة الشائعة
                                    @elseif(app()->getLocale() == 'cn')
                                        常见问题
                                    @else
                                        FAQs
                                    @endif
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Account Info -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">账户信息</h5>
                    <ul class="list-unstyled">
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="text-white text-decoration-none d-block mb-2">我的账户</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}"
                                    class="text-white text-decoration-none d-block mb-2">登录</a></li>
                        @endauth
                        <li><a href="{{ route('cart') }}"
                                class="text-white text-decoration-none d-block mb-2">购物车</a></li>
                        <li><a href="{{ route('purchase_history.index') }}"
                                class="text-white text-decoration-none d-block mb-2">我的订单</a></li>
                        <li><a href="{{ route('contact.us') }}" class="text-white text-decoration-none d-block mb-2">我的地址</a></li>
                        <li>
                            <a href="{{ route('orders.track') }}"
                                class="text-white text-decoration-none d-block mb-2">
                                @if (app()->getLocale() == 'sa')
                                    تتبع طلبك
                                @elseif(app()->getLocale() == 'cn')
                                    订单追踪
                                @else
                                    Track Your Order
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Policies -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">政策</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('terms') }}"
                                class="text-white text-decoration-none d-block mb-2">运输政策</a></li>
                        <li><a href="{{ route('privacypolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">隐私政策</a></li>
                        <li><a href="{{ route('supportpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">保修政策</a></li>
                        <li><a href="{{ route('returnpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">退换政策</a></li>
                        <li><a href="{{ route('supportpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">客户服务政策</a></li>
                    </ul>
                </div>

                <!-- Subscribe & Social -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">注册为卖家</h5>
                    @if (get_setting('newsletter_activation'))
                        <a href="{{ route('seller.login') }}" class="btn w-75"
                            style="background-color: #ae2025; color: #fff;">

                            {{ translate('Register Now') }}
                        </a>
                    @else
                        <div class="input-group">
                            <input type="email" class="form-control mb-0 rounded-start-2 rounded-end-0"
                                placeholder="请输入您的邮箱地址">
                            <button class="btn btn-danger rounded-end-2 rounded-start-0"><i
                                    class="fa fa-arrow-left"></i></button>
                        </div>
                    @endif

                    <div class="mt-4">
                        <h6 class="fw-bold">关注我们</h6>
                        <div class="d-flex flex-wrap justify-content-start mt-3 gap-2">
                            @if (get_setting('facebook_link'))
                                <a href="{{ get_setting('facebook_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/facebook.png') }}" alt="Facebook"
                                        width="30" height="30">
                                </a>
                            @endif
                            @if (get_setting('linkedin_link'))
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/linkedin.png') }}" alt="LinkedIn"
                                        width="30" height="30">
                                </a>
                            @endif


                            @if (get_setting('instagram_link'))
                                <a href="{{ get_setting('instagram_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/instagram.png') }}" alt="Instagram"
                                        width="32" height="32">
                                </a>
                            @endif





                            @if (get_setting('snapchat_link'))
                                <a href="{{ get_setting('snapchat_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/snapchat.png') }}" alt="Snapchat"
                                        width="30" height="30">
                                </a>
                            @endif

                            @if (get_setting('threads_link'))
                                <a href="{{ get_setting('threads_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/threads.png') }}" alt="Threads"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('twitter_link'))
                                <a href="{{ get_setting('twitter_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/twitter.png') }}" alt="Twitter"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('youtube_link'))
                                <a href="{{ get_setting('youtube_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/youtube.png') }}" alt="YouTube"
                                        width="32" height="32">
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <hr class="border-secondary" />
            <div class="text-center" style="overflow-y: hidden !important;">
                税号: {{ get_setting('tax_number') ?? '300036125800003' }} | 商业注册号:
                {{ get_setting('commercial_registration_number') ?? '700318115' }}
                <br />
                © {{ date('Y') }} AlKanaa 商店 版权所有.
            </div>
        </div>

        @if (get_setting('whatsapp_number'))
            <a href="https://wa.me/{{ get_setting('whatsapp_number') }}" target="_blank"
                class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif text-decoration-none">
                <i class="fab fa-whatsapp"></i>
            </a>
        @else
            <a href="https://wa.me/966565124444" target="_blank" class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif">
                <i class="fab fa-whatsapp"></i>
            </a>
        @endif
    </footer>
@else
    <footer class="bg-dark text-white pt-5 pb-4 ltr">
        <div class="container">
            <div class="row justify-content-center">
                <!-- About -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        {{ get_setting('footer_title', null, App::getLocale()) ?? 'About AlKanaa' }}</h5>
                    <ul class="list-unstyled">
                        @php
                            $widget_one_labels = json_decode(
                                get_setting('widget_one_labels', null, App::getLocale()),
                                true,
                            );
                            $widget_one_links = json_decode(get_setting('widget_one_links'), true);
                        @endphp
                        @if ($widget_one_labels && count($widget_one_labels))
                            @foreach ($widget_one_labels as $key => $label)
                                @php
                                    $link = $widget_one_links[$key] ?? '#';
                                @endphp
                                <li>
                                    <a href="{{ $link }}"
                                        class="text-white text-decoration-none d-block mb-2">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('about.us') }}" class="text-white text-decoration-none d-block mb-2">About AlKanaa
                                    Store</a></li>
                            <li><a href="{{ route('blog.index') }}" class="text-white text-decoration-none d-block mb-2">Blog</a></li>
                            <li><a href="{{ route('contact.us') }}" class="text-white text-decoration-none d-block mb-2">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-white text-decoration-none d-block mb-2">
                                    @if (app()->getLocale() == 'sa')
                                        FAQ
                                    @elseif(app()->getLocale() == 'cn')
                                        常见问题
                                    @else
                                        FAQs
                                    @endif
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Account Info -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Important Pages</h5>
                    <ul class="list-unstyled">
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="text-white text-decoration-none d-block mb-2">My Account</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}"
                                    class="text-white text-decoration-none d-block mb-2">Login</a></li>
                        @endauth
                        <li><a href="{{ route('cart') }}"
                                class="text-white text-decoration-none d-block mb-2">Shopping Cart</a></li>
                        <li><a href="{{ route('purchase_history.index') }}"
                                class="text-white text-decoration-none d-block mb-2">My Orders</a></li>
                        <li><a href="{{ route('contact.us') }}" class="text-white text-decoration-none d-block mb-2">My Addresses</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.track') }}" class="text-white text-decoration-none d-block mb-2">
                                @if (app()->getLocale() == 'sa')
                                    تتبع طلبك
                                @elseif(app()->getLocale() == 'cn')
                                    订单追踪
                                @else
                                    Track Your Order
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Policies -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Policies and Terms</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('terms') }}"
                                class="text-white text-decoration-none d-block mb-2">Shipping Policy</a></li>
                        <li><a href="{{ route('privacypolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">Privacy Policy</a></li>
                        <li><a href="{{ route('supportpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">Warranty Policy</a></li>
                        <li><a href="{{ route('returnpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">Return & Exchange</a></li>
                        <li><a href="{{ route('supportpolicy') }}"
                                class="text-white text-decoration-none d-block mb-2">Customer Service Policy</a></li>
                    </ul>
                </div>

                <!-- Subscribe & Social -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Register as a Seller</h5>
                    @if (get_setting('newsletter_activation'))
                        <a href="{{ route('seller.login') }}" class="btn w-75"
                            style="background-color: #ae2025; color: #fff;">

                            {{ translate('Register Now') }}
                        </a>
                    @else
                        <div class="input-group">
                            <input type="email" class="form-control mb-0 rounded-start-2 rounded-end-0"
                                placeholder="Enter your email address">
                            <button class="btn btn-danger rounded-end-2 rounded-start-0"><i
                                    class="fa fa-arrow-left"></i></button>
                        </div>
                    @endif

                    <div class="mt-4">
                        <h6 class="fw-bold">Connect with us</h6>
                        <div class="d-flex flex-wrap justify-content-start mt-3 gap-2">
                            @if (get_setting('facebook_link'))
                                <a href="{{ get_setting('facebook_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/facebook.png') }}" alt="Facebook"
                                        width="30" height="30">
                                </a>
                            @endif
                            @if (get_setting('linkedin_link'))
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/linkedin.png') }}" alt="LinkedIn"
                                        width="30" height="30">
                                </a>
                            @endif


                            @if (get_setting('instagram_link'))
                                <a href="{{ get_setting('instagram_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/instagram.png') }}" alt="Instagram"
                                        width="32" height="32">
                                </a>
                            @endif





                            @if (get_setting('snapchat_link'))
                                <a href="{{ get_setting('snapchat_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/snapchat.png') }}" alt="Snapchat"
                                        width="30" height="30">
                                </a>
                            @endif

                            @if (get_setting('threads_link'))
                                <a href="{{ get_setting('threads_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/threads.png') }}" alt="Threads"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('twitter_link'))
                                <a href="{{ get_setting('twitter_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/twitter.png') }}" alt="Twitter"
                                        width="32" height="32">
                                </a>
                            @endif
                            @if (get_setting('youtube_link'))
                                <a href="{{ get_setting('youtube_link') }}" target="_blank">
                                    <img src="{{ static_asset('assets/front_img/youtube.png') }}" alt="YouTube"
                                        width="32" height="32">
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <hr class="border-secondary" />
            <div class="text-center" style="overflow-y: hidden !important;">
                Tax Number: {{ get_setting('tax_number') ?? '300036125800003' }} | Commercial Registration:
                {{ get_setting('commercial_registration_number') ?? '700318115' }}
                <br />
                © {{ date('Y') }} AlKanaa Store. All rights reserved.
            </div>
        </div>

        @if (get_setting('whatsapp_number'))
            <a href="https://wa.me/{{ get_setting('whatsapp_number') }}" target="_blank"
                class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif text-decoration-none">
                <i class="fab fa-whatsapp"></i>
            </a>
        @else
            <a href="https://wa.me/966565124444" target="_blank" class="@if (app()->getLocale() == 'sa') whatsapp-float @else whatsapp-float-en @endif">
                <i class="fab fa-whatsapp"></i>
            </a>
        @endif

    </footer>

@endif
