@extends('frontend.layouts.app')

@section('style')
    <style>
        /* ===================== Mini Cart Toast (positioned from cart icon) ===================== */

        /* ===== شكل البوب-أب القديم + السهم (بدون تغيير الشكل) ===== */
        .mini-cart-toast {
            z-index: 9999;
            width: min(420px, 92vw);
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            padding: 14px;
        }

        /* العناصر الداخلية */
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

        /* السهم */
        .mini-cart-toast::before {
            content: "";
            position: absolute;
            width: 14px;
            height: 14px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-bottom: none;
            border-left: none;
            transform: rotate(45deg);
            top: -7px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, .06);
        }

        .mini-cart-toast.ltr::before {
            right: var(--arrow-offset, 24px);
        }

        .mini-cart-toast.rtl::before {
            left: var(--arrow-offset, 24px);
        }

        /* لودينج الزر */
        .add-to-cart-btn.is-loading {
            pointer-events: none;
            opacity: .8;
        }

        .add-to-cart-btn .btn-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: btnSpin .6s linear infinite;
            vertical-align: -2px;
            margin-inline-end: 6px;
        }

        @keyframes btnSpin {
            to {
                transform: rotate(360deg)
            }
        }

        /* أمان ضد أي أوفر فلو أفقي */
        html,
        body {
            overflow-x: hidden;
        }

        /* Optional safety to avoid any accidental horizontal scroll */
        html,
        body {
            overflow-x: hidden;
        }

        /* ===================== Loading state for Add-to-Cart button ===================== */
        .add-to-cart-btn.is-loading {
            pointer-events: none;
            opacity: .8;
        }

        .add-to-cart-btn .btn-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: btnSpin .6s linear infinite;
            vertical-align: -2px;
            margin-inline-end: 6px;
        }

        @keyframes btnSpin {
            to {
                transform: rotate(360deg)
            }
        }

        /* ===================== Existing page styles (unchanged) ===================== */
        .arrivals a {
            font-size: 14px;
            padding: 3px;
        }

        .arrivals .card-body {
            padding: 6px;
        }

        .arrivals .badge {
            margin: 0
        }

        .product-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 600px;
            min-width: 420px;
        }

        .product-card-img {
            height: 220px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .product-title {
            min-height: 48px;
            overflow: hidden;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .45em .85em;
            font-size: .85rem;
            font-weight: 600;
            line-height: 1.2;
            white-space: nowrap;
            border-radius: .375rem;
            width: auto;
            min-width: auto;
            max-width: none;
            overflow: visible;
            text-overflow: unset;
        }

        .product-img {
            width: 220px;
            height: 220px;
            object-fit: contain;
        }

        .best-seller .card .card-body {
            padding: 25px 5px;
        }

        .logos .sub-logo {
            width: 140px;
            height: 140px;
            margin: 10px;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .partners .sub-partner {
            width: 110px;
            height: 110px;
            margin: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partners img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .sub-stal {
            width: 45%;
            margin: 10px 4px;
            aspect-ratio: 1/1;
            overflow: hidden;
            border: 1px solid #eee;
            border-radius: 6px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sub-stal img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s ease;
        }

        .sub-stal:hover img {
            transform: scale(1.05);
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

        /* سلايدر أهم التصنيفات */
        .category-slider {
            overflow-x: auto !important;
            /* نلغي overflow-hidden */
            overflow-y: hidden;
            display: flex;
            flex-wrap: nowrap;
            /* كل العناصر في سطر واحد */
            justify-content: flex-start !important;
            /* بلاش center */
            gap: 10px;
            padding: 0 30px;
            scroll-behavior: smooth;
        }

        .slider-item {
            flex: 0 0 auto;
            /* مايتضغطش */
            flex-shrink: 0;
        }

        /* إخفاء شريط التمرير */
        .category-slider {
            -ms-overflow-style: none;
            /* IE/Edge القديم */
            scrollbar-width: none;
            /* Firefox */
        }

        .category-slider::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
            /* Chrome/Safari/Edge */
        }

        /* اختياري: قصّ أي خط رمادي تحت */
        .category-slider {
            padding-bottom: 12px;
            margin-bottom: -12px;
        }


        /* .category-slider-arrivals {
                                                transition: transform .5s ease-in-out;
                                                scroll-behavior: smooth;
                                                gap: 10px;
                                                padding: 0 30px;
                                            } */
        .category-slider-arrivals {
            overflow-x: auto !important;
            /* بدل overflow-hidden */
            overflow-y: hidden;
            display: flex;
            flex-wrap: nowrap;
            /* مهم: كله في سطر واحد */
            justify-content: flex-start !important;
            /* بلاش center على عنصر بيتم Scroll */
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
            flex: 0 0 auto;
            /* مهم */
        }

        /* اخفاء الاسكرول بار لعناصر السلايدر فقط */
        .category-slider-arrivals,
        .category-slider {
            /* لو عايز كمان لسلايدر التصنيفات */
            -ms-overflow-style: none;
            /* IE و Edge القديم */
            scrollbar-width: none;
            /* Firefox */
        }

        .category-slider-arrivals::-webkit-scrollbar,
        .category-slider::-webkit-scrollbar {
            width: 0;
            height: 0;
            /* سلايدر أفقي */
            display: none;
            /* WebKit: Chrome/Edge/Safari */
        }


        .slider-item-arrivals .card {
            padding: 15px;
            height: 400px;
            width: 100%;
        }

        .slider-item-arrivals .card .badge {
            margin: 5px 0;
        }

        .slider-item-arrivals .card-body {
            padding: 0;
        }

        .slider-item-arrivals .card-body h6 {
            font-size: 16px;
        }

        .slider-btn-arrivals {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
            z-index: 2;
            box-shadow: 0 0 6px rgba(0, 0, 0, .15);
        }

        .prev-btn-arrivals {
            right: -10px;
        }

        .next-btn-arrivals {
            left: -10px;
        }

        .main-arrivals .card-img-top {
            width: 120px;
            height: 140px;
            object-fit: contain;
        }

        .logos img {
            max-width: 100% !important;
            max-height: 100% !important;
            object-fit: fill !important;
        }


        @media screen and (max-width:1000px) {
            .category-slider-arrivals {
                flex-wrap: wrap;
            }

            .slider-item {
                max-width: 200px;
                padding: 0;
            }

            .slider-item-arrivals {
                max-width: min(325px, 85vw) !important;
                width: min(325px, 85vw);
                padding: 0;
            }

            .slider-btn-arrivals {
                display: none;
            }

            .slider-item-arrivals .card {
                height: auto;
                min-height: 320px;
                width: 100%;
            }

            .main-arrivals .card-img-top {
                width: 120px;
                height: 140px;
                object-fit: contain;
            }

            .partners .sub-partner {
                width: 20%;
                height: auto;
                margin: 5px;
                padding: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logos .sub-logo {
                width: 40%;
                height: auto;
                margin: 10px;
                padding: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* ===================== Homepage visual overhaul ===================== */
        :root {
            --brand: #ae2025;
            --brand-dark: #8a1a1e;
            --ink: #1f2430;
            --muted: #6b7280;
            --surface: #ffffff;
            --surface-soft: #f6f7f9;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow-soft: 0 6px 20px rgba(17, 24, 39, .07);
            --shadow-hover: 0 14px 32px rgba(17, 24, 39, .14);
        }

        /* Section headings, unified */
        section h2 {
            position: relative;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--ink);
            margin-bottom: 2rem !important;
            padding-bottom: 14px;
        }

        section h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 56px;
            height: 4px;
            border-radius: 4px;
            background: var(--brand);
        }

        section {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        /* Unified circular icon-nav button used by every slider/carousel in this page */
        .icon-nav-btn {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid #eef0f2;
            background: var(--surface);
            color: var(--ink);
            box-shadow: var(--shadow-soft);
            transition: all .2s ease;
            font-size: 15px;
        }

        .icon-nav-btn:hover {
            background: var(--brand);
            color: #fff;
            border-color: var(--brand);
            box-shadow: var(--shadow-hover);
            transform: translateY(-50%) scale(1.06);
        }

        .icon-nav-btn:active {
            transform: translateY(-50%) scale(.96);
        }

        /* Main banner carousel controls -> replace bootstrap default glyphs */
        .mainbanner .carousel-control-prev,
        .mainbanner .carousel-control-next {
            width: 48px;
            height: 48px;
            top: 50%;
            bottom: auto;
            transform: translateY(-50%);
            border-radius: 50%;
            background: rgba(255, 255, 255, .92);
            box-shadow: var(--shadow-soft);
            opacity: 1;
            transition: all .2s ease;
        }

        .mainbanner .carousel-control-prev {
            left: 16px;
        }

        .mainbanner .carousel-control-next {
            right: 16px;
        }

        .mainbanner .carousel-control-prev:hover,
        .mainbanner .carousel-control-next:hover {
            background: var(--brand);
        }

        .mainbanner .carousel-control-prev i,
        .mainbanner .carousel-control-next i {
            font-size: 16px;
            color: var(--ink);
            transition: color .2s ease;
        }

        .mainbanner .carousel-control-prev:hover i,
        .mainbanner .carousel-control-next:hover i {
            color: #fff;
        }

        /* Wishlist (heart) icon button on product cards */
        .wishlist-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--surface);
            box-shadow: var(--shadow-soft);
            transition: all .2s ease;
        }

        .wishlist-btn:hover {
            background: var(--brand);
            box-shadow: var(--shadow-hover);
            transform: scale(1.08);
        }

        .wishlist-btn:hover i {
            color: #fff !important;
        }

        .wishlist-btn i {
            transition: color .2s ease;
        }

        /* Product cards */
        .best-seller .card,
        .main-arrivals .card {
            border: 1px solid #f0f1f3;
            border-radius: var(--radius-lg) !important;
            box-shadow: var(--shadow-soft);
            transition: transform .25s ease, box-shadow .25s ease;
            overflow: hidden;
        }

        .best-seller .card:hover,
        .main-arrivals .card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .best-seller .product-img,
        .main-arrivals .card-img-top {
            background: var(--surface-soft);
            border-radius: var(--radius-md);
            padding: 10px;
        }

        .add-to-cart-btn {
            border-radius: 999px !important;
            font-weight: 600;
            transition: filter .2s ease, transform .15s ease;
        }

        .add-to-cart-btn:hover:not(:disabled) {
            filter: brightness(1.08);
        }

        .add-to-cart-btn:active:not(:disabled) {
            transform: scale(.98);
        }

        /* Category slider items -> chip cards instead of bare image+text */
        .category-slider .slider-item {
            text-align: center;
            transition: transform .2s ease;
        }

        .category-slider .slider-item:hover {
            transform: translateY(-4px);
        }

        .category-slider .slider-item img {
            width: 96px;
            height: 96px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--surface-soft);
            box-shadow: var(--shadow-soft);
            transition: box-shadow .2s ease, border-color .2s ease;
        }

        .category-slider .slider-item:hover img {
            border-color: var(--brand);
            box-shadow: var(--shadow-hover);
        }

        .category-slider .slider-item p {
            margin-top: 10px;
            margin-bottom: 0;
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
        }

        .stainless-banner-img {
            width: 100%;
            height: 411px;
            object-fit: cover;
            border-radius: var(--radius-md);
        }

        @media (max-width: 991px) {
            .stainless-banner-img {
                height: 300px;
            }
        }

        @media (max-width: 575px) {
            .stainless-banner-img {
                height: 220px;
            }
        }

        /* Partner / brand logo tiles */
        .partners .sub-partner,
        .logos .sub-logo {
            background: var(--surface);
            border: 1px solid #f0f1f3;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
            transition: box-shadow .2s ease, transform .2s ease;
        }

        .partners .sub-partner:hover,
        .logos .sub-logo:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }
    </style>
@endsection

@section('content')
    @if (count($sliders) > 0)
        <section class="mainbanner">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-xl-12 pc">
                        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $locale = app()->getLocale();
                                    $localeMap = ['ar' => 'sa', 'zh' => 'cn'];
                                    $prefixLocale = $localeMap[$locale] ?? $locale;
                                    $localizedSliders = $sliders->filter(function ($slider) use ($prefixLocale) {
                                        $fileOriginalName = $slider->file_original_name ?? '';
                                        return str_starts_with($fileOriginalName, $prefixLocale . '-');
                                    });
                                    $isFirst = true;
                                @endphp

                                @foreach ($localizedSliders as $key => $slider)
                                    <div class="carousel-item {{ $isFirst ? 'active' : '' }}">
                                        <a href="{{ $sliderLinks[$key] ?? '#' }}">
                                            <img src="{{ static_asset($slider->file_name) }}" class="d-block w-100"
                                                alt="{{ env('APP_NAME') }}..."
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide"
                                data-bs-slide="prev">
                                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide"
                                data-bs-slide="next">
                                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-xl-12 mob">
                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $locale = app()->getLocale();
                                    $localeMap = ['ar' => 'sa', 'zh' => 'cn'];
                                    $prefixLocale = $localeMap[$locale] ?? $locale;
                                    $localizedSliders2 = $sliders2->filter(function ($slider) use ($prefixLocale) {
                                        $fileOriginalName = $slider->file_original_name ?? '';
                                        return str_starts_with($fileOriginalName, $prefixLocale . '-');
                                    });
                                    $isFirst = true;
                                @endphp

                                @foreach ($localizedSliders2 as $key => $slider)
                                    <div class="carousel-item {{ $isFirst ? 'active' : '' }}">
                                        <a href="{{ $sliderLinks2[$key] ?? '#' }}">
                                            <img src="{{ static_asset($slider->file_name) }}" class="d-block w-100"
                                                alt="{{ env('APP_NAME') }}..."
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- اهم التصنيفات --}}
    <section class="main-categories text-center mt-5">
        <div class="container">
            <h2 class="mb-4">{{ translate('Categories') }}</h2>
            <div class="position-relative">
                <button
                    class="slider-btn icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') next-btn @else prev-btn @endif">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="category-slider d-flex overflow-hidden justify-content-center" id="slider">
                    @foreach ($main_categories as $category)
                        @if ($category->featured == 1)
                            <a href="{{ route('products.category', $category->slug) }}" style="text-decoration: none">
                                <div class="slider-item">
                                    <img src="{{ $category->bannerImage ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        alt="">
                                    <p>{{ $category->getTranslation('name') }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button
                    class="slider-btn icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') prev-btn @else next-btn @endif">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- منتجات موسم الصيف --}}
    {{-- منتجات موسم الصيف --}}
    <section class="categories mt-xl-5 mt-lg-5 mt-md-5">
        <div class="container text-center">
            <div class="row justify-content-center mb-2">
                <div class="col-xl-6 col-lg-6 col-lg-8">
                    <h2>{{ translate('summer_season_products') }}</h2>
                </div>
            </div>

            @php
                // الروابط بالترتيب نفسه بتاع البانرات
                $summer_links = [
                    route('products.category', 'ice-cream-makers-p8yjs'),
                    route('products.category', 'beverage-equipment-5zoca'),
                    route('products.category', 'ice-cream-display-refrigerators-g7b8h'),
                ];
            @endphp

            <div class="row justify-content-center">
                @if ($summer_banners && count($summer_banners))
                    @foreach ($summer_banners as $banner)
                        <div class="col-xl-4">
                            <a href="{{ $summer_links[$loop->index] ?? '#' }}">
                                <img src="{{ static_asset($banner) }}" style="width: 100%;"
                                    alt="Summer banner {{ $loop->iteration }}">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    {{-- الاكثر مبيعاً --}}
    @if (count($best_selling_products) >= 6)
        <section class="best-seller mt-5">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-xl-12 text-center">
                        <h2 class="fw-bold">{{ translate('best_selling') }}</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-9 col-lg-8" style="padding: 35px">
                        <div class="row g-3">
                            @foreach ($best_selling_products->take(6) as $product)
                                <div class="col-md-4 col-sm-6" style="overflow-y: hidden !important;">
                                    <div class="card shadow-sm text-center position-relative h-100">
                                        @if ($product->discount > 0)
                                            <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end"
                                                style="font-size: 14px;">
                                                -{{ round($product->discount) }}%
                                            </div>
                                        @endif

                                        <div class="position-absolute top-0 end-0 m-2 z-1">
                                            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"
                                                class="wishlist-btn text-dark d-inline-flex align-items-center justify-content-center">
                                                <i class="la la-heart-o" style="font-size: 18px; color: #ae2025;"></i>
                                            </a>
                                        </div>

                                        <a href="{{ route('product', $product->slug) }}">
                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                class="card-img-top product-img"
                                                alt="{{ $product->getTranslation('name') }}">
                                        </a>

                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <div class="mb-0" style="overflow-y: hidden !important;">
                                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                                    <span class="badge bg-light border text-dark"
                                                        style="font-size: 0.75rem;">
                                                        {{ translate('sku') }}: {{ $product->stocks->first()->sku ?? '' }}
                                                    </span>
                                                    <span
                                                        class="badge {{ $product->current_stock > 0 ? 'bg-success' : 'bg-danger' }}"
                                                        style="font-size: 0.75rem;">
                                                        {{ $product->current_stock > 0 ? '✔ ' . translate('Available') : translate('Out of stock') }}
                                                    </span>
                                                    @if ($product->shipping_cost == 0)
                                                        <span class="badge bg-warning text-dark"
                                                            style="font-size: 0.75rem;">
                                                            {{ translate('Free Shipping') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <h6 class="card-title fw-bold">{{ $product->getTranslation('name') }}</h6>

                                            <div class="mb-0" style="overflow-y: hidden !important;">
                                                @if ($product->discount > 0.0)
                                                    <span class="fs-6 fw-bold text-dark text-decoration-line-through">
                                                        {{ $product->unit_price }}
                                                        <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                            style="width: 14px; height: 14px;">
                                                    </span>
                                                    <span class="text-muted mx-2">
                                                        {{ $product->discount_type == 'percent' ? $product->unit_price - ($product->unit_price * $product->discount) / 100 : $product->unit_price - $product->discount }}
                                                        <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                            style="width: 14px; height: 14px;">
                                                    </span>
                                                @else
                                                    <span class="fs-5 fw-bold text-dark">
                                                        {{ $product->unit_price }}
                                                        <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                            style="width: 14px; height: 14px;">
                                                    </span>
                                                @endif
                                                <div class="text-muted"
                                                    style="font-size: 12px; overflow-y: hidden !important;">
                                                    @if (app()->getLocale() == 'sa')
                                                        شامل الضريبه
                                                    @elseif(app()->getLocale() == 'cn')
                                                        包含税
                                                    @else
                                                        Tax Included
                                                    @endif
                                                </div>
                                            </div>

                                            <button type="button" class="btn add-to-cart-btn px-3 py-2"
                                                @if ($product->current_stock <= 0) disabled @endif
                                                data-id="{{ $product->id }}"
                                                style="background-color:#ae2025;color:#fff;">
                                                <i class="fa-solid fa-cart-shopping me-1"></i>
                                                {{ translate('Add to Cart') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 d-flex align-items-center">
                        <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU">
                            <img src="{{ static_asset('assets/front_img/bestseller-' . app()->getLocale() . '.jpg') }}"
                                alt="Best Selling Banner" class="img-fluid w-100 h-100"
                                style="object-fit: cover; border-radius: 8px;">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- عروض الأسبوع --}}
    @if (count($deal_of_the_week) > 0)
        <section class="main-arrivals text-center my-5">
            <div class="container">
                <h2>{{ translate('Deal of The Week') }}</h2>
                <div class="position-relative">
                    <button
                        class="slider-btn-arrivals icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') next-btn-arrivals @else prev-btn-arrivals @endif">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="category-slider-arrivals d-flex overflow-auto" id="slider-arrivals">
                        @foreach ($deal_of_the_week as $product)
                            <div class="slider-item-arrivals">
                                <div class="card shadow-sm text-center">
                                    @if ($product->discount > 0)
                                        <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end"
                                            style="font-size: 14px;">-{{ $product->discount }}%</div>
                                    @endif

                                    <div class="position-absolute top-0 end-0 m-2 z-1">
                                        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"
                                            class="text-dark p-2 d-inline-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="la la-heart-o" style="font-size: 18px; color: #ae2025;"></i>
                                        </a>
                                    </div>

                                    <a href="{{ route('product', $product->slug) }}">
                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="card-img-top"
                                            alt="{{ $product->getTranslation('name') }}">
                                    </a>

                                    <div class="card-body position-relative">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center">
                                            <span class="badge bg-light border text-dark">{{ translate('sku') }}:
                                                {{ $product->stocks->first()->sku ?? '' }}</span>
                                            <span
                                                class="badge {{ $product->current_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->current_stock > 0 ? '✔️ ' . translate('Available') : translate('Out of stock') }}
                                            </span>
                                            <span class="badge bg-warning text-dark">
                                                {{ $product->shipping_cost == 0 ? translate('Free Shipping') : '' }}
                                            </span>
                                        </div>

                                        <h6 class="card-title fw-bold ">{{ $product->getTranslation('name') }}</h6>

                                        <div class="mb-0" style="overflow-y: hidden !important;">
                                            @if ($product->discount > 0.0 && $product->discount_type == 'percent')
                                                <span
                                                    class="fs-5 fw-bold text-dark text-decoration-line-through">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                                <span
                                                    class="text-muted mx-2">{{ $product->unit_price - ($product->unit_price * $product->discount) / 100 }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @elseif($product->discount > 0.0 && $product->discount_type == 'amount')
                                                <span
                                                    class="fs-5 fw-bold text-dark text-decoration-line-through">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                                <span
                                                    class="text-muted mx-2">{{ $product->unit_price - $product->discount }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @else
                                                <span class="fs-5 fw-bold text-dark">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @endif
                                            <br><span class="text-muted" style="font-size: 12px;">
                                                @if (app()->getLocale() == 'sa')
                                                    شامل الضريبه
                                                @elseif(app()->getLocale() == 'cn')
                                                    包含税
                                                @else
                                                    Tax Included
                                                @endif
                                            </span>
                                        </div>
                                        <button type="button" @if ($product->current_stock <= 0) disabled @endif
                                            class="btn position-absolute bottom-0 start-50 translate-middle-x w-100 add-to-cart-btn"
                                            data-id="{{ $product->id }}" style="background-color:#ae2025;color:#fff;">
                                            <i class="fa-solid fa-cart-shopping me-1"></i> {{ translate('Add to Cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button
                        class="slider-btn-arrivals icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') prev-btn-arrivals @else next-btn-arrivals @endif">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    @endif

    {{-- وصل حديثاً --}}
    @if (count($new_products) > 0)
        <section class="main-arrivals text-center my-5">
            <div class="container">
                <h2>{{ translate('New Arrivals') }}</h2>
                <div class="position-relative">
                    <button
                        class="slider-btn-arrivals icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') next-btn-arrivals @else prev-btn-arrivals @endif">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="category-slider-arrivals d-flex justify-content-center overflow-hidden"
                        id="slider-arrivals">
                        @foreach ($new_products as $product)
                            <div class="slider-item-arrivals">
                                <div class="card shadow-sm text-center">
                                    @if ($product->discount > 0)
                                        <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end"
                                            style="font-size: 14px;">-{{ $product->discount }}%</div>
                                    @endif

                                    <div class="position-absolute top-0 end-0 m-2 z-1">
                                        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"
                                            class="text-dark p-2 d-inline-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="la la-heart-o" style="font-size: 18px; color: #ae2025;"></i>
                                        </a>
                                    </div>

                                    <a href="{{ route('product', $product->slug) }}">
                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="card-img-top"
                                            alt="{{ $product->getTranslation('name') }}">
                                    </a>

                                    <div class="card-body position-relative">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center">
                                            <span class="badge bg-light border text-dark">{{ translate('sku') }}:
                                                {{ $product->stocks->first()->sku ?? '' }}</span>
                                            <span
                                                class="badge {{ $product->current_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->current_stock > 0 ? '✔️ ' . translate('Available') : translate('Out of stock') }}
                                            </span>
                                            <span class="badge bg-warning text-dark">
                                                {{ $product->shipping_cost == 0 ? translate('Free Shipping') : '' }}
                                            </span>
                                        </div>

                                        <h6 class="card-title fw-bold">{{ $product->getTranslation('name') }}</h6>

                                        <div class="mb-0" style="overflow-y: hidden !important;">
                                            @if ($product->discount > 0.0 && $product->discount_type == 'percent')
                                                <span
                                                    class="fs-5 fw-bold text-dark text-decoration-line-through">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                                <span
                                                    class="text-muted mx-2">{{ $product->unit_price - ($product->unit_price * $product->discount) / 100 }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @elseif($product->discount > 0.0 && $product->discount_type == 'amount')
                                                <span
                                                    class="fs-5 fw-bold text-dark text-decoration-line-through">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                                <span
                                                    class="text-muted mx-2">{{ $product->unit_price - $product->discount }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @else
                                                <span class="fs-5 fw-bold text-dark">{{ $product->unit_price }}
                                                    <img src="{{ static_asset('assets/front_img/rs.png') }}"
                                                        style="width: 15px; height: 15px;"></span>
                                            @endif
                                            <br><span class="text-muted" style="font-size: 12px;">
                                                @if (app()->getLocale() == 'sa')
                                                    شامل الضريبه
                                                @elseif(app()->getLocale() == 'cn')
                                                    包含税
                                                @else
                                                    Tax Included
                                                @endif
                                            </span>
                                        </div>

                                        <button type="button" @if ($product->current_stock <= 0) disabled @endif
                                            class="btn position-absolute bottom-0 start-50 translate-middle-x w-100 add-to-cart-btn"
                                            data-id="{{ $product->id }}" style="background-color:#ae2025;color:#fff;">
                                            <i class="fa-solid fa-cart-shopping me-1"></i> {{ translate('Add to Cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button
                        class="slider-btn-arrivals icon-nav-btn @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') prev-btn-arrivals @else next-btn-arrivals @endif">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    @endif

    @if ($grill_banner)
        <section class="categories mt-xl-5 mt-lg-5 mt-md-5">
            <div class="container text-center">
                <div class="row justify-content-center">
                    @if ($grill_banner)
                        <div class="col-xl-12">
                            <a href="{{ isset($grill_link[0]) ? $grill_link[0] : '#' }}">
                                <img src="{{ static_asset($grill_banner?->file_name) }}" style="width: 100%;">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @php
        $firstFour = $stainless_steel_products->slice(0, 2);
        $lastFour = $stainless_steel_products->slice(2, 2);
    @endphp

    {{-- الاستانلس استيل --}}
    <section class="categories mt-xl-5 mt-lg-5 mt-md-5">
        <div class="container">
            <h2 class="text-center">
                @if (app()->getLocale() == 'sa')
                    ستانلس ستيل
                @elseif(app()->getLocale() == 'cn')
                    钢材
                @else
                    Stainless Steel
                @endif
            </h2>
            <div class="row justify-content-between">
                <div class="col-xl-8 mb-3">
                    @if (app()->getLocale() == 'sa')
                        <a href="https://phpstack-1358664-5522133.cloudwaysapps.com/category/---nm2KU">
                            <img src="{{ static_asset('assets/front_img/stanlsbanner.jpeg') }}"
                                class="stainless-banner-img">
                        </a>
                    @elseif(app()->getLocale() == 'cn')
                        <img src="{{ static_asset('assets/front_img/stainless-cn.jpg') }}"
                            class="stainless-banner-img">
                    @elseif(app()->getLocale() == 'en')
                        <img src="{{ static_asset('assets/front_img/stainless-en.jpg') }}"
                            class="stainless-banner-img">
                    @endif
                </div>
                <div class="col-xl-4 my-auto">
                    <div class="d-flex justify-content-center mb-3 flex-wrap">
                        @foreach ($firstFour as $product)
                            <div class="sub-stal m-2">
                                <img src="{{ uploaded_asset($product->thumbnail_img) }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center flex-wrap">
                        @foreach ($lastFour as $product)
                            <div class="sub-stal m-2">
                                <img src="{{ uploaded_asset($product->thumbnail_img) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- شركاء النجاح
    @if (count($partners) > 0)
        <section class="partners mt-5">
            <h2 class="text-center mb-4">{{ translate('partners') }}</h2>
            <div class="container">
                <div class="d-flex justify-content-center flex-wrap align-items-center">
                    @foreach ($partners as $partner)
                        <div class="sub-partner">
                            <img
                                src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    @if (count($partners) > 0)
        <section class="partners mt-5">
            <h2 class="text-center mb-4">{{ translate('partners') }}</h2>
            <div class="container">
                <div class="position-relative">
                    <button class="slider-btn-partners icon-nav-btn prev-btn-partners">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="d-flex overflow-hidden category-slider-partners" id="partner-slider">
                        @foreach ($partners as $partner)
                            <div class="sub-partner p-3">
                                <img src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}"
                                    style="max-height: 80px; max-width: 120px;">
                            </div>
                        @endforeach
                    </div>

                    <button class="slider-btn-partners icon-nav-btn next-btn-partners">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    @endif

    <style>
        .slider-btn-partners {
            position: absolute;
            top: 50%;
            z-index: 10;
            border: none;
            cursor: pointer;
        }

        .prev-btn-partners {
            left: -20px;
        }

        .next-btn-partners {
            right: -20px;
        }

        .category-slider-partners {
            scroll-behavior: smooth;
            gap: 20px;
        }

        .sub-partner {
            flex: 0 0 auto;
        }
    </style>

    <script>
        (() => {
            const STEP = 200;
            const slider = document.querySelector('.category-slider-partners');
            const prevBtn = document.querySelector('.prev-btn-partners');
            const nextBtn = document.querySelector('.next-btn-partners');

            if (slider && prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: -STEP,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: STEP,
                        behavior: 'smooth'
                    });
                });
            }
        })();
    </script>



    @if (count($brands) > 0)
        <section class="logos mt-xl-5 mt-lg-5 mt-md-5">
            <h2 class="text-center">{{ translate('Brands') }}</h2>
            <div class="container">
                <div class="d-flex justify-content-center flex-wrap align-items-center">
                    @foreach ($brands as $brand)
                        <div class="sub-logo">
                            <img
                                src="{{ $brand->logo ? uploaded_asset($brand->logo) : static_asset('assets/img/placeholder.jpg') }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Host (not required anymore but harmless) --}}
    <div id="miniCartHost"></div>



    @include('frontend.partials.cart.cart_summary_toast')

@endsection

@section('script')
    <script>
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
        (() => {
            const slider = document.getElementById('slider');
            const nextBtn = document.querySelector('.next-btn');
            const prevBtn = document.querySelector('.prev-btn');
            if (slider && nextBtn) {
                nextBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: -180,
                        behavior: 'smooth'
                    });
                });
            }
            if (slider && prevBtn) {
                prevBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: 180,
                        behavior: 'smooth'
                    });
                });
            }
        })();

        /* ==== سلايدرات "arrivals" المتعددة (بدون الاعتماد على ID) ==== */
        // (() => {
        //     const STEP = 180;

        //     document.querySelectorAll('.category-slider-arrivals').forEach((slider) => {
        //         // بنجيب أقرب رابر فيه الأزرار
        //         const wrap = slider.closest('.position-relative') || slider.parentElement;
        //         const nextBtn = wrap?.querySelector('.next-btn-arrivals');
        //         const prevBtn = wrap?.querySelector('.prev-btn-arrivals');

        //         if (nextBtn) {
        //             nextBtn.addEventListener('click', () => {
        //                 slider.scrollBy({
        //                     left: -STEP,
        //                     behavior: 'smooth'
        //                 });
        //             });
        //         }
        //         if (prevBtn) {
        //             prevBtn.addEventListener('click', () => {
        //                 slider.scrollBy({
        //                     left: STEP,
        //                     behavior: 'smooth'
        //                 });
        //             });
        //         }
        //     });
        // })();

        (() => {
            // خطوة ديناميكية = عرض أول كارت + الجاب
            const defaultStep = 180;
            document.querySelectorAll('.category-slider-arrivals').forEach((slider) => {
                const item = slider.querySelector('.slider-item-arrivals');
                const gap = 10;
                const step = item ? Math.round(item.getBoundingClientRect().width + gap) : defaultStep;

                const wrap = slider.closest('.position-relative') || slider.parentElement;
                const nextBtn = wrap?.querySelector('.next-btn-arrivals');
                const prevBtn = wrap?.querySelector('.prev-btn-arrivals');

                const isRTL = document.documentElement.dir === 'rtl';

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        slider.scrollBy({
                            left: isRTL ? step : -step,
                            behavior: 'smooth'
                        });
                    });
                }
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        slider.scrollBy({
                            left: isRTL ? -step : step,
                            behavior: 'smooth'
                        });
                    });
                }
            });
        })();


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
