<style>
    :root {
        --nav-brand: #ae2025;
        --nav-brand-hover: #8f181d;
    }

    .top-bar a {
        transition: color .2s ease;
    }

    .top-bar a:hover {
        color: var(--nav-brand) !important;
    }

    .nav-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #334155 !important;
        text-decoration: none !important;
        transition: all .2s ease;
        font-size: 16px;
        border: 1px solid #e2e8f0;
    }

    .nav-icon-btn:hover {
        background: var(--nav-brand);
        color: #fff !important;
        border-color: var(--nav-brand);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(174, 32, 37, 0.25);
    }

    .nav-search-form {
        max-width: 680px;
        width: 100%;
        margin: 0 auto;
    }

    .nav-search-form .search-wrapper {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 9999px;
        padding: 3px 4px 3px 16px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        transition: all 0.2s ease;
    }

    [dir="rtl"] .nav-search-form .search-wrapper {
        padding: 3px 16px 3px 4px;
    }

    .nav-search-form .search-wrapper:focus-within {
        border-color: var(--nav-brand);
        box-shadow: 0 0 0 3px rgba(174, 32, 37, 0.12);
    }

    .nav-search-form .form-control {
        border: none !important;
        box-shadow: none !important;
        background: transparent;
        font-size: 14px;
        padding: 6px 12px;
        color: #1e293b;
        font-family: inherit;
    }

    .nav-search-form button[type="submit"] {
        background-color: var(--nav-brand) !important;
        color: #ffffff !important;
        border-radius: 9999px;
        padding: 8px 22px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        transition: background-color .2s ease;
    }

    .nav-search-form button[type="submit"]:hover {
        background-color: var(--nav-brand-hover) !important;
    }

    .main-nav-links {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 24px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .main-nav-links > li > a {
        color: #334155;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        padding: 6px 10px;
        border-radius: 6px;
        transition: color .2s ease, background-color .2s ease;
        display: inline-block;
    }

    .main-nav-links > li > a:hover {
        color: var(--nav-brand) !important;
        background-color: rgba(174, 32, 37, 0.04);
    }

    .logo-header {
        max-height: 48px;
        width: auto;
        object-fit: contain;
    }

    /* Mega menu styling */
    .mega-category {
        position: static !important;
    }

    .mega-menu,
    .mega-menu-ltr {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1050;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        border: 1px solid #e2e8f0;
        border-radius: 0 0 12px 12px;
    }
</style>

<!-- Desktop Header -->
<header class="d-none d-lg-block bg-white border-bottom pc">
    <!-- Top Bar -->
    <div class="top-bar bg-light border-bottom py-1.5 px-3" style="font-size: 13px;">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2 text-muted">
                <img src="https://flagcdn.com/sa.svg" width="18" height="13" alt="SA Flag" class="rounded-sm">
                <span>
                    @if (app()->getLocale() == 'sa')
                        متجرك الأفضل لكل معدات المطاعم والمقاهي
                    @elseif(app()->getLocale() == 'cn')
                        您購買所有餐廳和咖啡館設備的一站式商店。
                    @else
                        Your one-stop shop for all your restaurant and cafe equipment.
                    @endif
                </span>
            </div>
            <div class="d-flex align-items-center gap-3" style="font-size: 13px;">
                <a href="{{ route('seller.login') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        سجل كبائع
                    @elseif(app()->getLocale() == 'cn')
                        註冊成為賣家
                    @else
                        {{ translate('Register as a Seller') }}
                    @endif
                </a>
                <span class="text-muted">|</span>
                <a href="{{ route('faq') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        الأسئلة الشائعة
                    @elseif(app()->getLocale() == 'cn')
                        常见问题
                    @else
                        FAQs
                    @endif
                </a>
                <span class="text-muted">|</span>
                <a href="{{ route('orders.track') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        تتبع طلبك
                    @elseif(app()->getLocale() == 'cn')
                        订单追踪
                    @else
                        Track Your Order
                    @endif
                </a>
                <span class="text-muted">|</span>

                <!-- Language Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle py-0 px-2" type="button"
                        id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="languageDropdown">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-1.5"
                                    href="{{ url('language/' . $language->code) }}">
                                    @if ($language->code == 'sa')
                                        <img src="https://flagcdn.com/sa.svg" width="18" alt="SA">
                                    @elseif($language->code == 'en')
                                        <img src="https://flagcdn.com/gb.svg" width="18" alt="EN">
                                    @elseif($language->code == 'cn')
                                        <img src="https://flagcdn.com/cn.svg" width="18" alt="CN">
                                    @elseif($language->code == 'fr')
                                        <img src="https://flagcdn.com/fr.svg" width="18" alt="FR">
                                    @elseif($language->code == 'tr')
                                        <img src="https://flagcdn.com/tr.svg" width="18" alt="TR">
                                    @endif
                                    <span>{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Nav -->
    <div class="container-xl py-3 px-3">
        <div class="row align-items-center gy-3">
            <!-- Logo -->
            <div class="col-lg-3 col-xl-2">
                <a class="navbar-brand d-inline-block" href="{{ route('home') }}">
                    @php $header_logo = get_setting('header_logo'); @endphp
                    @if ($header_logo)
                        <img src="{{ uploaded_asset($header_logo) }}" class="logo-header" alt="{{ get_setting('website_name') }}">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" class="logo-header" alt="{{ get_setting('website_name') }}">
                    @endif
                </a>
            </div>

            <!-- Search Form -->
            <div class="col-lg-6 col-xl-7">
                <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                    <div class="search-wrapper">
                        <input type="text" name="keyword" class="form-control"
                            placeholder="{{ translate('Search products, brands and categories...') }}">
                        <button class="btn" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>{{ translate('Search') }}</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Actions -->
            <div class="col-lg-3 col-xl-3">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-icon-btn" title="{{ translate('My Account') }}">
                            <i class="fa fa-user"></i>
                        </a>
                    @else
                        <a href="{{ route('user.login') }}" class="d-inline-flex align-items-center gap-1.5 text-dark text-decoration-none fw-semibold small px-2 py-1 rounded hover-bg">
                            <i class="fa fa-user-circle text-muted"></i>
                            <span>{{ translate('login') }}</span>
                        </a>
                    @endauth

                    <a href="{{ route('wishlists.index') }}" class="nav-icon-btn position-relative" title="{{ translate('Wishlist') }}">
                        <i class="fa fa-heart"></i>
                    </a>

                    @php
                        if (auth()->check()) {
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                        } else {
                            $tempUserId = session()->get('temp_user_id');
                            $cartCount = $tempUserId
                                ? \App\Models\Cart::where('temp_user_id', $tempUserId)->count()
                                : 0;
                        }
                    @endphp

                    <a href="javascript:void(0);" class="nav-icon-btn position-relative" id="nav-cart-area"
                        onclick="openCartOffcanvas()" title="{{ translate('Cart') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-count-span position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white"
                            style="font-size: 10px; min-width: 18px; padding: 3px 5px;">
                            {{ $cartCount }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="border-top mt-3 pt-2 position-relative">
            <ul class="main-nav-links">
                <li><a href="{{ route('home') }}">{{ translate('Home') }}</a></li>
                <li><a href="{{ route('about.us') }}">{{ translate('About') }}</a></li>
                <li class="position-relative mega-category">
                    <a href="{{ route('search') }}" onmouseover="showMegaMenu()" onmouseout="hideMegaMenu()">
                        {{ translate('All Products') }} <i class="fa-solid fa-chevron-down ms-1 text-muted" style="font-size: 11px;"></i>
                    </a>

                    <!-- Mega Menu -->
                    <div class="@if (App::getLocale() == 'en' || App::getLocale() == 'cn') mega-menu-ltr @else mega-menu @endif"
                        id="megaMenu" onmouseover="cancelHide()" onmouseout="hideMegaMenu()">
                        <ul class="category-list">
                            @foreach ($categories->where('featured', 1) as $category)
                                <li data-sub="cat-{{ $category->id }}" onmouseover="showSub(this)">
                                    <a href="{{ route('products.category', $category->slug) }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="width: 15%; margin: 0 10px;">
                                                <img src="{{ uploaded_asset($category->icon) }}"
                                                    style="width: 28px; height: 28px; object-fit: contain;">
                                            </div>
                                            <div style="width: 85%;">
                                                {{ $category->getTranslation('name') }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="subcategories-wrapper">
                            <div class="sub-category-container" id="activeSubCategory"></div>
                            @foreach ($categories as $category)
                                <template id="cat-{{ $category->id }}">
                                    @if ($category->childrenCategories && $category->childrenCategories->count())
                                        @foreach ($category->childrenCategories as $child)
                                            <div class="sub-group">
                                                <h5 class="sub-group-title" data-sub="subcat-{{ $child->id }}">
                                                    <a href="{{ route('products.category', $child->slug) }}">
                                                        ● {{ $child->getTranslation('name') }}
                                                    </a>
                                                </h5>
                                                @if ($child->childrenCategories && $child->childrenCategories->count())
                                                    <ul class="third-level-list">
                                                        @foreach ($child->childrenCategories as $grandChild)
                                                            <li>
                                                                <a href="{{ route('products.category', $grandChild->slug) }}">
                                                                    {{ $grandChild->getTranslation('name') }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted p-3">{{ translate('No Subcategories') }}</p>
                                    @endif
                                </template>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li><a href="{{ route('get-a-quote') }}">{{ translate('get_quote') }}</a></li>
                <li><a href="{{ route('service-request') }}">{{ translate('service_request') }}</a></li>
                <li><a href="{{ route('maintainence-request') }}">{{ translate('maintainence_request') }}</a></li>
                <li><a href="{{ route('all-our-partners') }}">{{ translate('partners') }}</a></li>
            </ul>
        </div>
    </div>
</header>

<!-- Mobile Header -->
<header class="d-lg-none bg-white border-bottom sticky-top mob">
    <nav class="navbar navbar-light bg-white py-2 px-3">
        <div class="container-fluid d-flex align-items-center justify-content-between p-0">
            <!-- Toggler Icon -->
            <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo -->
            <a class="navbar-brand mx-auto" href="{{ route('home') }}">
                @php $header_logo = get_setting('header_logo'); @endphp
                @if ($header_logo)
                    <img src="{{ uploaded_asset($header_logo) }}" class="logo-header" style="max-height: 40px;" alt="Logo">
                @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" class="logo-header" style="max-height: 40px;" alt="Logo">
                @endif
            </a>

            <!-- Cart Button -->
            <a href="javascript:void(0);" class="nav-icon-btn position-relative" style="width: 38px; height: 38px;" onclick="openCartOffcanvas()">
                <i class="fa fa-shopping-cart" style="font-size: 15px;"></i>
                <span class="cart-count-span position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white"
                    style="font-size: 9px; min-width: 16px; padding: 2px 4px;">
                    {{ $cartCount }}
                </span>
            </a>
        </div>

        <!-- Mobile Search Bar -->
        <div class="w-100 mt-2">
            <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                <div class="search-wrapper" style="padding: 2px 3px 2px 12px;">
                    <input type="text" name="keyword" class="form-control" style="font-size: 13px; padding: 4px 8px;"
                        placeholder="{{ translate('Search products...') }}">
                    <button class="btn py-1 px-3" type="submit" style="font-size: 13px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start" style="padding-bottom: 80px;" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold text-dark">{{ get_setting('website_name') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-3">
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-home text-muted"></i> {{ translate('Home') }}
                    </a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('about.us') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-info-circle text-muted"></i> {{ translate('About') }}
                    </a>
                </li>

                <!-- Products Accordion -->
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                        <span class="d-flex align-items-center gap-2">
                            <i class="fa fa-th-large text-muted"></i> {{ translate('All Products') }}
                        </span>
                        <i class="fa fa-chevron-down text-muted" style="font-size: 12px;"></i>
                    </a>

                    <div class="collapse mt-2" id="productsMenu">
                        <ul class="list-unstyled @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') ps-3 @else pe-3 @endif">
                            @foreach ($categories->where('featured', 1) as $category)
                                <li class="mb-2">
                                    <a class="text-decoration-none text-dark d-flex align-items-center justify-content-between py-1" data-bs-toggle="collapse"
                                        href="#sub-{{ $category->id }}" role="button" aria-expanded="false"
                                        aria-controls="sub-{{ $category->id }}">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ uploaded_asset($category->icon) }}"
                                                style="width: 22px; height: 22px; object-fit: contain;">
                                            <span class="fw-semibold small">{{ $category->getTranslation('name') }}</span>
                                        </div>
                                        @if ($category->childrenCategories && $category->childrenCategories->count())
                                            <i class="fa fa-chevron-down text-muted" style="font-size: 10px;"></i>
                                        @endif
                                    </a>

                                    @if ($category->childrenCategories && $category->childrenCategories->count())
                                        <div class="collapse @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') ps-3 @else pe-3 @endif mt-1" id="sub-{{ $category->id }}">
                                            <ul class="list-unstyled">
                                                @foreach ($category->childrenCategories as $sub)
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none text-muted small d-block py-1"
                                                            href="{{ route('products.category', $sub->slug) }}">
                                                            • {{ $sub->getTranslation('name') }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="mb-3">
                    <a href="{{ route('get-a-quote') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-file-invoice text-muted"></i> {{ translate('get_quote') }}
                    </a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('service-request') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-tools text-muted"></i> {{ translate('service_request') }}
                    </a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('maintainence-request') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-wrench text-muted"></i> {{ translate('maintainence_request') }}
                    </a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('all-our-partners') }}">
                        <i class="fa fa-handshake text-muted"></i> {{ translate('partners') }}
                    </a>
                </li>

                <hr class="my-3">

                @auth
                    <li class="mb-3">
                        <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                            <i class="fa fa-user-circle text-primary"></i> {{ translate('My Dashboard') }}
                        </a>
                    </li>
                @else
                    <li class="mb-3">
                        <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('user.login') }}">
                            <i class="fa fa-sign-in text-muted"></i> {{ translate('login') }}
                        </a>
                    </li>
                    <li class="mb-3">
                        <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('user.registration') }}">
                            <i class="fa fa-user-plus text-muted"></i> {{ translate('Register') }}
                        </a>
                    </li>
                @endauth

                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('wishlists.index') }}">
                        <i class="fa fa-heart text-muted"></i> {{ translate('Wishlist') }}
                    </a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('cart') }}">
                        <i class="fa fa-shopping-cart text-muted"></i> {{ translate('Cart') }}
                    </a>
                </li>
            </ul>

            <!-- Language Dropdown -->
            <div class="mt-4 pt-3 border-top">
                <label class="form-label small text-muted fw-bold mb-2">🌐 {{ translate('Language') }}</label>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary w-100 dropdown-toggle text-start d-flex align-items-center justify-content-between" type="button"
                        id="mobileLanguageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>🌐 {{ strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <ul class="dropdown-menu w-100 shadow-sm" aria-labelledby="mobileLanguageDropdown">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                    href="{{ url('language/' . $language->code) }}">
                                    @if ($language->code == 'sa')
                                        <img src="https://flagcdn.com/sa.svg" width="20" alt="SA">
                                    @elseif($language->code == 'en')
                                        <img src="https://flagcdn.com/gb.svg" width="20" alt="EN">
                                    @elseif($language->code == 'cn')
                                        <img src="https://flagcdn.com/cn.svg" width="20" alt="CN">
                                    @elseif($language->code == 'fr')
                                        <img src="https://flagcdn.com/fr.svg" width="20" alt="FR">
                                    @elseif($language->code == 'tr')
                                        <img src="https://flagcdn.com/tr.svg" width="20" alt="TR">
                                    @endif
                                    <span>{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function openCartOffcanvas() {
        const el = document.getElementById('cartOffcanvas');
        if (!el || typeof bootstrap === 'undefined') {
            window.location.href = "{{ route('cart') }}";
            return;
        }

        const open = function () {
            bootstrap.Offcanvas.getOrCreateInstance(el).show();
        };

        if (typeof refreshCartToast === 'function') {
            const request = refreshCartToast();
            if (request && typeof request.always === 'function') {
                request.always(open);
                return;
            }
        }

        open();
    }
</script>
