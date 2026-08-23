@extends('frontend.layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $localeMap = ['ar' => 'sa', 'zh' => 'cn'];
        $prefixLocale = $localeMap[$locale] ?? $locale;

        $localizedSliders = $sliders->filter(function ($slider) use ($prefixLocale) {
            return str_starts_with($slider->file_original_name ?? '', $prefixLocale . '-');
        });
        $localizedSliders2 = $sliders2->filter(function ($slider) use ($prefixLocale) {
            return str_starts_with($slider->file_original_name ?? '', $prefixLocale . '-');
        });

        $summerLinks = [
            route('products.category', 'ice-cream-makers-p8yjs'),
            route('products.category', 'beverage-equipment-5zoca'),
            route('products.category', 'ice-cream-display-refrigerators-g7b8h'),
        ];

        $firstFourBestSelling = $best_selling_products->slice(0, 4);
        $secondFourBestSelling = $best_selling_products->slice(4, 4);
        if ($secondFourBestSelling->isEmpty() && $new_products->isNotEmpty()) {
            $secondFourBestSelling = $new_products->slice(0, 4);
        }
    @endphp

    {{-- 1. Hero Promo Banner (Matching Screenshot 1) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-6">
        @if ($localizedSliders->count() > 0)
            <div class="overflow-hidden rounded-2xl shadow-xs">
                <x-carousel :options="['loop' => $localizedSliders->count() > 1, 'autoplay' => $localizedSliders->count() > 1 ? ['delay' => 5000] : false]">
                    @foreach ($localizedSliders as $key => $slider)
                        <div class="swiper-slide">
                            <a href="{{ $sliderLinks[$key] ?? '#' }}" class="block">
                                <img src="{{ static_asset($slider->file_name) }}"
                                    class="h-60 sm:h-80 lg:h-[380px] w-full rounded-2xl object-cover"
                                    alt="{{ get_setting('website_name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}';">
                            </a>
                        </div>
                    @endforeach
                </x-carousel>
            </div>
        @else
            {{-- Default Designed Hero Banner --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#d8eaf8] via-[#e6f2fc] to-[#bde0f8] p-6 sm:p-10 shadow-xs">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <!-- Text & Badge -->
                    <div class="lg:col-span-6 text-start z-10">
                        <span class="inline-block rounded-full bg-[#4868e6]/15 text-[#4868e6] px-3.5 py-1 text-xs font-extrabold mb-3">
                            موسم الصيف
                        </span>
                        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-[#0c234a] leading-tight mb-2">
                            ثلاجات عرض عامودية
                        </h1>
                        <p class="text-sm sm:text-base font-semibold text-neutral-600 mb-6">
                            استعد للصيف بأقوى المعدات التجارية
                        </p>
                        <a href="{{ route('search') }}" class="yellow-cta-btn text-sm sm:text-base px-8 py-2.5 no-underline">
                            تسوق الآن
                        </a>
                    </div>

                    <!-- Promo Image with discount badge -->
                    <div class="lg:col-span-6 relative flex items-center justify-center">
                        <span class="absolute top-0 start-4 sm:start-10 z-10 flex size-14 sm:size-18 flex-col items-center justify-center rounded-full bg-[#4868e6] text-white shadow-md text-center p-1">
                            <span class="text-[10px] sm:text-xs font-bold leading-none">خصم حتى</span>
                            <span class="text-sm sm:text-lg font-black leading-none mt-0.5">15%</span>
                        </span>
                        <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                            class="h-56 sm:h-72 lg:h-80 w-full object-contain rounded-xl drop-shadow-md"
                            alt="Summer Promo"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- 2. Categories Pedestal Section: "تسوق معدات مطاعم ومقاهي بأفضل الأسعار" (Matching Screenshot 1) --}}
    @if ($main_categories->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            <h2 class="mb-8 text-center text-xl sm:text-2xl font-black text-[#0c234a]">
                تسوق معدات مطاعم ومقاهي بأفضل الأسعار
            </h2>

            <x-carousel :options="[
                'slidesPerView' => 2.5,
                'spaceBetween' => 16,
                'breakpoints' => [
                    '480' => ['slidesPerView' => 3.5, 'spaceBetween' => 16],
                    '640' => ['slidesPerView' => 4.5, 'spaceBetween' => 18],
                    '768' => ['slidesPerView' => 5.5, 'spaceBetween' => 20],
                    '1024' => ['slidesPerView' => 7, 'spaceBetween' => 20],
                ],
            ]">
                @foreach ($main_categories as $category)
                    <div class="swiper-slide">
                        <a href="{{ route('products.category', $category->slug) }}" class="category-pedestal-card">
                            <div class="category-pedestal-base mb-3">
                                <img src="{{ $category->bannerImage ? my_asset($category->bannerImage->file_name) : ($category->icon ? uploaded_asset($category->icon) : static_asset('assets/img/placeholder.jpg')) }}"
                                    class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300"
                                    alt="{{ $category->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </div>
                            <p class="line-clamp-2 text-xs sm:text-sm font-bold text-neutral-800 transition hover:text-[#4868e6]">
                                {{ $category->getTranslation('name') }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- 3. Solutions Section: "حلول تجهيز المطاعم والمطابخ التجارية" (Matching Screenshot 1 & 2) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <h2 class="mb-8 text-center text-xl sm:text-2xl font-black text-[#0c234a]">
            حلول تجهيز المطاعم والمطابخ التجارية
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card 1: ثلاجات أجبان ولحوم -->
            <a href="{{ route('search') }}?keyword=ثلاجات" class="solution-equip-card group">
                <h3 class="text-base sm:text-lg font-black text-[#0c234a]">ثلاجات أجبان ولحوم</h3>
                <div class="my-3 flex h-36 sm:h-44 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product2.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-sm transition duration-300 group-hover:scale-105"
                        alt="ثلاجات أجبان ولحوم"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn">اشترِ الآن</span>
            </a>

            <!-- Card 2: مكائن آيس كريم -->
            <a href="{{ route('search') }}?keyword=آيس+كريم" class="solution-equip-card group">
                <h3 class="text-base sm:text-lg font-black text-[#0c234a]">مكائن آيس كريم</h3>
                <div class="my-3 flex h-36 sm:h-44 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-sm transition duration-300 group-hover:scale-105"
                        alt="مكائن آيس كريم"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn">اشترِ الآن</span>
            </a>

            <!-- Card 3: ثلاجات تحضير البيتزا -->
            <a href="{{ route('search') }}?keyword=بيتزا" class="solution-equip-card group">
                <h3 class="text-base sm:text-lg font-black text-[#0c234a]">ثلاجات تحضير البيتزا</h3>
                <div class="my-3 flex h-36 sm:h-44 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-sm transition duration-300 group-hover:scale-105"
                        alt="ثلاجات تحضير البيتزا"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn">اشترِ الآن</span>
            </a>

            <!-- Card 4: مكائن قهوة اليوم -->
            <a href="{{ route('search') }}?keyword=قهوة" class="solution-equip-card group">
                <h3 class="text-base sm:text-lg font-black text-[#0c234a]">مكائن قهوة اليوم</h3>
                <div class="my-3 flex h-36 sm:h-44 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product1.jpg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-sm transition duration-300 group-hover:scale-105"
                        alt="مكائن قهوة اليوم"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn">اشترِ الآن</span>
            </a>
        </div>
    </section>

    {{-- 4. Best Sellers Section: "المنتجات الأكثر مبيعًا" (Matching Screenshot 2) --}}
    @if ($best_selling_products->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            <h2 class="mb-8 text-center text-xl sm:text-2xl font-black text-[#0c234a]">
                المنتجات الأكثر مبيعًا
            </h2>

            {{-- Row 1: 4 Products + Side Blue Banner --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-6 items-stretch mb-6">
                <!-- 4 Product Cards Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 lg:col-span-4">
                    @foreach ($firstFourBestSelling as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <!-- Side Blue Promo Card 1 -->
                <div class="lg:col-span-1 bg-[#4868e6] rounded-2xl p-5 text-white flex flex-col items-center justify-between text-center shadow-xs min-h-[360px]">
                    <div>
                        <h4 class="text-xl sm:text-2xl font-black text-[#fee028]">أسعار منافسة</h4>
                        <p class="text-white text-xs sm:text-sm font-semibold opacity-90 mt-1">لثلاجات عرض الحلويات</p>
                    </div>
                    <div class="my-4 flex items-center justify-center">
                        <img src="{{ static_asset('assets/front_img/sa-summer-product2.jpeg') }}"
                            class="max-h-48 w-full object-contain drop-shadow-md rounded-lg"
                            alt="ثلاجات عرض الحلويات"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                    </div>
                    <a href="{{ route('search') }}" class="yellow-cta-btn w-full text-center no-underline">
                        تسوق الآن
                    </a>
                </div>
            </div>

            {{-- Row 2: 4 Products + Side Blue Banner 2 --}}
            @if ($secondFourBestSelling->isNotEmpty())
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-6 items-stretch">
                    <!-- 4 Product Cards Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 lg:col-span-4">
                        @foreach ($secondFourBestSelling as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Side Blue Promo Card 2 -->
                    <div class="lg:col-span-1 bg-[#4868e6] rounded-2xl p-5 text-white flex flex-col items-center justify-between text-center shadow-xs min-h-[360px]">
                        <div>
                            <h4 class="text-xl sm:text-2xl font-black text-[#fee028]">تلبي احتياجك</h4>
                            <p class="text-white text-xs sm:text-sm font-semibold opacity-90 mt-1">عجانات كهربائية ومعدات تحضير</p>
                        </div>
                        <div class="my-4 flex items-center justify-center">
                            <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                                class="max-h-48 w-full object-contain drop-shadow-md rounded-lg"
                                alt="عجانات كهربائية"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                        <a href="{{ route('search') }}" class="yellow-cta-btn w-full text-center no-underline">
                            تسوق الآن
                        </a>
                    </div>
                </div>
            @endif
        </section>
    @endif

    {{-- 5. Bento Grid Projects: "تصفح حسب المشروع" (Matching Screenshot 3) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <h2 class="mb-8 text-center text-xl sm:text-2xl font-black text-[#0c234a]">
            تصفح حسب المشروع
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-stretch">
            <!-- 2x2 Grid of Projects on the Right (in RTL, 6 columns) -->
            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                <!-- Project 1: معدات مطابخ مركزية -->
                <a href="{{ route('search') }}?keyword=مطابخ+مركزية" class="group relative overflow-hidden rounded-2xl shadow-xs h-44 sm:h-52 block no-underline">
                    <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        alt="معدات مطابخ مركزية"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end p-4">
                        <span class="text-white text-sm sm:text-base font-bold">معدات مطابخ مركزية</span>
                    </div>
                </a>

                <!-- Project 2: تجهيز سوبرماركت -->
                <a href="{{ route('search') }}?keyword=سوبرماركت" class="group relative overflow-hidden rounded-2xl shadow-xs h-44 sm:h-52 block no-underline">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        alt="تجهيز سوبرماركت"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end p-4">
                        <span class="text-white text-sm sm:text-base font-bold">تجهيز سوبرماركت</span>
                    </div>
                </a>

                <!-- Project 3: تجهيز مخبز -->
                <a href="{{ route('search') }}?keyword=مخبز" class="group relative overflow-hidden rounded-2xl shadow-xs h-44 sm:h-52 block no-underline">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product1.jpg') }}"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        alt="تجهيز مخبز"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end p-4">
                        <span class="text-white text-sm sm:text-base font-bold">تجهيز مخبز</span>
                    </div>
                </a>

                <!-- Project 4: معدات كاترينج -->
                <a href="{{ route('search') }}?keyword=كاترينج" class="group relative overflow-hidden rounded-2xl shadow-xs h-44 sm:h-52 block no-underline">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product2.jpeg') }}"
                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        alt="معدات كاترينج"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end p-4">
                        <span class="text-white text-sm sm:text-base font-bold">معدات كاترينج</span>
                    </div>
                </a>
            </div>

            <!-- Big Feature Card on the Left (6 columns) -->
            <div class="lg:col-span-6 relative overflow-hidden rounded-2xl shadow-xs min-h-[360px] lg:min-h-full">
                <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                    class="absolute inset-0 h-full w-full object-cover"
                    alt="60 عام نساهم في دعم قطاع الضيافة"
                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent flex flex-col justify-end p-6 sm:p-8 text-white">
                    <div class="text-4xl sm:text-5xl font-black mb-1 text-white">60 عام</div>
                    <div class="text-lg sm:text-xl font-bold opacity-95">نساهم في دعم وتطوير قطاع الضيافة والمطاعم</div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. Latest Offers: "اكتشف أحدث العروض" (Matching Screenshot 3) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <h2 class="mb-8 text-center text-xl sm:text-2xl font-black text-[#0c234a]">
            اكتشف أحدث العروض
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
            <!-- Offer 1: خلاطات حلويات -->
            <a href="{{ route('search') }}?keyword=خلاطات" class="blue-offer-card group">
                <div>
                    <h3 class="text-sm sm:text-base font-black text-white">خلاطات حلويات</h3>
                    <span class="mt-1 inline-block text-[11px] font-bold text-white/80">خصم حتى 20%</span>
                </div>
                <div class="my-3 flex h-28 sm:h-36 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="خلاطات حلويات"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn text-xs py-1.5 px-4 w-full text-center">تسوق الآن</span>
            </a>

            <!-- Offer 2: قلايات تجارية -->
            <a href="{{ route('search') }}?keyword=قلايات" class="blue-offer-card group">
                <div>
                    <h3 class="text-sm sm:text-base font-black text-white">قلايات تجارية</h3>
                    <span class="mt-1 inline-block text-[11px] font-bold text-white/80">خصم حتى 20%</span>
                </div>
                <div class="my-3 flex h-28 sm:h-36 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product1.jpg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="قلايات تجارية"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn text-xs py-1.5 px-4 w-full text-center">تسوق الآن</span>
            </a>

            <!-- Offer 3: أفران هوائية -->
            <a href="{{ route('search') }}?keyword=أفران" class="blue-offer-card group">
                <div>
                    <h3 class="text-sm sm:text-base font-black text-white">أفران هوائية</h3>
                    <span class="mt-1 inline-block text-[11px] font-bold text-white/80">خصم حتى 15%</span>
                </div>
                <div class="my-3 flex h-28 sm:h-36 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product2.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="أفران هوائية"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn text-xs py-1.5 px-4 w-full text-center">تسوق الآن</span>
            </a>

            <!-- Offer 4: ثلاجة باك بار -->
            <a href="{{ route('search') }}?keyword=باك+بار" class="blue-offer-card group">
                <div>
                    <h3 class="text-sm sm:text-base font-black text-white">ثلاجة باك بار</h3>
                    <span class="mt-1 inline-block text-[11px] font-bold text-white/80">خصم حتى 15%</span>
                </div>
                <div class="my-3 flex h-28 sm:h-36 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="ثلاجة باك بار"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn text-xs py-1.5 px-4 w-full text-center">تسوق الآن</span>
            </a>

            <!-- Offer 5: فريزرات -->
            <a href="{{ route('search') }}?keyword=فريزر" class="blue-offer-card group">
                <div>
                    <h3 class="text-sm sm:text-base font-black text-white">فريزرات</h3>
                    <span class="mt-1 inline-block text-[11px] font-bold text-white/80">خصم حتى 15%</span>
                </div>
                <div class="my-3 flex h-28 sm:h-36 w-full items-center justify-center">
                    <img src="{{ static_asset('assets/front_img/sa-summer-product.jpeg') }}"
                        class="max-h-full max-w-full object-contain drop-shadow-md transition duration-300 group-hover:scale-105"
                        alt="فريزرات"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
                <span class="yellow-cta-btn text-xs py-1.5 px-4 w-full text-center">تسوق الآن</span>
            </a>
        </div>
    </section>

    @include('frontend.partials.cart.cart_summary_toast')
@endsection
