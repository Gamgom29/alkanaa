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

    {{-- Hero: main promo slider + grill/side banner, matching the reference
        layout's 2:1 hero split. Desktop and mobile keep their own
        admin-managed image sets ($sliders / $sliders2), switched with plain
        Tailwind display utilities instead of the unreadable .pc/.mob
        classes the old markup depended on. --}}
    @if ($localizedSliders->count() > 0 || $grill_banner)
        <section class="px-4 py-6 md:px-6">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="overflow-hidden rounded-xl lg:col-span-2">
                    @if ($localizedSliders->count() > 0)
                        <div class="hidden md:block">
                            <x-carousel :options="['loop' => $localizedSliders->count() > 1, 'autoplay' => $localizedSliders->count() > 1 ? ['delay' => 5000] : false]">
                                @foreach ($localizedSliders as $key => $slider)
                                    <div class="swiper-slide">
                                        <a href="{{ $sliderLinks[$key] ?? '#' }}" class="block">
                                            <img src="{{ static_asset($slider->file_name) }}"
                                                class="h-55 w-full rounded-xl object-cover md:h-80 lg:h-95"
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
                                                class="h-55 w-full rounded-xl object-cover"
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
                    <a href="{{ $grill_link[0] ?? '#' }}" class="block overflow-hidden rounded-xl">
                        <img src="{{ static_asset($grill_banner?->file_name) }}"
                            class="h-55 w-full object-cover md:h-80 lg:h-full" alt="">
                    </a>
                @endif
            </div>
        </section>
    @endif

    {{-- اهم التصنيفات --}}
    @if ($main_categories->where('featured', 1)->count() > 0)
        <section class="px-4 py-4 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('Categories') }}
            </h2>
            <x-carousel :options="[
                'slidesPerView' => 3,
                'spaceBetween' => 12,
                'breakpoints' => ['576' => ['slidesPerView' => 5], '992' => ['slidesPerView' => 8]],
            ]">
                @foreach ($main_categories as $category)
                    @if ($category->featured == 1)
                        <div class="swiper-slide w-24! sm:w-28!">
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="flex flex-col items-center gap-2 text-center no-underline">
                                <span class="flex size-20 items-center justify-center overflow-hidden rounded-full border border-neutral-200 bg-white p-2 shadow-sm transition group-hover:shadow-md sm:size-24">
                                    <img src="{{ $category->bannerImage ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="h-full w-full object-contain" alt="{{ $category->getTranslation('name') }}">
                                </span>
                                <p class="line-clamp-2 text-xs font-medium text-neutral-700">
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
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('summer_season_products') }}
            </h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($summer_banners as $banner)
                    <a href="{{ $summerLinks[$loop->index] ?? '#' }}" class="block overflow-hidden rounded-xl">
                        <img src="{{ static_asset($banner) }}" class="h-full w-full object-cover"
                            alt="Summer banner {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- الاكثر مبيعاً --}}
    @if (count($best_selling_products) >= 6)
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('best_selling') }}
            </h2>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:col-span-3">
                    @foreach ($best_selling_products->take(6) as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                {{-- TODO(Phase 3): this side-banner href is a hardcoded staging
                    URL inherited from the previous markup — needs a real
                    destination, not something to invent here. --}}
                <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU"
                    class="hidden overflow-hidden rounded-xl lg:block">
                    <img src="{{ static_asset('assets/front_img/bestseller-' . app()->getLocale() . '.jpg') }}"
                        alt="Best Selling Banner" class="h-full w-full object-cover">
                </a>
            </div>
        </section>
    @endif

    {{-- عروض الأسبوع --}}
    @if (count($deal_of_the_week) > 0)
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('Deal of The Week') }}
            </h2>
            <x-carousel :options="[
                'slidesPerView' => 2,
                'spaceBetween' => 12,
                'breakpoints' => ['576' => ['slidesPerView' => 3], '992' => ['slidesPerView' => 5]],
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
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('New Arrivals') }}
            </h2>
            <x-carousel :options="[
                'slidesPerView' => 2,
                'spaceBetween' => 12,
                'breakpoints' => ['576' => ['slidesPerView' => 3], '992' => ['slidesPerView' => 5]],
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
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                @if (app()->getLocale() == 'sa')
                    ستانلس ستيل
                @elseif(app()->getLocale() == 'cn')
                    钢材
                @else
                    Stainless Steel
                @endif
            </h2>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="overflow-hidden rounded-xl lg:col-span-2">
                    @if (app()->getLocale() == 'sa')
                        <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU">
                            <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                                class="h-55 w-full object-cover md:h-75 lg:h-102.75">
                        </a>
                    @elseif(app()->getLocale() == 'cn')
                        <img src="{{ static_asset('assets/front_img/stainless-cn.jpg') }}"
                            class="h-55 w-full object-cover md:h-75 lg:h-102.75">
                    @else
                        <img src="{{ static_asset('assets/front_img/stainless-en.jpg') }}"
                            class="h-55 w-full object-cover md:h-75 lg:h-102.75">
                    @endif
                </div>
                <div class="grid grid-cols-4 gap-3 lg:grid-cols-2">
                    @foreach ($stainlessFirstFour->concat($stainlessLastFour) as $product)
                        <a href="{{ route('product', $product->slug) }}"
                            class="flex aspect-square items-center justify-center rounded-lg border border-neutral-200 bg-white p-2">
                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                class="max-h-full max-w-full object-contain" alt="{{ $product->getTranslation('name') }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- شركاء النجاح --}}
    @if (count($partners) > 0)
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('partners') }}
            </h2>
            <x-carousel :options="[
                'slidesPerView' => 3,
                'spaceBetween' => 16,
                'breakpoints' => ['576' => ['slidesPerView' => 5], '992' => ['slidesPerView' => 6]],
            ]">
                @foreach ($partners as $partner)
                    <div class="swiper-slide flex items-center justify-center p-3">
                        <img src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}"
                            class="max-h-20 max-w-30 object-contain">
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    {{-- Brands --}}
    @if (count($brands) > 0)
        <section class="px-4 py-6 md:px-6">
            <h2 class="mb-4 text-center text-xl font-extrabold text-neutral-900 after:mx-auto after:mt-2 after:block after:h-1 after:w-12 after:rounded-full after:bg-primary">
                {{ translate('Brands') }}
            </h2>
            <div class="flex flex-wrap items-center justify-center gap-4">
                @foreach ($brands as $brand)
                    <div class="flex size-24 items-center justify-center rounded-lg border border-neutral-200 bg-white p-2">
                        <img src="{{ $brand->logo ? uploaded_asset($brand->logo) : static_asset('assets/img/placeholder.jpg') }}"
                            class="max-h-full max-w-full object-contain">
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @include('frontend.partials.cart.cart_summary_toast')
@endsection
