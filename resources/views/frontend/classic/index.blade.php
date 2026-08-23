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

        $stainlessFirstFour = $stainless_steel_products->slice(0, 2);
        $stainlessLastFour = $stainless_steel_products->slice(2, 2);
    @endphp

    {{-- Hero: main promo slider + grill/side banner (2:1 split) --}}
    @if ($localizedSliders->count() > 0 || $grill_banner)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-6 items-stretch">
                <div class="overflow-hidden rounded-2xl shadow-sm lg:col-span-2">
                    @if ($localizedSliders->count() > 0)
                        <div class="hidden md:block">
                            <x-carousel :options="['loop' => $localizedSliders->count() > 1, 'autoplay' => $localizedSliders->count() > 1 ? ['delay' => 5000] : false]">
                                @foreach ($localizedSliders as $key => $slider)
                                    <div class="swiper-slide">
                                        <a href="{{ $sliderLinks[$key] ?? '#' }}" class="block">
                                            <img src="{{ static_asset($slider->file_name) }}"
                                                class="h-60 w-full rounded-2xl object-cover sm:h-80 lg:h-[380px]"
                                                alt="{{ get_setting('website_name') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                    </div>
                                @endforeach
                            </x-carousel>
                        </div>
                    @endif
                    @if ($localizedSliders2->count() > 0)
                        <div class="md:hidden">
                            <x-carousel :options="['loop' => $localizedSliders2->count() > 1, 'autoplay' => $localizedSliders2->count() > 1 ? ['delay' => 5000] : false]">
                                @foreach ($localizedSliders2 as $key => $slider)
                                    <div class="swiper-slide">
                                        <a href="{{ $sliderLinks2[$key] ?? '#' }}" class="block">
                                            <img src="{{ static_asset($slider->file_name) }}"
                                                class="h-56 w-full rounded-2xl object-cover sm:h-72"
                                                alt="{{ get_setting('website_name') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                    </div>
                                @endforeach
                            </x-carousel>
                        </div>
                    @endif
                </div>

                @if ($grill_banner)
                    <div class="overflow-hidden rounded-2xl shadow-sm lg:col-span-1">
                        <a href="{{ $grill_link[0] ?? '#' }}" class="block h-full group">
                            <img src="{{ static_asset($grill_banner?->file_name) }}"
                                class="h-56 w-full rounded-2xl object-cover sm:h-72 lg:h-[380px] transition duration-300 group-hover:opacity-95" alt="">
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- أهم التصنيفات --}}
    @if ($main_categories->where('featured', 1)->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('Categories') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <x-carousel :options="[
                'slidesPerView' => 3.2,
                'spaceBetween' => 14,
                'breakpoints' => [
                    '480' => ['slidesPerView' => 4.2, 'spaceBetween' => 16],
                    '640' => ['slidesPerView' => 5.2, 'spaceBetween' => 16],
                    '768' => ['slidesPerView' => 6.2, 'spaceBetween' => 18],
                    '1024' => ['slidesPerView' => 8, 'spaceBetween' => 20],
                ],
            ]">
                @foreach ($main_categories as $category)
                    @if ($category->featured == 1)
                        <div class="swiper-slide">
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="group flex flex-col items-center gap-2.5 text-center no-underline">
                                <span class="flex size-20 sm:size-24 items-center justify-center overflow-hidden rounded-full border border-neutral-200 bg-white p-2.5 shadow-sm transition duration-300 group-hover:border-primary group-hover:shadow-md group-hover:scale-105">
                                    <img src="{{ $category->bannerImage ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="h-full w-full object-contain" alt="{{ $category->getTranslation('name') }}">
                                </span>
                                <p class="line-clamp-2 text-xs sm:text-sm font-semibold text-neutral-700 transition group-hover:text-primary">
                                    {{ $category->getTranslation('name') }}
                                </p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- منتجات موسم الصيف --}}
    @if ($summer_banners && count($summer_banners))
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('summer_season_products') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:gap-6">
                @foreach ($summer_banners as $banner)
                    <a href="{{ $summerLinks[$loop->index] ?? '#' }}" class="group block overflow-hidden rounded-2xl shadow-sm transition duration-300 hover:shadow-md hover:-translate-y-1">
                        <img src="{{ static_asset($banner) }}" class="h-48 sm:h-56 md:h-64 lg:h-72 w-full object-cover transition duration-300 group-hover:scale-102"
                            alt="Summer banner {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- الأكثر مبيعاً --}}
    @if (count($best_selling_products) >= 6)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('best_selling') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-6 items-stretch">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 lg:col-span-3">
                    @foreach ($best_selling_products->take(6) as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU"
                    class="hidden overflow-hidden rounded-2xl shadow-sm transition duration-300 hover:shadow-md hover:opacity-95 lg:block lg:col-span-1">
                    <img src="{{ static_asset('assets/front_img/bestseller-' . app()->getLocale() . '.jpg') }}"
                        alt="Best Selling Banner" class="h-full w-full object-cover rounded-2xl min-h-[380px]">
                </a>
            </div>
        </section>
    @endif

    {{-- عروض الأسبوع --}}
    @if (count($deal_of_the_week) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('Deal of The Week') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <x-carousel :options="[
                'slidesPerView' => 1.5,
                'spaceBetween' => 12,
                'breakpoints' => [
                    '480' => ['slidesPerView' => 2, 'spaceBetween' => 14],
                    '640' => ['slidesPerView' => 3, 'spaceBetween' => 16],
                    '1024' => ['slidesPerView' => 4, 'spaceBetween' => 18],
                    '1280' => ['slidesPerView' => 5, 'spaceBetween' => 20],
                ],
            ]">
                @foreach ($deal_of_the_week as $product)
                    <div class="swiper-slide h-auto">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- وصل حديثاً --}}
    @if (count($new_products) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('New Arrivals') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <x-carousel :options="[
                'slidesPerView' => 1.5,
                'spaceBetween' => 12,
                'breakpoints' => [
                    '480' => ['slidesPerView' => 2, 'spaceBetween' => 14],
                    '640' => ['slidesPerView' => 3, 'spaceBetween' => 16],
                    '1024' => ['slidesPerView' => 4, 'spaceBetween' => 18],
                    '1280' => ['slidesPerView' => 5, 'spaceBetween' => 20],
                ],
            ]">
                @foreach ($new_products as $product)
                    <div class="swiper-slide h-auto">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- الاستانلس استيل --}}
    @if (count($stainless_steel_products) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    @if (app()->getLocale() == 'sa')
                        ستانلس ستيل
                    @elseif(app()->getLocale() == 'cn')
                        钢材
                    @else
                        Stainless Steel
                    @endif
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-6 items-stretch">
                <div class="overflow-hidden rounded-2xl shadow-sm lg:col-span-2">
                    @if (app()->getLocale() == 'sa')
                        <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU" class="block h-full">
                            <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                                class="h-60 w-full object-cover sm:h-80 lg:h-[400px] rounded-2xl">
                        </a>
                    @elseif(app()->getLocale() == 'cn')
                        <img src="{{ static_asset('assets/front_img/stainless-cn.jpg') }}"
                            class="h-60 w-full object-cover sm:h-80 lg:h-[400px] rounded-2xl">
                    @else
                        <img src="{{ static_asset('assets/front_img/stainless-en.jpg') }}"
                            class="h-60 w-full object-cover sm:h-80 lg:h-[400px] rounded-2xl">
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:col-span-1">
                    @foreach ($stainlessFirstFour->concat($stainlessLastFour) as $product)
                        <a href="{{ route('product', $product->slug) }}"
                            class="group flex aspect-square items-center justify-center rounded-2xl border border-neutral-200 bg-white p-3 shadow-sm transition duration-300 hover:border-primary hover:shadow-md hover:-translate-y-0.5">
                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                class="max-h-full max-w-full object-contain transition duration-300 group-hover:scale-105" alt="{{ $product->getTranslation('name') }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- شركاء النجاح --}}
    @if (count($partners) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('partners') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <x-carousel :options="[
                'slidesPerView' => 2.5,
                'spaceBetween' => 16,
                'breakpoints' => [
                    '480' => ['slidesPerView' => 3.5],
                    '640' => ['slidesPerView' => 4.5],
                    '992' => ['slidesPerView' => 6],
                ],
            ]">
                @foreach ($partners as $partner)
                    <div class="swiper-slide flex items-center justify-center p-3">
                        <div class="flex h-24 w-full items-center justify-center rounded-xl border border-neutral-200 bg-white p-3 shadow-sm transition hover:shadow-md">
                            <img src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}"
                                class="max-h-16 max-w-full object-contain">
                        </div>
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- Brands --}}
    @if (count($brands) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">
                    {{ translate('Brands') }}
                </h2>
                <div class="mx-auto mt-2 h-1 w-12 rounded-full bg-primary"></div>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                @foreach ($brands as $brand)
                    <div class="flex size-20 sm:size-24 items-center justify-center rounded-2xl border border-neutral-200 bg-white p-3 shadow-sm transition duration-300 hover:border-primary hover:shadow-md hover:scale-105">
                        <img src="{{ $brand->logo ? uploaded_asset($brand->logo) : static_asset('assets/img/placeholder.jpg') }}"
                            class="max-h-full max-w-full object-contain">
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @include('frontend.partials.cart.cart_summary_toast')
@endsection
