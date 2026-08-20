@extends('frontend.layouts.app')

@section('style')
    <style>
        .servicess {
            margin: 50px auto;
            padding: 0 15px;
        }

        .servicess .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
        }

        .servicess h2 {
            color: #1d2d50;
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: center;
        }

        .servicess p {
            text-align: center;
            color: #555;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .servicess form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .servicess label {
            font-weight: bold;
            margin-bottom: 6px;
            color: #1d2d50;
            font-size: 15px;
        }

        .servicess input,
        .servicess select,
        .servicess .submit-form-button {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 100%;
            font-size: 15px;
        }

        .servicess input:focus,
        .servicess select:focus {
            border-color: #1d2d50;
            outline: none;
            box-shadow: 0 0 4px rgba(29, 45, 80, 0.3);
        }

        .servicess .submit-form-button {
            background-color: #ae2025;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .servicess .submit-form-button:hover {
            background-color: #c63237;
        }

        .servicess .instructions {
            margin-top: 40px;
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            line-height: 1.8;
            font-size: 15px;
            color: #333;
        }

        .servicess .instructions h2 {
            color: #1d2d50;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .servicess .instructions ul {
            padding-left: 20px;
            padding-right: 20px;
        }

        .servicess .instructions ul li {
            margin-bottom: 10px;
            list-style: disc;
        }

        /* How to order */
        .how-to-order {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .how-to-order h4,
        .my-slider-wrapper h4 {
            font-weight: bold;
            color: #1d2d50;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .steps-wrapper .step {
            display: flex;
            align-items: center;
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }

        .steps-wrapper .circle {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            background-color: #1d2d50;
            color: #fff;
            border-radius: 50%;
            font-weight: bold;
            margin-left: 10px;
            flex-shrink: 0;
            font-size: 14px;
            margin: 10px;
        }

        /* Why installation */
        .why-installation {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
        }

        .why-installation h4 {
            font-weight: bold;
            color: #1d2d50;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .benefits-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }

        .check-icon {
            margin-left: 10px;
            font-size: 18px;
            color: #2e7d32;
            flex-shrink: 0;
        }

        .my-slider-wrapper {
            position: relative;
            width: 100%;
            padding: 20px 0;
        }

        .category-slider-form {
            transition: transform 0.5s ease-in-out;
            scroll-behavior: smooth;
            gap: 10px;
            padding: 0 30px;
        }

        .slider-item-form {
            min-width: 90px;
            border-radius: 12px;
            padding: 10px 8px;
            text-align: center;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .slider-item-form img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .slider-btn-form {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #ffffff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
            z-index: 2;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
        }

        .prev-btn-form {
            right: 5px;
        }

        .next-btn-form {
            left: 5px;
        }

        .plan-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .plan-box:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .plan-icon {
            /* font-size: 40px; */
            color: #ae2025;
            margin-bottom: 10px;
        }

        .plan-title {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .form-check-input:checked {
            background-color: #ae2025;
            border-color: #ae2025;
        }




        /* Responsive */
        @media (max-width: 576px) {
            .servicess h2 {
                font-size: 22px;
            }

            .steps-wrapper .step,
            .benefits-list li {
                font-size: 14px;
            }

            .servicess .submit-form-button {
                font-size: 15px;
                padding: 10px;
            }
        }
    </style>
    <style>
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product-box {
            background-color: #fff;
            border-radius: 10px;
            width: 15%;
            height: 230px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .product-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .product-box img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            margin-bottom: 5px;
        }

        .product-desc {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 14px;
            color: #ae2025;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .product-check {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 14px;
        }

        .product-check input {
            transform: scale(1.2);
        }

        .main-categories-arrivals {
            direction: rtl;
            background-color: #f4f9fc;
            padding: 40px 0;
        }

        .main-categories-arrivals p {
            color: #242e40;
            font-size: 18px;
            max-width: 80%;
            margin-top: 10px;
        }

        .category-slider-arrivals {
            transition: transform 0.5s ease-in-out;
            scroll-behavior: smooth;
            gap: 10px;
            padding: 0 30px;
        }

        .slider-item-arrivals {
            max-width: 20%;
            border-radius: 12px;
            padding: 10px 8px;
            text-align: center;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .slider-item-arrivals .card {
            padding: 15px;
            height: 400px;
        }

        .slider-item-arrivals .card .badge {
            margin: 5px 0px;
        }


        .slider-item-arrivals .card-body {
            padding: 0px;
        }



        .slider-btn-arrivals {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #ffffff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
            z-index: 2;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
        }

        .main-arrivals .card-img-top {
            width: 120px;
            height: 140px;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <section class="servicess">
        <div class="container">

            {{-- Success message --}}
            @if (session('success'))
                <div class="alert-success">
                    @if (app()->getLocale() == 'sa')
                        تم إرسال طلبك بنجاح.
                    @elseif(app()->getLocale() == 'cn')
                        您的请求已成功提交。
                    @elseif(app()->getLocale() == 'en')
                        Your request has been submitted successfully.
                    @endif
                </div>
            @endif



            @if (app()->getLocale() == 'sa')
                <div class="text-center mb-4">
                    <h2 class="mb-3">ما هي الخدمات الهندسية؟</h2>
                    <p class="text-muted">الخدمات الهندسية هي مجموعة من الرسومات المخططات التي تضمن تنفيذ المشروع بطريقة
                        صحيحة وآمنة، وتشمل الاتي:.</p>

                </div>
                {{-- <p class="fw-bold">
                    لو عندك أي رسومات، مقاسات، أو تفاصيل خاصة بمكان التركيب، تقدر ترفعها وقت الطلب أو ترسلها لنا بعد الشراء،
                    علشان نضمن الخدمة تناسب احتياجاتك 100%.
                </p> --}}
            @elseif(app()->getLocale() == 'cn')
                <div class="text-center mb-4">
                    <h2 class="mb-3">什么是工程服务？</h2>
                    <p class="text-muted">
                        工程服务是一系列图纸和规划，确保项目的正确和安全实施，包括电力、燃气、通风等方面。
                    </p>
                </div>

                {{-- <p class="fw-bold">
                    如果您有任何圖紙、測量值或有關安裝位置的詳細信息，您可以在訂購時上傳或在購買後發送給我們，這樣我們就可以確保服務 100% 滿足您的需求。

                </p> --}}
            @else
                <div class="text-center mb-4">
                    <h2 class="mb-3">What are Engineering Services?</h2>
                    <p class="text-muted">
                        Engineering services are a set of drawings and plans that ensure the project is executed correctly
                        and safely, including the following:.
                    </p>
                </div>

                {{-- <p class="fw-bold">
                    If you have any drawings, measurements, or details regarding the installation location, you can upload
                    them when ordering or send them to us after purchase, so we can ensure that the service meets your needs
                    100%.

                </p> --}}
            @endif
            <div class="row justify-content-center">
                @foreach ($products as $product)
                    <div class="col-xl-4 col-lg-4 col-md-4 mb-3">
                        <div class="card shadow-sm p-2" style="height: 380px; width:320px;">
                            <a href="{{ route('product', $product->slug) }}">
                                <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="card-img-top p-3"
                                    style="height: 200px; width:100%; object-fit: contain;" alt="product">

                            </a>

                            <div class="card-body text-center p-2 position-relative" style="overflow-y: hidden !important;">
                                <div class="mb-2 d-flex justify-content-center align-items-center flex-wrap">
                                    <span class="badge bg-light border text-dark me-1 mb-1"
                                        style="width: auto !important">SKU</span>
                                    <span class="badge bg-success me-1 mb-1" style="width: auto !important">✔
                                        {{ translate('Available') }}</span>
                                    <span class="badge bg-warning text-dark me-1 mb-1"
                                        style="width: auto !important">{{ translate('Shipping') }}</span>
                                </div>


                                <h6 class="card-title fw-bold small mt-2 mb-2">
                                    {{ $product->getTranslation('name') }}
                                </h6>

                                <div class="product-price fw-bold my-1 mb-2" style="font-size: 15px; overflow-y: hidden !important;">
                                    {{ single_price($product->unit_price - $product->discount) }}
                                </div>

                                <small class="text-muted d-block mb-3" style="font-size: 12px;">
                                    @if(app()->getLocale() == 'sa') شامل الضريبه @elseif(app()->getLocale() == 'cn') 包含税 @else Tax Included @endif  
                                </small>

                                <div class="d-flex justify-content-center">
                                    {{-- @if (auth()->check()) --}}
                                        <button type="button" class="btn add-to-cart-btn px-3 py-2 w-75" @if($product->current_stock <= 0) disabled @endif
                                        
                                            data-id="{{ $product->id }}"
                                            style="background-color: #ae2025; color: #fff; font-size: 0.85rem;">
                                            <i class="fa-solid fa-cart-shopping me-1"></i>
                                            {{ translate('Add to Cart') }}
                                        </button>
                                    {{-- @else
                                        <button type="button" onclick="window.location.href='{{ route('user.login') }}'"
                                            class="btn px-3 py-2 w-75" data-id="{{ $product->id }}"
                                            style="background-color: #ae2025; color: #fff; font-size: 0.85rem;">
                                            <i class="fa-solid fa-cart-shopping me-1"></i>
                                            {{ translate('Add to Cart') }}
                                        </button>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="instructions">
                @if (app()->getLocale() == 'sa')
                    <h2>الرجاء مراجعة المتطلبات التالية قبل تقديم الخدمة</h2>
                    <ul>
                        <li>توضيح المساحة الحالية للمطبخ بالرسم.</li>
                        <li>تحديد أماكن الأبواب والنوافذ.</li>
                        <li>تحديد مواقع توصيلات الكهرباء والمياه.</li>
                        <li>تحديد أماكن الأجهزة والمعدات بالمطبخ.</li>
                        <li>تحديد مساحة صالة الطعام.</li>
                        <li>تقديم الملفات بصيغة صورة أو PDF واضحة ومقروءة.</li>
                        <li>إذا كنت تطلب رفع المساحة لدينا، يرجى طلب ذلك مسبقًا.</li>
                    </ul>
                @elseif(app()->getLocale() == 'en')
                    <h2>Please review the following requirements before submitting the service</h2>
                    <ul>
                        <li>Describe the current kitchen space in drawing form.</li>
                        <li>Identify the doors and windows.</li>
                        <li>Identify the electricity and water supply points.</li>
                        <li>Identify the kitchen appliances and furniture.</li>
                        <li>Identify the dining area.</li>
                        <li>Provide clear and readable files in PDF or image format.</li>
                        <li>If you require surveying services, please request it in advance.</li>
                    </ul>
                @elseif(app()->getLocale() == 'cn')
                    <h2>请在提交请求之前审阅以下要求</h2>
                    <ul>
                        <li>用图纸描述现有厨房空间。</li>
                        <li>标识门窗位置。</li>
                        <li>标识电力和供水点。</li>
                        <li>标识厨房设备和家具。</li>
                        <li>标识用餐区域。</li>
                        <li>提供清晰可读的 PDF 或图片文件。</li>
                        <li>如需测绘服务，请提前提出申请。</li>
                    </ul>
                @endif
            </div>

            {{-- 
            <form action="{{ route('service-request.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="gallery-grid">

                            @foreach ($products as $key => $product)
                                <!-- منتج -->
                                <div class="product-box position-relative" style="cursor: pointer" data-bs-target="#productModal{{ $key }}" data-bs-toggle="modal">
                                    <img src="{{ uploaded_asset($product->thumbnail_img) }}" style="width: 100%"
                                        alt="Product">
                                    <div class="product-title">{{ $product->getTranslation('name') }}</div>
                                    <div class="product-price">
                                        {{ single_price($product->unit_price - $product->discount) }} </div>
                                    <div class="product-check position-absolute bottom-0 start-50 translate-middle-x mb-2">
                                        <input type="checkbox" @if ($key == 0) checked @endif
                                            id="check1" value="{{ $product->id }}" name="products[]">
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="productModal{{ $key }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered bg-white" style="max-height: 400px; max-width: 600px; border-radius: 30px;">
                                        <div class="modal-content" style="margin: 0% auto; padding: 0px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="productModalTitle">{{ $product->getTranslation('name') }}</h5>
                                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p id="productModalDesc" class="mb-3">{!! $product->getTranslation('description') !!}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>

                </div>

                <div>
                    <label for="file">
                        @if (app()->getLocale() == 'sa')
                            ارفع ملف (صورة أو PDF):
                        @elseif(app()->getLocale() == 'cn')
                            上传文件 (图片或 PDF):
                        @elseif(app()->getLocale() == 'en')
                            Upload File (Image or PDF):
                        @endif
                    </label>
                    <input type="file" id="file" name="file" accept=".pdf,image/*" required>
                </div>

                <div class="instructions">
                    @if (app()->getLocale() == 'sa')
                        <h2>الرجاء مراجعة المتطلبات التالية قبل تقديم الطلب</h2>
                        <ul>
                            <li>توضيح المساحة الحالية للمطبخ بالرسم.</li>
                            <li>تحديد أماكن الأبواب والنوافذ.</li>
                            <li>تحديد مواقع توصيلات الكهرباء والمياه.</li>
                            <li>تحديد أماكن الأجهزة والمعدات بالمطبخ.</li>
                            <li>تحديد مساحة صالة الطعام.</li>
                            <li>تقديم الملفات بصيغة صورة أو PDF واضحة ومقروءة.</li>
                            <li>إذا كنت تطلب رفع المساحة لدينا، يرجى طلب ذلك مسبقًا.</li>
                        </ul>
                    @elseif(app()->getLocale() == 'en')
                        <h2>Please review the following requirements before submitting the request</h2>
                        <ul>
                            <li>Describe the current kitchen space in drawing form.</li>
                            <li>Identify the doors and windows.</li>
                            <li>Identify the electricity and water supply points.</li>
                            <li>Identify the kitchen appliances and furniture.</li>
                            <li>Identify the dining area.</li>
                            <li>Provide clear and readable files in PDF or image format.</li>
                            <li>If you require surveying services, please request it in advance.</li>
                        </ul>
                    @elseif(app()->getLocale() == 'cn')
                        <h2>请在提交请求之前审阅以下要求</h2>
                        <ul>
                            <li>用图纸描述现有厨房空间。</li>
                            <li>标识门窗位置。</li>
                            <li>标识电力和供水点。</li>
                            <li>标识厨房设备和家具。</li>
                            <li>标识用餐区域。</li>
                            <li>提供清晰可读的 PDF 或图片文件。</li>
                            <li>如需测绘服务，请提前提出申请。</li>
                        </ul>
                    @endif
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="submit-form-button w-25">
                        @if (app()->getLocale() == 'sa')
                            ارسال
                        @elseif(app()->getLocale() == 'cn')
                            提交
                        @elseif(app()->getLocale() == 'en')
                            Submit
                        @endif
                    </button>
                </div>

            </form> --}}


        </div>
    </section>

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



@section('script')
    <script>
        $('.add-to-cart-btn').on('click', function() {
            var product_id = $(this).data('id');
            var $checkbox = $('#addService' + product_id);
            var addService = $checkbox.is(':checked') ? 1 : 0;

            $.post('{{ route('cart.addToCart') }}', {
                _token: '{{ csrf_token() }}',
                id: product_id,
                quantity: 1,
                add_service: addService
            }, function(response) {
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            });
        });
    </script>
@endsection
