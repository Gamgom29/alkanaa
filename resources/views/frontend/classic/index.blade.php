@extends('frontend.layouts.app')


@section('content')
    @php
        $locale = app()->getLocale();
        $localeMap = ['ar' => 'sa', 'zh' => 'cn'];
        $prefixLocale = $localeMap[$locale] ?? $locale;
        $localizedSliders = $sliders->filter(function ($slider) use ($prefixLocale) {
            return str_starts_with($slider->file_original_name ?? '', $prefixLocale . '-');
        })->values();
        $localizedSliders2 = $sliders2->filter(function ($slider) use ($prefixLocale) {
            return str_starts_with($slider->file_original_name ?? '', $prefixLocale . '-');
        })->values();
        $sideBanner2 = $localizedSliders2->first();
        $sideBanner2Link = $sliderLinks2[$localizedSliders2->keys()->first()] ?? '#';
    @endphp

    @if ($localizedSliders->count() > 0)
        <section class="px-4 md:px-6 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 rounded-xl overflow-hidden">
                    <x-carousel :options="['loop' => $localizedSliders->count() > 1, 'autoplay' => $localizedSliders->count() > 1 ? ['delay' => 5000] : false]">
                        @foreach ($localizedSliders as $key => $slider)
                            <div class="swiper-slide">
                                <a href="{{ $sliderLinks[$key] ?? '#' }}" class="block">
                                    <img src="{{ static_asset($slider->file_name) }}" class="w-full h-full object-cover rounded-xl" alt="{{ get_setting('website_name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </a>
                            </div>
                        @endforeach
                    </x-carousel>
                </div>

                <div class="flex flex-col gap-4">
                    @if ($grill_banner)
                        <a href="{{ $grill_link ?? '#' }}" class="block flex-1 rounded-xl overflow-hidden">
                            <img src="{{ static_asset($grill_banner->file_name) }}" class="w-full h-full object-cover" alt="{{ get_setting('website_name') }}">
                        </a>
                    @endif
                    @if ($sideBanner2)
                        <a href="{{ $sideBanner2Link }}" class="block flex-1 rounded-xl overflow-hidden">
                            <img src="{{ static_asset($sideBanner2->file_name) }}" class="w-full h-full object-cover" alt="{{ get_setting('website_name') }}">
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- اهم التصنيفات --}}
    <section class="px-4 md:px-6 py-4">
        <div class="relative">
            <x-carousel :options="['slidesPerView' => 3, 'spaceBetween' => 12, 'breakpoints' => ['640' => ['slidesPerView' => 5], '1024' => ['slidesPerView' => 8]]]">
                @foreach ($main_categories as $category)
                    @if ($category->featured == 1)
                        <div class="swiper-slide">
                            <a href="{{ route('products.category', $category->slug) }}" class="flex flex-col items-center gap-2 text-center no-underline">
                                <div class="size-20 rounded-full border border-neutral-200 bg-white p-2 shadow-sm">
                                    <img src="{{ $category->bannerImage ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="h-full w-full object-contain" alt="{{ $category->getTranslation('name') }}">
                                </div>
                                <p class="text-xs font-medium text-neutral-700 line-clamp-2">{{ $category->getTranslation('name') }}</p>
                            </a>
                        </div>
                    @endif
                @endforeach
            </x-carousel>
        </div>
    </section>

    {{-- منتجات موسم الصيف --}}
    @if ($summer_banners && count($summer_banners))
        <section class="px-4 md:px-6 py-6">
            <h2 class="text-center text-xl font-extrabold text-neutral-900 mb-4">{{ translate('summer_season_products') }}</h2>
            @php
                $summer_links = [
                    route('products.category', 'ice-cream-makers-p8yjs'),
                    route('products.category', 'beverage-equipment-5zoca'),
                    route('products.category', 'ice-cream-display-refrigerators-g7b8h'),
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($summer_banners as $banner)
                    <a href="{{ $summer_links[$loop->index] ?? '#' }}" class="block rounded-xl overflow-hidden">
                        <img src="{{ static_asset($banner) }}" class="w-full h-full object-cover" alt="Summer banner {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        </section>
    @endif


    {{-- الاكثر مبيعاً --}}
    @include('frontend.partials.product_carousel_section', [
        'title' => translate('best_selling'),
        'products' => $best_selling_products,
    ])

    {{-- عروض الأسبوع --}}
    @include('frontend.partials.product_carousel_section', [
        'title' => translate('Deal of The Week'),
        'products' => $deal_of_the_week,
    ])

    {{-- وصل حديثاً --}}
    @include('frontend.partials.product_carousel_section', [
        'title' => translate('New Arrivals'),
        'products' => $new_products,
    ])

    {{-- الاستانلس استيل --}}
    @if (count($stainless_steel_products) > 0)
        <section class="px-4 md:px-6 py-6">
            <h2 class="text-center text-xl font-extrabold text-neutral-900 mb-4">
                @if (app()->getLocale() == 'sa') ستانلس ستيل
                @elseif(app()->getLocale() == 'cn') 钢材
                @else Stainless Steel
                @endif
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center">
                <div class="lg:col-span-2 rounded-xl overflow-hidden">
                    @if (app()->getLocale() == 'sa')
                        <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}" class="w-full h-[300px] md:h-[411px] object-cover">
                    @elseif(app()->getLocale() == 'cn')
                        <img src="{{ static_asset('assets/front_img/stainless-cn.jpg') }}" class="w-full h-[300px] md:h-[411px] object-cover">
                    @else
                        <img src="{{ static_asset('assets/front_img/stainless-en.jpg') }}" class="w-full h-[300px] md:h-[411px] object-cover">
                    @endif
                </div>
                <div class="grid grid-cols-4 lg:grid-cols-2 gap-3">
                    @foreach ($stainless_steel_products as $product)
                        <a href="{{ route('product', $product->slug) }}" class="rounded-lg border border-neutral-200 bg-white p-2 aspect-square flex items-center justify-center">
                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="max-h-full max-w-full object-contain" alt="{{ $product->getTranslation('name') }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- شركاء النجاح --}}
    @if (count($partners) > 0)
        <section class="px-4 md:px-6 py-6">
            <h2 class="text-center text-xl font-extrabold text-neutral-900 mb-4">{{ translate('partners') }}</h2>
            <x-carousel :options="['slidesPerView' => 3, 'spaceBetween' => 16, 'breakpoints' => ['640' => ['slidesPerView' => 5], '1024' => ['slidesPerView' => 6]]]">
                @foreach ($partners as $partner)
                    <div class="swiper-slide flex items-center justify-center p-3">
                        <img src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}"
                            class="max-h-20 max-w-[120px] object-contain">
                    </div>
                @endforeach
            </x-carousel>
        </section>
    @endif

    @if (count($brands) > 0)
        <section class="px-4 md:px-6 py-6">
            <h2 class="text-center text-xl font-extrabold text-neutral-900 mb-4">{{ translate('Brands') }}</h2>
            <div class="flex flex-wrap items-center justify-center gap-4">
                @foreach ($brands as $brand)
                    <div class="flex size-24 items-center justify-center rounded-lg border border-neutral-200 bg-white p-2">
                        <img src="{{ $brand->logo ? uploaded_asset($brand->logo) : static_asset('assets/img/placeholder.jpg') }}" class="max-h-full max-w-full object-contain">
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

