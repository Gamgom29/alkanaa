@extends('frontend.layouts.app')

@if (!empty($category))
    @php
        $meta_title = $category->meta_title;
        $meta_description = $category->meta_description;
    @endphp
@elseif (!empty($brand_id))
    @php
        $meta_title = get_single_brand($brand_id)->meta_title;
        $meta_description = get_single_brand($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title = get_setting('meta_title');
        $meta_description = get_setting('meta_description');
    @endphp
@endif


@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection


@section('style')
    <style>
        .accordion-wrapper {
            max-height: 400px;
            /* غير الرقم حسب ما يناسبك */
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        /* Scrollbar شكله بسيط وأنيق */
        .accordion-wrapper::-webkit-scrollbar {
            width: 6px;
        }

        .accordion-wrapper::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        /* دعم RTL للسهم */
        .accordion-button::after {
            transform: scale(0.7);
            margin-right: 10px;
        }

        .rtl .accordion-button::after {
            margin-left: 10px;
            margin-right: 0;
        }

        /* تصغير حجم السهم وتبعيده عن النص */
        .accordion-button::after {
            transform: scale(0.7);
            /* يصغر السهم */
            margin-right: 10px;
            /* يبعد السهم عن الكلام */
        }

        /* لو RTL يبقى نعكس الاتجاه */
        .rtl .accordion-button::after {
            margin-right: 0;
            margin-left: 10px;
        }

        /* تحسين تنسيق الزر */
        .accordion-button {
            font-size: 16px;
            font-weight: bold;
            padding: 12px 20px;
        }

        .badge {
            width: auto !important;
            height: auto !important;
        }
    </style>
@endsection
@section('content')

    <section class="mb-4 pt-4">
        <div class="container sm-px-0 pt-2">
            <form class="" id="search-form" action="" method="GET">
                <div class="row">

                    <!-- Sidebar Filters -->
                    <div class="col-xl-3">
                        <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
                                data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600">{{ translate('Filters') }}</h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb"
                                        data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>
                                @if (isset($product_type) && $product_type == 'preorder_product')
                                    <!-- Categories -->
                                    <div class="bg-white border mb-3">
                                        <div class="fs-16 fw-700 p-3">
                                            <a href="#collapse_1"
                                                class="dropdown-toggle filter-section text-dark d-flex align-items-center justify-content-between"
                                                data-toggle="collapse">
                                                {{ translate('Categories') }}
                                            </a>
                                        </div>
                                        <div class="collapse show" id="collapse_1">
                                            <ul class="p-3 mb-0 list-unstyled">
                                                @if (!isset($category_id))
                                                    @foreach ($categories as $category)
                                                        <li class="mb-3 text-dark">
                                                            <a class="text-reset fs-14 hov-text-primary"
                                                                href="{{ route('preorder.category', $category?->slug) }}">
                                                                {{ $category->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="mb-3">
                                                        <a class="text-reset fs-14 fw-600 hov-text-primary"
                                                            href="{{ route('search') }}">
                                                            <i class="las la-angle-left"></i>
                                                            {{ translate('All Categories') }}
                                                        </a>
                                                    </li>

                                                    @if ($category->parent_id != 0)
                                                        <li class="mb-3">
                                                            <a class="text-reset fs-14 fw-600 hov-text-primary"
                                                                href="{{ route('preorder.category', get_single_category($category->parent_id)->slug) }}">
                                                                <i class="las la-angle-left"></i>
                                                                {{ get_single_category($category->parent_id)->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="mb-3">
                                                        <a class="text-reset fs-14 fw-600 hov-text-primary"
                                                            href="{{ route('preorder.category', $category?->slug) }}">
                                                            <i class="las la-angle-left"></i>
                                                            {{ $category->getTranslation('name') }}
                                                        </a>
                                                    </li>
                                                    @foreach ($category->childrenCategories as $key => $immediate_children_category)
                                                        <li class="ml-4 mb-3">
                                                            <a class="text-reset fs-14 hov-text-primary"
                                                                href="{{ route('preorder.category', $immediate_children_category?->slug) }}">
                                                                {{ $immediate_children_category->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Attributes -->
                                    <div class="bg-white border mb-3">
                                        <div class="fs-16 fw-700 p-3">
                                            <a href="#"
                                                class="dropdown-toggle text-dark filter-section collapsed d-flex align-items-center justify-content-between"
                                                data-toggle="collapse" data-target="#collapse_availability_filter"
                                                style="white-space: normal;">
                                                {{ translate('Filter by Availability') }}
                                            </a>
                                        </div>
                                        @php
                                            $show = $is_available !== null ? 'show' : '';
                                        @endphp
                                        <div class="collapse {{ $show }}" id="collapse_availability_filter">
                                            <div class="p-3 aiz-checkbox-list">
                                                <label class="aiz-checkbox mb-3">
                                                    <input type="radio" name="is_available" value="1"
                                                        @if ($is_available == 1) checked @endif
                                                        onchange="filter()">
                                                    <span class="aiz-square-check"></span>
                                                    <span
                                                        class="fs-14 fw-400 text-dark">{{ translate('Available Now') }}</span>
                                                </label>
                                                <label class="aiz-checkbox mb-3">
                                                    <input type="radio" name="is_available" value="0"
                                                        @if ($is_available === '0') checked @endif
                                                        onchange="filter()">
                                                    <span class="aiz-square-check"></span>
                                                    <span class="fs-14 fw-400 text-dark">{{ translate('Upcoming') }}</span>
                                                </label>
                                                <label class="aiz-checkbox mb-3">
                                                    <input type="radio" name="is_available" value=""
                                                        @if ($is_available === null) checked @endif
                                                        onchange="filter()">
                                                    <span class="aiz-square-check"></span>
                                                    <span class="fs-14 fw-400 text-dark">{{ translate('All') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Categories -->
                                    {{-- <div class="container text-center">
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-xl-6 col-lg-6 col-lg-8">
                                                <h2>
                                                    التصنيفات الرئيسية
                                                </h2>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <ul>
                                                <li class="nav-item position-relative menu-trigger">
                                                    <a class="nav-link" href="#" onmouseover="showCustomMegaMenu()"
                                                        onmouseout="hideCustomMegaMenu()">
                                                        {{ translate('Categories') }}
                                                    </a>
                                                    <div class="custom-mega-menu @if (App::getLocale() == 'en' || App::getLocale() == 'cn') custom-mega-ltr @else custom-mega-rtl @endif"
                                                        id="customMegaMenu" onmouseover="cancelCustomHide()"
                                                        onmouseout="hideCustomMegaMenu()">

                                                        <!-- القائمة الرئيسية على اليمين -->
                                                        <ul class="custom-main-category-list">
                                                            @foreach ($categories as $category)
                                                                <li onmouseover="showCustomSub(this)"
                                                                    data-sub="subcat-{{ $category->id }}">
                                                                    {{ $category->getTranslation('name') }}
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                        <!-- القوائم الفرعية لكل كاتيجوري -->
                                                        @foreach ($categories as $category)
                                                            <ul class="custom-sub-category"
                                                                id="subcat-{{ $category->id }}">
                                                                @if ($category->childrenCategories && $category->childrenCategories->count())
                                                                    @foreach ($category->childrenCategories as $child)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('products.category', $child->slug) }}">
                                                                                {{ $child->getTranslation('name') }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li class="text-muted">
                                                                        {{ translate('No Subcategories') }}</li>
                                                                @endif
                                                            </ul>
                                                        @endforeach

                                                    </div>

                                                </li>
                                            </ul>

                                        </div>

                                    </div> --}}
                                    <div class="accordion-wrapper mb-5">

                                        <div class="accordion mb-4" id="categoryAccordion">

                                            {{-- @foreach ($categories as $category)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                                            معدات الطهي والتحضير
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse"
                                                        data-bs-parent="#categoryAccordion">
                                                        <div class="accordion-body">
                                                            <ul class="list-unstyled mb-0">
                                                                <li><a href="#"
                                                                        class="text-dark text-decoration-none">مواقد
                                                                        غاز</a></li>
                                                                <li><a href="#"
                                                                        class="text-dark text-decoration-none">شوايات</a>
                                                                </li>
                                                                <li><a href="#"
                                                                        class="text-dark text-decoration-none">مقالي
                                                                        كهربائية</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach --}}

                                            @foreach (collect($categories)->where('featured', 1) as $category)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading-{{ $category->id }}">
                                                        <button
                                                            class="accordion-button @if (app()->getLocale() == 'sa') text-end @endif collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-{{ $category->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $category->id }}">
                                                            {{ $category->getTranslation('name') }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse-{{ $category->id }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading-{{ $category->id }}"
                                                        data-bs-parent="#categoryAccordion">
                                                        <div
                                                            class="accordion-body @if (app()->getLocale() == 'sa') text-end @endif ">
                                                            <ul class="list-unstyled mb-0">
                                                                @if ($category->childrenCategories && $category->childrenCategories->count())
                                                                    @foreach ($category->childrenCategories as $child)
                                                                        <li>
                                                                            <a href="{{ route('products.category', $child->slug) }}"
                                                                                class="text-dark text-decoration-none">
                                                                                ● {{ $child->getTranslation('name') }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li class="text-muted">
                                                                        {{ translate('No Subcategories') }}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach




                                            <!-- تقدر تضيف المزيد من العناصر بنفس الشكل -->
                                        </div>
                                    </div>


                                    {{-- <div class="@if (App::getLocale() == 'en' || App::getLocale() == 'cn') mega-menu-ltr @else mega-menu @endif" 
                                        id="megaMenu" 
                                        onmouseover="cancelHide()" 
                                        onmouseout="hideMegaMenu()">

                                        <!-- القائمة الرئيسية على اليمين -->
                                        <ul class="category-list">
                                            @foreach ($categories as $category)
                                                <li onmouseover="showSub(this)" data-sub="cat-{{ $category->id }}">
                                                    <a href="{{ route('products.category', $category->slug) }}" class="text-reset">
                                                        {{ $category->getTranslation('name') }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <!-- القوائم الفرعية لكل كاتيجوري -->
                                        @foreach ($categories as $category)
                                            <ul class="sub-category" id="cat-{{ $category->id }}">
                                                @if ($category->childrenCategories && $category->childrenCategories->count())
                                                    @foreach ($category->childrenCategories as $child)
                                                        <li>
                                                            <a href="{{ route('products.category', $child->slug) }}">
                                                                {{ $child->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="text-muted">{{ translate('No Subcategories') }}</li>
                                                @endif
                                            </ul>
                                        @endforeach

                                    </div> --}}


                                    <!-- Price range -->
                                    {{-- <div class="bg-white border mb-3">
                                        <div class="fs-16 fw-700 p-3">
                                            {{ translate('Price range') }}
                                        </div>
                                        <div class="p-3 mr-3">
                                            @php
                                                $product_count = get_products_count();
                                            @endphp
                                            <div class="aiz-range-slider">
                                                <div id="input-slider-range"
                                                    data-range-value-min="@if ($product_count < 1) 0 @else {{ get_product_min_unit_price() }} @endif"
                                                    data-range-value-max="@if ($product_count < 1) 0 @else {{ get_product_max_unit_price() }} @endif">
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                            @if (isset($min_price)) data-range-value-low="{{ $min_price }}"
                                                            @elseif($products->min('unit_price') > 0)
                                                                data-range-value-low="{{ $products->min('unit_price') }}"
                                                            @else
                                                                data-range-value-low="0" @endif
                                                            id="input-slider-range-value-low"></span>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                            @if (isset($max_price)) data-range-value-high="{{ $max_price }}"
                                                            @elseif($products->max('unit_price') > 0)
                                                                data-range-value-high="{{ $products->max('unit_price') }}"
                                                            @else
                                                                data-range-value-high="0" @endif
                                                            id="input-slider-range-value-high"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hidden Items -->
                                        <input type="hidden" name="min_price" value="">
                                        <input type="hidden" name="max_price" value="">
                                    </div> --}}

                                    <!-- Attributes -->
                                    {{-- @foreach ($attributes as $attribute)
                                        <div class="bg-white border mb-3">
                                            <div class="fs-16 fw-700 p-3">
                                                <a href="#"
                                                    class="dropdown-toggle text-dark filter-section collapsed d-flex align-items-center justify-content-between"
                                                    data-toggle="collapse"
                                                    data-target="#collapse_{{ str_replace(' ', '_', $attribute->name) }}"
                                                    style="white-space: normal;">
                                                    {{ $attribute->getTranslation('name') }}
                                                </a>
                                            </div>
                                            @php
                                                $show = '';
                                                foreach ($attribute->attribute_values as $attribute_value) {
                                                    if (in_array($attribute_value->value, $selected_attribute_values)) {
                                                        $show = 'show';
                                                    }
                                                }
                                            @endphp
                                            <div class="collapse {{ $show }}"
                                                id="collapse_{{ str_replace(' ', '_', $attribute->name) }}">
                                                <div class="p-3 aiz-checkbox-list">
                                                    @foreach ($attribute->attribute_values as $attribute_value)
                                                        <label class="aiz-checkbox mb-3">
                                                            <input type="checkbox" name="selected_attribute_values[]"
                                                                value="{{ $attribute_value->value }}"
                                                                @if (in_array($attribute_value->value, $selected_attribute_values)) checked @endif
                                                                onchange="filter()">
                                                            <span class="aiz-square-check"></span>
                                                            <span
                                                                class="fs-14 fw-400 text-dark">{{ $attribute_value->value }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}

                                    <!-- Color -->
                                    {{-- @if (get_setting('color_filter_activation'))
                                        <div class="bg-white border mb-3">
                                            <div class="fs-16 fw-700 p-3">
                                                <a href="#"
                                                    class="dropdown-toggle text-dark filter-section collapsed d-flex align-items-center justify-content-between"
                                                    data-toggle="collapse" data-target="#collapse_color">
                                                    {{ translate('Filter by color') }}
                                                </a>
                                            </div>
                                            @php
                                                $show = '';
                                                foreach ($colors as $key => $color) {
                                                    if (isset($selected_color) && $selected_color == $color->code) {
                                                        $show = 'show';
                                                    }
                                                }
                                            @endphp
                                            <div class="collapse {{ $show }}" id="collapse_color">
                                                <div class="p-3 aiz-radio-inline">
                                                    @foreach ($colors as $key => $color)
                                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                                            data-title="{{ $color->name }}">
                                                            <input type="radio" name="color"
                                                                value="{{ $color->code }}" onchange="filter()"
                                                                @if (isset($selected_color) && $selected_color == $color->code) checked @endif>
                                                            <span
                                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                <span class="size-30px d-inline-block rounded"
                                                                    style="background: {{ $color->code }};"></span>
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contents -->
                    <div class="col-xl-9">

                        @if (addon_is_activated('preorder') && Route::currentRouteName() == 'search')
                            <div class="product-tab">
                                @php
                                    $activeClasses = 'bg-soft-dark mr-2 my-2 text-white';
                                    $inActiveClasses = 'preorder-border-dashed m-2 text-muted  fw-600';
                                @endphp
                                <div class="p-3 aiz-radio-inline">
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('General Products') }}">
                                        <input type="radio" name="product_type" value="general_product"
                                            onchange="filter()" @if (isset($product_type) && $product_type == 'general_product') checked @endif>
                                        <span
                                            class="badge badge-inline fs-12 p-3 rounded-3 {{ $product_type == 'general_product' ? $activeClasses : $inActiveClasses }}">
                                            {{ translate('General Products') }}
                                            <span
                                                class="badge badge-inline bg-soft-dark fs-12 mr-2 my-2 p-1 rounded-3 text-white"
                                                style="background: {{ translate('General Products') }};"></span>
                                        </span>
                                    </label>
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('Preorder Products') }}">
                                        <input type="radio" name="product_type" value="preorder_product"
                                            onchange="filter()" @if (isset($product_type) && $product_type == 'preorder_product') checked @endif>
                                        <span
                                            class="badge badge-inline fs-12 p-3 rounded-3 {{ $product_type == 'preorder_product' ? $activeClasses : $inActiveClasses }}">
                                            {{ translate('Preorder Products') }}
                                            <span
                                                class="badge badge-inline bg-soft-dark fs-12 mr-2 my-2 p-1 rounded-3 text-white"
                                                style="background: {{ translate('Preorder Products') }};"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        <!-- Breadcrumb -->
                        <ul class="breadcrumb bg-transparent py-0 px-1">
                            <li class="breadcrumb-item has-transition opacity-50 hov-opacity-100">
                                <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                            </li>
                            @if (!isset($category_id))
                                <li class="breadcrumb-item fw-700  text-dark">
                                    "{{ translate('All Categories') }}"
                                </li>
                            @else
                                <li class="breadcrumb-item opacity-50 hov-opacity-100">
                                    <a class="text-reset"
                                        href="{{ route('search') }}">{{ translate('All Categories') }}</a>
                                </li>
                            @endif
                            <li class="text-dark fw-600 breadcrumb-item">
                                @if (isset($category_id))
                                    @php
                                        $categoryForName = \App\Models\Category::find($category_id);
                                    @endphp
                                    "{{ $categoryForName->getTranslation('name') }}"
                                @endif
                            </li>
                        </ul>

                        <!-- Top Filters -->
                        <div>
                            <div class="row gutters-5 flex-wrap align-items-center">
                                <div class="col-lg col-10">
                                    @if (isset($category_id))
                                        <h1 class="fs-20 fs-md-24 fw-700 text-dark">
                                            {{ $categoryForName->getTranslation('name') }}
                                        </h1>
                                    @endif
                                    <input type="hidden" name="keyword" value="{{ $query }}">
                                </div>
                                <div class="col-2 col-lg-auto d-xl-none mb-lg-3 text-right">
                                    <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle"
                                        data-target=".aiz-filter-sidebar">
                                        <i class="la la-filter la-2x"></i>
                                    </button>
                                </div>

                                <div class="col-6 col-lg-auto mb-3 w-lg-200px">
                                    <select class="form-control form-control-sm aiz-selectpicker rounded-0" name="sort_by"
                                        onchange="filter()">
                                        <option value="">{{ translate('Sort by') }}</option>
                                        <option value="newest"
                                            @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>
                                            {{ translate('Newest') }}</option>
                                        <option value="oldest"
                                            @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>
                                            {{ translate('Oldest') }}</option>
                                        <option value="price-asc"
                                            @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>
                                            {{ translate('Price low to high') }}</option>
                                        <option value="price-desc"
                                            @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>
                                            {{ translate('Price high to low') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3">
                            @foreach ($products as $key => $product)
                                <div class="col d-flex">
                                    @if (isset($product_type) && $product_type == 'preorder_product')
                                        @include('preorder.frontend.product_box3', [
                                            'product' => $product,
                                        ])
                                    @else
                                        @include(
                                            'frontend.' .
                                                get_setting('homepage_select') .
                                                '.partials.product_box_1',
                                            ['product' => $product]
                                        )
                                    @endif
                                </div>
                            @endforeach
                        </div>


                        <div class="d-flex justify-content-center">
                            <div class="aiz-pagination">
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </form>
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


