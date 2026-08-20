@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    @php
        $availability = 'out of stock';
        $qty = 0;
        if ($detailedProduct->variant_product) {
            foreach ($detailedProduct->stocks as $key => $stock) {
                $qty += $stock->qty;
            }
        } else {
            $qty = optional($detailedProduct->stocks->first())->qty;
        }
        if ($qty > 0) {
            $availability = 'in stock';
        }
    @endphp
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator"
        content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:brand"
        content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">
    <meta property="product:availability" content="{{ $availability }}">
    <meta property="product:condition" content="new">
    <meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">
    <meta property="product:retailer_item_id" content="{{ $detailedProduct->slug }}">
    <meta property="product:price:currency" content="{{ get_system_default_currency()->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('style')
    <style>
        .halimdotcom {
            background-color: #f0f4f7 !important;
        }

        .product {
            padding: 5% 0px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.45em 0.85em;
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.2;
            white-space: nowrap;
            border-radius: 0.375rem;
            width: auto;
            min-width: auto;
            max-width: none;
            overflow: visible;
            text-overflow: unset;
        }
        .icon_in_product_details{
            width: 20%;
            margin: 0 5px;
        }
        .img-fluid-for-details{
            height: 350px;
            width: 500px;
            object-fit: contain;
        }
        .img-fluid-for-details img{
            height: 100%;
            width: 100%;
            object-fit: contain;
        }
        @media screen and (max-width:1000px) {
            .img-fluid-for-details{
            height: auto;
            width: 100%;
            object-fit: contain;
        }
        .product{
            padding: 5% 20px;

        }
        }
    </style>
@endsection

@section('content')

    <section class="product halimdotcom">
        <div class="container">
        <div class="row align-items-start">
            <!-- صورة المنتج -->
            <div class="col-lg-6 mb-4">
                <div class="bg-white rounded shadow p-3 text-center img-fluid-for-details">
                    <img src="{{ uploaded_asset($detailedProduct->thumbnail_img) }}" class=" rounded"
                        alt="اسم المنتج">
                </div>
            </div>

            <!-- تفاصيل المنتج -->
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2 class="fw-bold mb-0">{{ $detailedProduct->getTranslation('name') }}</h2>
                    <div class="d-flex ms-3">
                        <!-- Add to wishlist button -->
                        <a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})"
                            class="me-3 fs-25 text-dark opacity-75 hover-opacity-100 text-decoration-none">
                            <i class="la la-heart-o me-1"></i> 
                        </a>
                        <!-- Add to compare button -->
                        {{-- <a href="javascript:void(0)" onclick="addToCompare({{ $detailedProduct->id }})"
                            class="fs-6 text-dark opacity-75 hover-opacity-100 text-decoration-none">
                            <i class="las la-sync me-1"></i> {{ translate('Add to Compare') }}
                        </a> --}}
                    </div>
                </div>
                {{-- <div class="mb-2">
                    <small class="text-danger"><i class="fa fa-fire"></i> تم مشاهدته 70 مرة</small>
                </div> --}}

                @if ($detailedProduct->discount == 0.0)
                    <h3 class="fw-bold text-primary">{{ $detailedProduct->unit_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 15px; height: 15px;"></h3>
                @else
                    @php
                        $old_price = $detailedProduct->unit_price;
                        $discounted_price = $detailedProduct->discount_type == 'percent'
                            ? $old_price - ($old_price * $detailedProduct->discount / 100)
                            : $old_price - $detailedProduct->discount;
                        $saving = $old_price - $discounted_price;
                    @endphp

                    <div class="text-muted mb-2">
                        <span class="text-decoration-line-through" style="font-size: 17px;">{{ $old_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 17px; height: 17px;"></span> <br>
                        <span class="fw-bold text-primary" style="font-size: 17px;">{{ $discounted_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 17px; height: 17px;"></span>
                        <span class="badge bg-danger" style="font-size: 17px;">
                            {{ translate('save') }} {{ $saving }} <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 17px; height: 17px;">
                        </span>
                    </div> 
                @endif

            <div class="text-muted mb-3" style="overflow-y: hidden !important;">{{ translate('including_vat') }}</div>
                <div class="row align-items-center">
        @if (get_setting('product_query_activation') == 1)
            <!-- Ask about this product -->
            <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 mb-3">
                <a href="javascript:void();" onclick="goToView('product_query')" class="text-primary fs-14 fw-600 d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                        <g id="Group_25571" data-name="Group 25571" transform="translate(-975 -411)">
                            <g id="Path_32843" data-name="Path 32843" transform="translate(975 411)" fill="#fff">
                                <path
                                    d="M 16 31 C 11.9933500289917 31 8.226519584655762 29.43972969055176 5.393400192260742 26.60659980773926 C 2.560270071029663 23.77347946166992 1 20.00665092468262 1 16 C 1 11.9933500289917 2.560270071029663 8.226519584655762 5.393400192260742 5.393400192260742 C 8.226519584655762 2.560270071029663 11.9933500289917 1 16 1 C 20.00665092468262 1 23.77347946166992 2.560270071029663 26.60659980773926 5.393400192260742 C 29.43972969055176 8.226519584655762 31 11.9933500289917 31 16 C 31 20.00665092468262 29.43972969055176 23.77347946166992 26.60659980773926 26.60659980773926 C 23.77347946166992 29.43972969055176 20.00665092468262 31 16 31 Z"
                                    stroke="none" />
                                <path
                                    d="M 16 2 C 12.26045989990234 2 8.744749069213867 3.456249237060547 6.100500106811523 6.100500106811523 C 3.456249237060547 8.744749069213867 2 12.26045989990234 2 16 C 2 19.73954010009766 3.456249237060547 23.2552490234375 6.100500106811523 25.89949989318848 C 8.744749069213867 28.54375076293945 12.26045989990234 30 16 30 C 19.73954010009766 30 23.2552490234375 28.54375076293945 25.89949989318848 25.89949989318848 C 28.54375076293945 23.2552490234375 30 19.73954010009766 30 16 C 30 12.26045989990234 28.54375076293945 8.744749069213867 25.89949989318848 6.100500106811523 C 23.2552490234375 3.456249237060547 19.73954010009766 2 16 2 M 16 0 C 24.8365592956543 0 32 7.163440704345703 32 16 C 32 24.8365592956543 24.8365592956543 32 16 32 C 7.163440704345703 32 0 24.8365592956543 0 16 C 0 7.163440704345703 7.163440704345703 0 16 0 Z"
                                    stroke="none" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                            </g>
                            <path id="Path_32842" data-name="Path 32842"
                                d="M28.738,30.935a1.185,1.185,0,0,1-1.185-1.185,3.964,3.964,0,0,1,.942-2.613c.089-.095.213-.207.361-.344.735-.658,2.252-2.032,2.252-3.555a2.228,2.228,0,0,0-2.37-2.37,2.228,2.228,0,0,0-2.37,2.37,1.185,1.185,0,1,1-2.37,0,4.592,4.592,0,0,1,4.74-4.74,4.592,4.592,0,0,1,4.74,4.74c0,2.577-2.044,4.432-3.028,5.333l-.284.255a1.89,1.89,0,0,0-.243.948A1.185,1.185,0,0,1,28.738,30.935Zm0,3.561a1.185,1.185,0,0,1-.835-2.026,1.226,1.226,0,0,1,1.671,0,1.061,1.061,0,0,1,.148.184,1.345,1.345,0,0,1,.113.2,1.41,1.41,0,0,1,.065.225,1.138,1.138,0,0,1,0,.462,1.338,1.338,0,0,1-.065.219,1.185,1.185,0,0,1-.113.207,1.06,1.06,0,0,1-.148.184A1.185,1.185,0,0,1,28.738,34.5Z"
                                transform="translate(962.004 400.504)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                        </g>
                    </svg>
                    <span class="ml-2 text-primary animate-underline-blue">{{ translate('Product Inquiry') }}</span>
                </a>
            </div>
        @endif
        
    </div>

            <div class="mb-3 d-flex gap-2 flex-wrap">
                <span class="badge bg-light text-dark border">{{ translate('sku') }}: {{ $detailedProduct->stocks->first()->sku ?? '' }}</span>
            @if ($detailedProduct->stocks->sum('qty') > 0)
                <span class="badge bg-success">✔ {{ translate('available') }}</span>
            @else
                <span class="badge bg-danger">✘ {{ translate('not_available') }}</span> 
            @endif

                @if ($detailedProduct->shipping_type == 'free')
                    <span class="badge bg-warning text-dark">{{ translate('free_shipping') }}</span>
                @else
                    <span class="badge bg-light text-dark border">
                        {{ translate('shipping') }}: {{ single_price($detailedProduct->shipping_cost) }}
                    </span>
            @endif
            </div>

            {{-- <div class="form-check d-flex align-items-center m-0 mb-1" style="font-size: 0.9rem;">
                <input 
                    class="form-check-input add-service-checkbox me-2" 
                    type="checkbox"
                        @if (app()->getLocale() == 'sa') style="float: right !important; margin-right: -2px !important;"
                @endif
                    value="{{ $detailedProduct->service_fee ?? 100 }}" 
                    id="addService{{ $detailedProduct->id }}">
                <label class="form-check-label @if (app()->getLocale() == 'sa') me-3 @endif" for="addService{{ $detailedProduct->id }}">
                    {{ translate('add_service') }} ({{ $detailedProduct->service_fee ?? 0 }} <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 15px; height: 15px;">)
                </label>
            </div> --}}
            {{-- <span class="mb-1">
                (@if (app()->getLocale() == 'sa') اختر الخدمة للاستفادة من خدمة التركيب @elseif(app()->getLocale() == 'cn') 选择服务以享受组装服务 @elseif(app()->getLocale() == 'en') Select the service to enjoy the assembly service @endif)
            </span> --}}
            {{-- @if (auth()->check()) --}}
            <button class="btn btn-danger px-4 py-2 add-to-cart-btn d-flex align-items-center mt-4
            @if ($detailedProduct->stocks->sum('qty') == 0) disabled @endif
            " 
                    data-id="{{ $detailedProduct->id }}">
                <i class="fa fa-cart-plus me-2"></i> {{ translate('add_to_cart') }}
            </button>
            {{-- @else
            <button onclick="window.location.href='{{ route('user.login') }}'" class="btn btn-danger px-4 py-2 d-flex align-items-center mt-2">
                <i class="fa fa-cart-plus me-2"></i> {{ translate('add_to_cart') }}
            </button>
            @endif --}}
            
            @php
    $hiddenIds = [86,87,88,89,90,91];
@endphp

<div class="d-flex justify-content-start text-center mt-4">
    @if (!in_array((int) $detailedProduct->id, $hiddenIds))
        <div class="icon_in_product_details">
            <div class="p-1 border rounded-3 shadow-sm h-100">
                <img src="{{ static_asset('assets/front_img/productgurantee.png') }}" alt="Icon 1" class="img-fluid mb-2" style="width: 40px;">
                <p class="mb-0">{{ translate('product_guarantee') }}</p>
            </div>
        </div>
        <div class="icon_in_product_details">
            <div class="p-1 border rounded-3 shadow-sm h-100">
                <img src="{{ static_asset('assets/front_img/fastshipping.png') }}" alt="Icon 2" class="img-fluid mb-2" style="width: 40px;">
                <p class="mb-0">{{ translate('fast_shipping') }}</p>
            </div>
        </div>
    @endif

    <div class="icon_in_product_details">
        <div class="p-1 border rounded-3 shadow-sm h-100">
            <img src="{{ static_asset('assets/front_img/customer_service.png') }}" alt="Icon 3" class="img-fluid mb-2" style="width: 40px;">
            <p class="mb-0">{{ translate('customer_service') }}</p>
        </div>
    </div>
    <div class="icon_in_product_details">
        <div class="p-1 border rounded-3 shadow-sm h-100">
            <img src="{{ static_asset('assets/front_img/paysafe.png') }}" alt="Icon 4" class="img-fluid mb-2" style="width: 40px;">
            <p class="mb-0">{{ translate('secure_payment') }}</p>
        </div>
    </div>
</div>



        </div>


        <!-- التبويبات -->
        <div class="row mt-5">
            <div class="col-12">
                @php
                    $hideSpecs = in_array((int) ($detailedProduct->id ?? 0), [86,87,88,89,90,91]);
                @endphp

                <ul class="nav nav-tabs justify-content-center" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                            type="button" role="tab">{{ translate('Description') }}</button>
                    </li>

                    @unless ($hideSpecs)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs"
                                type="button" role="tab">{{ translate('specifications') }}</button>
                        </li>
                    @endunless
                </ul>
                <div class="tab-content border border-top-0 p-4 bg-white" id="productTabContent">
                    <!-- تبويب الوصف -->
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">
                        <p>{!! $detailedProduct->getTranslation('description') !!}</p>
                        @if ($detailedProduct->id == 86 || $detailedProduct->id == 87 || $detailedProduct->id == 88 || $detailedProduct->id == 89 || $detailedProduct->id == 90 || $detailedProduct->id == 91)
                        <h2 class="text-danger fw-bold mt-2 mb-2 text-center">@if(app()->getLocale() == 'sa') متطلبات الخدمه @elseif(app()->getLocale() == 'cn') 服务要求 @elseif(app()->getLocale() == 'en') Service Requirements @endif</h2>
                        <div class="text-align-center p-4">
                            @if (app()->getLocale() == 'sa')
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
                        @endif

                    </div>

                    @unless ($hideSpecs)
                    <!-- تبويب المواصفات -->
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <table class="table table-striped">
                            <tbody>
                                @if ($detailedProduct->weight)
                                    <tr>
                                        <th>{{ translate('weight') }}</th>
                                        <td>{{ $detailedProduct->weight }} {{ translate('kg') }}</td>
                                    </tr>
                                @endif
                                @if ($detailedProduct->unit)
                                    <tr>
                                        <th>{{ translate('unit') }}</th>
                                        <td>{{ $detailedProduct->unit }}</td>
                                    </tr>
                                @endif
                                @if ($detailedProduct->getTranslation('name'))
                                    <tr>
                                        <th>{{ translate('material') }}</th>
                                        <td>
                                            @if ($detailedProduct->is_stainless)
                                                {{ translate('stainless') }}
                                            @else
                                                {{ translate('not_stainless') }}
                                            @endif
                                        </td>
                                    </tr> @endif
                                                                                                        {{-- يمكنك إضافة أي مواصفات أخرى هنا حسب البيانات المتاحة --}}
                                                                                                    </tbody>
                        </table>

                    </div>
                    @endunless
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
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
    <div id="miniCartHost">
    </div>



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
