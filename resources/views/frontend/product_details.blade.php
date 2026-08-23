@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title ?? $detailedProduct->getTranslation('name') }}@stop
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
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:brand" content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">
    <meta property="product:availability" content="{{ $availability }}">
    <meta property="product:condition" content="new">
    <meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">
    <meta property="product:currency" content="{{ get_system_default_currency()->code }}" />
@endsection

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-neutral-100/70 border-b border-neutral-200/80 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-semibold text-neutral-500 overflow-x-auto no-scrollbar">
                <a href="{{ route('home') }}" class="text-neutral-600 hover:text-[#4868e6] transition no-underline">
                    <i class="fa-solid fa-house text-[11px] me-1"></i>{{ translate('Home') }}
                </a>
                <i class="fa-solid fa-chevron-left text-[9px] text-neutral-400"></i>
                @if ($detailedProduct->category)
                    <a href="{{ route('products.category', $detailedProduct->category->slug) }}" class="text-neutral-600 hover:text-[#4868e6] transition no-underline whitespace-nowrap">
                        {{ $detailedProduct->category->getTranslation('name') }}
                    </a>
                    <i class="fa-solid fa-chevron-left text-[9px] text-neutral-400"></i>
                @endif
                <span class="text-[#0c234a] font-bold truncate max-w-xs sm:max-w-md">
                    {{ $detailedProduct->getTranslation('name') }}
                </span>
            </nav>
        </div>
    </div>

    <!-- Main Product Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- 1. Product Gallery / Images (Right side in RTL) -->
            <div class="lg:col-span-6 flex flex-col gap-4">
                <div class="relative overflow-hidden rounded-3xl border border-neutral-200/90 bg-white p-6 sm:p-10 shadow-xs flex items-center justify-center min-h-[340px] sm:min-h-[440px] group">
                    @php
                        $photos = explode(',', $detailedProduct->photos);
                        $hasDiscount = $detailedProduct->discount > 0;
                        $old_price = $detailedProduct->unit_price;
                        $discounted_price = $hasDiscount
                            ? ($detailedProduct->discount_type == 'percent'
                                ? $old_price - ($old_price * $detailedProduct->discount / 100)
                                : $old_price - $detailedProduct->discount)
                            : $old_price;
                        $saving = $old_price - $discounted_price;
                    @endphp

                    <!-- Badges -->
                    <div class="absolute top-4 start-4 z-10 flex flex-col gap-2">
                        @if ($hasDiscount)
                            <span class="rounded-full bg-rose-500 text-white px-3 py-1 text-xs font-black shadow-xs">
                                {{ translate('save') }} {{ number_format($detailedProduct->discount) }}{{ $detailedProduct->discount_type == 'percent' ? '%' : ' ' . translate('SAR') }}
                            </span>
                        @endif
                        @if ($detailedProduct->is_stainless)
                            <span class="rounded-full bg-[#0c234a] text-white px-3 py-1 text-[11px] font-bold shadow-xs">
                                <i class="fa-solid fa-shield-halved text-[10px] me-1"></i>ستانلس ستيل
                            </span>
                        @endif
                    </div>

                    <!-- Main Image with Zoom on Hover -->
                    <img id="mainProductImage" src="{{ uploaded_asset($detailedProduct->thumbnail_img) }}"
                        class="max-h-[320px] sm:max-h-[400px] w-auto max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="{{ $detailedProduct->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>

                <!-- Gallery Thumbnails (if multiple images) -->
                @if (count($photos) > 1 && $photos[0] != '')
                    <div class="flex items-center gap-3 overflow-x-auto no-scrollbar py-1">
                        <button type="button" class="thumb-btn size-16 sm:size-20 rounded-2xl border-2 border-[#4868e6] bg-white p-2 shadow-2xs flex-shrink-0 transition"
                            onclick="changeMainImage('{{ uploaded_asset($detailedProduct->thumbnail_img) }}', this)">
                            <img src="{{ uploaded_asset($detailedProduct->thumbnail_img) }}" class="size-full object-contain" alt="Thumb">
                        </button>
                        @foreach ($photos as $photo)
                            @if ($photo)
                                <button type="button" class="thumb-btn size-16 sm:size-20 rounded-2xl border border-neutral-200 bg-white p-2 shadow-2xs flex-shrink-0 transition hover:border-[#4868e6]"
                                    onclick="changeMainImage('{{ uploaded_asset($photo) }}', this)">
                                    <img src="{{ uploaded_asset($photo) }}" class="size-full object-contain" alt="Thumb">
                                </button>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- 2. Product Details & Purchase Box (Left side in RTL) -->
            <div class="lg:col-span-6 flex flex-col">
                
                <!-- Product Title & Wishlist -->
                <div class="flex items-start justify-between gap-4 mb-3">
                    <h1 class="text-xl sm:text-3xl font-black text-[#0c234a] leading-tight">
                        {{ $detailedProduct->getTranslation('name') }}
                    </h1>
                    <button type="button" onclick="addToWishList({{ $detailedProduct->id }})"
                        class="flex-shrink-0 flex size-10 items-center justify-center rounded-full border border-neutral-200 bg-white text-neutral-500 shadow-2xs transition hover:border-rose-300 hover:bg-rose-50 hover:text-rose-500"
                        title="{{ translate('Add to Wishlist') }}">
                        <i class="fa-regular fa-heart text-base"></i>
                    </button>
                </div>

                <!-- SKU & In-Stock Status -->
                <div class="flex items-center gap-2.5 flex-wrap mb-4">
                    @if ($detailedProduct->stocks->first() && $detailedProduct->stocks->first()->sku)
                        <span class="rounded-lg bg-neutral-100 border border-neutral-200/80 px-2.5 py-1 text-xs font-semibold text-neutral-600">
                            {{ translate('SKU') }}: <span class="font-mono">{{ $detailedProduct->stocks->first()->sku }}</span>
                        </span>
                    @endif

                    @if ($detailedProduct->stocks->sum('qty') > 0)
                        <span class="rounded-lg bg-emerald-50 border border-emerald-200 px-2.5 py-1 text-xs font-bold text-emerald-700 flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ translate('available') }}
                        </span>
                    @else
                        <span class="rounded-lg bg-rose-50 border border-rose-200 px-2.5 py-1 text-xs font-bold text-rose-700 flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-rose-500"></span>
                            {{ translate('not_available') }}
                        </span>
                    @endif

                    @if ($detailedProduct->shipping_type == 'free')
                        <span class="rounded-lg bg-amber-50 border border-amber-200 px-2.5 py-1 text-xs font-bold text-amber-700">
                            <i class="fa-solid fa-truck-fast text-[11px] me-1"></i>{{ translate('free_shipping') }}
                        </span>
                    @endif
                </div>

                <!-- Price Block -->
                <div class="rounded-2xl bg-neutral-50 border border-neutral-200/80 p-4 sm:p-5 mb-5">
                    <div class="flex items-baseline gap-3 flex-wrap">
                        @if ($hasDiscount)
                            <span class="text-2xl sm:text-4xl font-black text-[#4868e6]">
                                {{ number_format($discounted_price, 2) }} <span class="text-sm sm:text-base font-bold text-neutral-700">ر.س</span>
                            </span>
                            <span class="text-sm sm:text-base font-semibold text-neutral-400 line-through">
                                {{ number_format($old_price, 2) }} ر.س
                            </span>
                            <span class="rounded-full bg-rose-500 text-white px-2.5 py-0.5 text-xs font-extrabold">
                                {{ translate('save') }} {{ number_format($saving, 2) }} ر.س
                            </span>
                        @else
                            <span class="text-2xl sm:text-4xl font-black text-[#0c234a]">
                                {{ number_format($detailedProduct->unit_price, 2) }} <span class="text-sm sm:text-base font-bold text-neutral-700">ر.س</span>
                            </span>
                        @endif
                    </div>
                    <p class="text-xs font-medium text-neutral-500 mt-1 mb-0">
                        {{ translate('including_vat') }} (15%)
                    </p>
                </div>

                <!-- Add to Cart & Inquiry Action -->
                <div class="flex items-center gap-3 mb-6">
                    <button class="add-to-cart-btn flex-1 flex items-center justify-center gap-2.5 bg-[#4868e6] hover:bg-[#3753c8] text-white font-bold text-sm sm:text-base py-3.5 px-6 rounded-xl shadow-md transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        data-id="{{ $detailedProduct->id }}"
                        @if ($detailedProduct->stocks->sum('qty') == 0) disabled @endif>
                        <i class="fa-solid fa-cart-plus text-lg"></i>
                        <span>{{ translate('add_to_cart') }}</span>
                    </button>

                    @php $phone = get_setting('contact_phone') ?? '966565124444'; @endphp
                    <a href="https://wa.me/{{ $phone }}?text={{ urlencode('مرحباً، أستفسر عن منتج: ' . $detailedProduct->getTranslation('name') . ' ' . route('product', $detailedProduct->slug)) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba59] text-white font-bold text-xs sm:text-sm py-3.5 px-4 rounded-xl shadow-sm transition duration-200 no-underline"
                        title="استفسار عبر واتساب">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span class="hidden sm:inline">طلب تسعير</span>
                    </a>
                </div>

                <!-- 4 Trust Badges Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-2">
                    <div class="flex flex-col items-center text-center p-3 rounded-2xl border border-neutral-200/80 bg-white shadow-2xs">
                        <div class="flex size-10 items-center justify-center rounded-full bg-blue-50 text-[#4868e6] mb-2 text-base">
                            <i class="fa-solid fa-shield-check"></i>
                        </div>
                        <span class="text-[11px] font-bold text-neutral-800 leading-tight">{{ translate('product_guarantee') }}</span>
                    </div>

                    <div class="flex flex-col items-center text-center p-3 rounded-2xl border border-neutral-200/80 bg-white shadow-2xs">
                        <div class="flex size-10 items-center justify-center rounded-full bg-blue-50 text-[#4868e6] mb-2 text-base">
                            <i class="fa-solid fa-truck-bolt"></i>
                        </div>
                        <span class="text-[11px] font-bold text-neutral-800 leading-tight">{{ translate('fast_shipping') }}</span>
                    </div>

                    <div class="flex flex-col items-center text-center p-3 rounded-2xl border border-neutral-200/80 bg-white shadow-2xs">
                        <div class="flex size-10 items-center justify-center rounded-full bg-blue-50 text-[#4868e6] mb-2 text-base">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <span class="text-[11px] font-bold text-neutral-800 leading-tight">{{ translate('customer_service') }}</span>
                    </div>

                    <div class="flex flex-col items-center text-center p-3 rounded-2xl border border-neutral-200/80 bg-white shadow-2xs">
                        <div class="flex size-10 items-center justify-center rounded-full bg-blue-50 text-[#4868e6] mb-2 text-base">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <span class="text-[11px] font-bold text-neutral-800 leading-tight">{{ translate('secure_payment') }}</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Product Tabs Section (Description & Specifications) -->
        <div class="mt-12 bg-white rounded-3xl border border-neutral-200/90 shadow-xs overflow-hidden">
            <!-- Tab Headers -->
            <div class="flex border-b border-neutral-200 bg-neutral-50/70 p-2 gap-2" id="productDetailTabs" role="tablist">
                <button type="button"
                    class="tab-trigger flex items-center gap-2 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold transition duration-200 bg-[#4868e6] text-white shadow-xs"
                    onclick="switchTab('tab-desc', this)">
                    <i class="fa-solid fa-file-lines text-sm"></i>
                    <span>{{ translate('Description') }}</span>
                </button>

                @if ($detailedProduct->weight || $detailedProduct->unit || $detailedProduct->is_stainless)
                    <button type="button"
                        class="tab-trigger flex items-center gap-2 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold text-neutral-600 hover:text-[#4868e6] hover:bg-white transition duration-200"
                        onclick="switchTab('tab-specs', this)">
                        <i class="fa-solid fa-sliders text-sm"></i>
                        <span>{{ translate('specifications') }}</span>
                    </button>
                @endif

                <button type="button"
                    class="tab-trigger flex items-center gap-2 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold text-neutral-600 hover:text-[#4868e6] hover:bg-white transition duration-200"
                    onclick="switchTab('tab-shipping', this)">
                    <i class="fa-solid fa-truck text-sm"></i>
                    <span>الشحن والتوصيل</span>
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="p-5 sm:p-8">
                <!-- 1. Description Tab -->
                <div id="tab-desc" class="tab-content-panel space-y-4">
                    <div class="prose max-w-none text-sm sm:text-base leading-relaxed text-neutral-700">
                        {!! $detailedProduct->getTranslation('description') !!}
                    </div>

                    @if (in_array((int)$detailedProduct->id, [86,87,88,89,90,91]))
                        <div class="mt-6 rounded-2xl bg-amber-50 border border-amber-200 p-5">
                            <h3 class="text-base font-bold text-[#0c234a] mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-amber-500"></i>
                                متطلبات الخدمة
                            </h3>
                            <ul class="list-disc list-inside space-y-1.5 text-xs sm:text-sm text-neutral-700">
                                <li>توضيح المساحة الحالية للمطبخ بالرسم.</li>
                                <li>تحديد أماكن الأبواب والنوافذ.</li>
                                <li>تحديد مواقع توصيلات الكهرباء والمياه.</li>
                                <li>تحديد أماكن الأجهزة والمعدات بالمطبخ.</li>
                                <li>تقديم الملفات بصيغة صورة أو PDF واضحة ومقروءة.</li>
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- 2. Specifications Tab -->
                <div id="tab-specs" class="tab-content-panel hidden">
                    <div class="overflow-hidden rounded-2xl border border-neutral-200">
                        <table class="w-full text-start text-xs sm:text-sm">
                            <tbody class="divide-y divide-neutral-200">
                                @if ($detailedProduct->stocks->first() && $detailedProduct->stocks->first()->sku)
                                    <tr class="bg-neutral-50/60">
                                        <th class="py-3 px-4 font-bold text-[#0c234a] w-1/3">{{ translate('SKU') }}</th>
                                        <td class="py-3 px-4 text-neutral-700 font-mono">{{ $detailedProduct->stocks->first()->sku }}</td>
                                    </tr>
                                @endif
                                @if ($detailedProduct->weight)
                                    <tr class="bg-white">
                                        <th class="py-3 px-4 font-bold text-[#0c234a] w-1/3">{{ translate('weight') }}</th>
                                        <td class="py-3 px-4 text-neutral-700">{{ $detailedProduct->weight }} {{ translate('kg') }}</td>
                                    </tr>
                                @endif
                                @if ($detailedProduct->unit)
                                    <tr class="bg-neutral-50/60">
                                        <th class="py-3 px-4 font-bold text-[#0c234a] w-1/3">{{ translate('unit') }}</th>
                                        <td class="py-3 px-4 text-neutral-700">{{ $detailedProduct->unit }}</td>
                                    </tr>
                                @endif
                                <tr class="bg-white">
                                    <th class="py-3 px-4 font-bold text-[#0c234a] w-1/3">{{ translate('material') }}</th>
                                    <td class="py-3 px-4 text-neutral-700">
                                        @if ($detailedProduct->is_stainless)
                                            <span class="font-bold text-emerald-600">ستانلس ستيل عالي الجودة</span>
                                        @else
                                            {{ translate('Standard') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr class="bg-neutral-50/60">
                                    <th class="py-3 px-4 font-bold text-[#0c234a] w-1/3">بلد الصنع</th>
                                    <td class="py-3 px-4 text-neutral-700">المملكة العربية السعودية 🇸🇦</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 3. Shipping & Delivery Tab -->
                <div id="tab-shipping" class="tab-content-panel hidden space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200">
                            <h4 class="text-sm font-bold text-[#0c234a] mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-truck-fast text-[#4868e6]"></i>
                                التوصيل السريع لكافة مدن المملكة
                            </h4>
                            <p class="text-xs text-neutral-600 leading-relaxed mb-0">
                                يتم توصيل وتجهيز طلبات المعدات التجارية خلال 2-5 أيام عمل مع خيارات الشحن الآمن والتركيب المباشر من قبل فريقنا المختص.
                            </p>
                        </div>
                        <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200">
                            <h4 class="text-sm font-bold text-[#0c234a] mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-shield-check text-[#4868e6]"></i>
                                الضمان والصيانة
                            </h4>
                            <p class="text-xs text-neutral-600 leading-relaxed mb-0">
                                تشمل جميع معداتنا ضماناً شاملاً ضد عيوب التصنيع مع توفير قطع الغيار الأصلية والدعم الفني المباشر.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        function changeMainImage(url, el) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg && url) {
                mainImg.src = url;
            }
            document.querySelectorAll('.thumb-btn').forEach(b => {
                b.classList.remove('border-[#4868e6]', 'border-2');
                b.classList.add('border-neutral-200', 'border');
            });
            if (el) {
                el.classList.remove('border-neutral-200', 'border');
                el.classList.add('border-[#4868e6]', 'border-2');
            }
        }

        function switchTab(tabId, el) {
            document.querySelectorAll('.tab-content-panel').forEach(panel => panel.classList.add('hidden'));
            document.querySelectorAll('.tab-trigger').forEach(btn => {
                btn.classList.remove('bg-[#4868e6]', 'text-white', 'shadow-xs');
                btn.classList.add('text-neutral-600');
            });

            const targetPanel = document.getElementById(tabId);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }
            if (el) {
                el.classList.remove('text-neutral-600');
                el.classList.add('bg-[#4868e6]', 'text-white', 'shadow-xs');
            }
        }
    </script>
@endsection
