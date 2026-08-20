<header class="bg-light border-bottom pc">
    <!-- Top Bar -->
    <div class="top-bar bg-light border-bottom py-1 px-3" style="font-size: 13px;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="text-end text-muted">
                @if (app()->getLocale() == 'sa')
                    متجرك الأفضل لكل معدات المطاعم والمقاهي
                @elseif(app()->getLocale() == 'cn')
                    您購買所有餐廳和咖啡館設備的一站式商店。
                @else
                    Your one-stop shop for all your restaurant and cafe equipment.
                @endif
                <img src="https://flagcdn.com/sa.svg" width="20" alt="SA Flag" style="margin-right: 5px;">
            </div>
            <div class="text-start d-flex align-items-center gap-2 flex-wrap" style="font-size: 13px;">

                <a href="{{ route('seller.login') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        سجل كبائع
                    @elseif(app()->getLocale() == 'cn')
                        註冊成為賣家
                    @else
                        {{ translate('Register as a Seller') }}
                    @endif
                </a>
                <span class="mx-1">|</span>
                <a href="{{ route('faq') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        الأسئلة الشائعة
                    @elseif(app()->getLocale() == 'cn')
                        常见问题
                    @else
                        FAQs
                    @endif
                </a>
                <span class="mx-1">|</span>

                <a href="{{ route('orders.track') }}" class="text-decoration-none text-dark">
                    @if (app()->getLocale() == 'sa')
                        تتبع طلبك
                    @elseif(app()->getLocale() == 'cn')
                        订单追踪
                    @else
                        Track Your Order
                    @endif
                </a>

                <span class="mx-1">|</span>

                <!-- Language Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                        id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{ url('language/' . $language->code) }}">
                                    @if ($language->code == 'sa')
                                        <img src="https://flagcdn.com/sa.svg" width="20" alt="SA">
                                    @elseif($language->code == 'en')
                                        <img src="https://flagcdn.com/gb.svg" width="20" alt="EN">
                                    @elseif($language->code == 'cn')
                                        <img src="https://flagcdn.com/cn.svg" width="20" alt="CN">
                                        {{-- i want to add turkish and france another two language --}}
                                    @elseif($language->code == 'fr')
                                        <img src="https://flagcdn.com/fr.svg" width="20" alt="FR">
                                    @elseif($language->code == 'tr')
                                        <img src="https://flagcdn.com/tr.svg" width="20" alt="TR">
                                    @endif
                                    {{ $language->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Middle Nav -->
    <div class="container-fluid pe-5 ps-5">
        <div class="row justify-content-between align-items-center py-2">
            <div class="col-xl-2 col-lg-2 col-md-2 my-auto">
                <a class="navbar-brand" href="{{ route('home') }}">
                    @php $header_logo = get_setting('header_logo'); @endphp
                    @if ($header_logo)
                        <img src="{{ uploaded_asset($header_logo) }}" class="logo-header">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" class="logo-header">
                    @endif
                </a>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 my-auto">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <button class="btn text-white rounded-0" type="submit" style="background-color: #ae2025;">
                            <i class="fa-solid fa-magnifying-glass m-1"></i> {{ translate('Search') }}
                        </button>
                        <input type="text" name="keyword" class="form-control mb-0 rounded-0"
                            placeholder="{{ translate('Search...') }}">
                    </div>
                </form>
            </div>
            <div class="col-xl-3">
                <div class="d-flex w-100 align-items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-dark fs-5"><i class="fa fa-user"></i></a>
                    @else
                        <a href="{{ route('user.login') }}"
                            class="text-dark text-decoration-none small">{{ translate('login') }}</a>
                        <a href="{{ route('user.login') }}" class="text-dark fs-5"><i class="fa fa-user"></i></a>
                    @endauth
                    <a href="{{ route('wishlists.index') }}" class="text-dark fs-5 position-relative">
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

                    <a href="javascript:void(0);" class="text-dark fs-5 position-relative" id="nav-cart-area"
                        onclick="openCartOffcanvas()">
                        <i class="fa fa-shopping-cart"></i>
                        <span
                            class="cart-count-span position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark"
                            style="font-size: 10px;">
                            {{ $cartCount }}
                        </span>
                    </a>

                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="row justify-content-center text-center">

            <div class="col-xl-8 col-lg-8 col-md-8 mb-2">
                <ul
                    style="display: flex; gap: 26px; list-style: none; padding: 0; margin: 0; font-size: 16px; justify-content: center;">
                    <li><a href="{{ route('home') }}" class=" text-dark">{{ translate('Home') }}</a></li>
                    <li><a href="{{ route('about.us') }}" class=" text-dark">{{ translate('About') }}</a></li>
                    <li class="nav-item position-relative mega-category">
                        <a href="{{ route('search') }}" class=" text-dark nav-link" style="font-size: 16px;"
                            onmouseover="showMegaMenu()" onmouseout="hideMegaMenu()">
                            {{ translate('All Products') }}
                        </a>

                        <!-- Mega Menu -->
                        <div class="@if (App::getLocale() == 'en' || App::getLocale() == 'cn') mega-menu-ltr @else mega-menu @endif"
                            id="megaMenu" onmouseover="cancelHide()" onmouseout="hideMegaMenu()">
                            <ul class="category-list">
                                @foreach ($categories->where('featured', 1) as $category)
                                    <li data-sub="cat-{{ $category->id }}" onmouseover="showSub(this)">
                                        <a href="{{ route('products.category', $category->slug) }}">
                                            <div class="d-flex justify-content-between">
                                                <div style="width: 15%; margin: 0 10px;">
                                                    <img src="{{ uploaded_asset($category->icon) }}"
                                                        style="width: 30px; height: 30px;">
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
                                                    <h5 class="sub-group-title"
                                                        data-sub="subcat-{{ $child->id }}">
                                                        <a href="{{ route('products.category', $child->slug) }}">
                                                            ● {{ $child->getTranslation('name') }}
                                                        </a>
                                                    </h5>
                                                    @if ($child->childrenCategories && $child->childrenCategories->count())
                                                        <ul class="third-level-list">
                                                            @foreach ($child->childrenCategories as $grandChild)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('products.category', $grandChild->slug) }}">
                                                                        {{ $grandChild->getTranslation('name') }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">{{ translate('No Subcategories') }}</p>
                                        @endif
                                    </template>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li><a href="{{ route('get-a-quote') }}"
                            class="text-decoration-none text-dark">{{ translate('get_quote') }}</a></li>
                    <li><a href="{{ route('service-request') }}"
                            class="text-decoration-none text-dark">{{ translate('service_request') }}</a></li>
                    <li><a href="{{ route('maintainence-request') }}"
                            class="text-decoration-none text-dark">{{ translate('maintainence_request') }}</a></li>
                    <li>
                        <a class="text-decoration-none text-dark"
                            href="{{ route('all-our-partners') }}">{{ translate('partners') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<header class="mob">
    <!-- Mobile Navbar with Dynamic Mega Menu -->
    <nav class="navbar navbar-light bg-light d-md-none">
        <div class="container-fluid justify-content-between">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                @php $header_logo = get_setting('header_logo'); @endphp
                @if ($header_logo)
                    <img src="{{ uploaded_asset($header_logo) }}" class="logo-header" alt="Logo">
                @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" class="logo-header" alt="Logo">
                @endif
            </a>

            <!-- Toggler Icon -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start" style="padding-bottom: 80px" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-3">
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-dark">
                        {{ translate('Home') }}</a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('about.us') }}" class="text-decoration-none fw-bold text-dark">
                        {{ translate('About') }}</a>
                </li>

                <!-- Products Accordion -->
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-block" data-bs-toggle="collapse"
                        href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                        {{ translate('All Products') }}
                    </a>

                    <div class="collapse" id="productsMenu">
                        <ul class="mt-3 @if (app()->getLocale() == 'en' || app()->getLocale() == 'cn') p-0 @else ps-3 @endif">
                            @foreach ($categories->where('featured', 1) as $category)
                                <li class="mb-3">
                                    <a class="text-decoration-none text-muted d-block" data-bs-toggle="collapse"
                                        href="#sub-{{ $category->id }}" role="button" aria-expanded="false"
                                        aria-controls="sub-{{ $category->id }}">
                                        <div class="d-flex justify-content-between">
                                            <div style="margin: 0 10px;">
                                                <img src="{{ uploaded_asset($category->icon) }}"
                                                    style="width: 30px; height: 30px;">
                                            </div>
                                            <div style="width: 85%; font-weight:800;">
                                                {{ $category->getTranslation('name') }}
                                            </div>
                                        </div>
                                    </a>

                                    @if ($category->childrenCategories && $category->childrenCategories->count())
                                        <div class="collapse" id="sub-{{ $category->id }}">
                                            <ul class="pe-3 mt-1">
                                                @foreach ($category->childrenCategories as $sub)
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none text-muted d-block"
                                                            data-bs-toggle="collapse"
                                                            href="#subsub-{{ $sub->id }}" role="button"
                                                            aria-expanded="false"
                                                            aria-controls="subsub-{{ $sub->id }}">
                                                            - {{ $sub->getTranslation('name') }}
                                                        </a>

                                                        @if ($sub->childrenCategories && $sub->childrenCategories->count())
                                                            <div class="collapse" id="subsub-{{ $sub->id }}">
                                                                <ul class="ps-3 mt-1">
                                                                    @foreach ($sub->childrenCategories as $subsub)
                                                                        <li>
                                                                            <a href="{{ route('products.category', $subsub->slug) }}"
                                                                                class="text-decoration-none text-muted">
                                                                                --
                                                                                {{ $subsub->getTranslation('name') }}
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
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="mb-3">
                    <a href="{{ route('get-a-quote') }}"
                        class="text-decoration-none fw-bold text-dark">{{ translate('get_quote') }}</a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('service-request') }}"
                        class="text-decoration-none fw-bold text-dark">{{ translate('service_request') }}</a>
                </li>

                <li class="mb-3">
                    <a href="{{ route('maintainence-request') }}"
                        class="text-decoration-none fw-bold text-dark">{{ translate('maintainence_request') }}</a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark"
                        href="{{ route('all-our-partners') }}">{{ translate('partners') }}</a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark"
                        href="{{ route('user.login') }}">{{ translate('login') }}</a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark"
                        href="{{ route('wishlists.index') }}">{{ translate('Wishlist') }}</a>
                </li>
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark"
                        href="{{ route('cart') }}">{{ translate('Cart') }}</a>
                </li>
            </ul>
            <!-- Language Dropdown -->
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary w-100 dropdown-toggle" type="button"
                    id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    🌐 {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="languageDropdown">
                    @foreach (get_all_active_language() as $language)
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2"
                                href="{{ url('language/' . $language->code) }}">
                                @if ($language->code == 'sa')
                                    <img src="https://flagcdn.com/sa.svg" width="20" alt="SA">
                                @elseif($language->code == 'en')
                                    <img src="https://flagcdn.com/gb.svg" width="20" alt="EN">
                                @elseif($language->code == 'cn')
                                    <img src="https://flagcdn.com/cn.svg" width="20" alt="CN">
                                @endif
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
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
