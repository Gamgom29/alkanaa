<!-- Desktop Header -->
<header class="d-none d-lg-block">
    <!-- Top Royal Blue Header -->
    <div class="royal-header-top py-2.5 px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-6">
            <!-- Brand Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-white no-underline">
                    @php $header_logo = get_setting('header_logo'); @endphp
                    @if ($header_logo)
                        <img src="{{ uploaded_asset($header_logo) }}" class="h-10 max-h-10 w-auto object-contain brightness-0 invert" alt="{{ get_setting('website_name') }}">
                    @else
                        <div class="flex items-center gap-2">
                            <span class="flex size-9 items-center justify-center rounded-full bg-cyan-400/20 text-cyan-300 ring-2 ring-cyan-400/50">
                                <i class="fa-solid fa-atom text-lg"></i>
                            </span>
                            <span class="text-xl font-extrabold tracking-wider text-white uppercase">{{ get_setting('website_name') ?? 'ALNASSER' }}</span>
                        </div>
                    @endif
                </a>
            </div>

            <!-- Search Pill -->
            <div class="flex-1 max-w-xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="w-full m-0">
                    <div class="header-search-pill">
                        <button type="submit" aria-label="Search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="text" name="keyword"
                            placeholder="@if (app()->getLocale() == 'sa') أبحث عن منتج... @else {{ translate('Search for products...') }} @endif"
                            class="focus:outline-none">
                    </div>
                </form>
            </div>

            <!-- Action Icons & Language -->
            <div class="flex items-center gap-3.5 flex-shrink-0">
                <!-- Wishlist -->
                <a href="{{ route('wishlists.index') }}" class="header-icon-action" title="{{ translate('Wishlist') }}">
                    <i class="fa-regular fa-heart"></i>
                    @php
                        $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
                    @endphp
                    <span class="header-icon-badge">{{ $wishlistCount }}</span>
                </a>

                <!-- Cart -->
                @php
                    if (auth()->check()) {
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                    } else {
                        $tempUserId = session()->get('temp_user_id');
                        $cartCount = $tempUserId ? \App\Models\Cart::where('temp_user_id', $tempUserId)->count() : 0;
                    }
                @endphp
                <a href="javascript:void(0);" class="header-icon-action" id="nav-cart-area" onclick="openCartOffcanvas()" title="{{ translate('Cart') }}">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="header-icon-badge cart-count-span">{{ $cartCount }}</span>
                </a>

                <!-- Phone -->
                @php $phone = get_setting('contact_phone') ?? '966565124444'; @endphp
                <a href="tel:{{ $phone }}" class="header-icon-action" title="{{ translate('Call Us') }}">
                    <i class="fa-solid fa-phone"></i>
                </a>

                <!-- User Account -->
                @auth
                    <a href="{{ route('dashboard') }}" class="header-icon-action" title="{{ translate('My Account') }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('user.login') }}" class="header-icon-action" title="{{ translate('Login') }}">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @endauth

                <!-- Language Switcher -->
                <div class="dropdown relative">
                    <button class="flex items-center gap-1.5 text-xs font-semibold text-white/95 bg-white/10 hover:bg-white/20 px-2.5 py-1.5 rounded-full transition"
                        type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        @if (app()->getLocale() == 'sa')
                            <img src="https://flagcdn.com/sa.svg" width="16" height="12" alt="SA" class="rounded-sm">
                        @else
                            <img src="https://flagcdn.com/gb.svg" width="16" height="12" alt="GB" class="rounded-sm">
                        @endif
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-75"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-xl border border-neutral-100 p-1.5" aria-labelledby="langDropdown">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a class="dropdown-item flex items-center gap-2 px-3 py-1.5 text-xs font-medium rounded-lg text-neutral-700 hover:bg-neutral-100 hover:text-primary"
                                    href="{{ url('language/' . $language->code) }}">
                                    @if ($language->code == 'sa')
                                        <img src="https://flagcdn.com/sa.svg" width="16" alt="SA" class="rounded-sm">
                                    @elseif($language->code == 'en')
                                        <img src="https://flagcdn.com/gb.svg" width="16" alt="EN" class="rounded-sm">
                                    @elseif($language->code == 'cn')
                                        <img src="https://flagcdn.com/cn.svg" width="16" alt="CN" class="rounded-sm">
                                    @else
                                        <span class="text-xs">🌐</span>
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

    <!-- Sub-Navbar (Light Bar) -->
    <div class="bg-white border-b border-neutral-200/80 py-2.5 px-4 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Right Motto (in RTL) -->
            <div class="flex items-center gap-2 text-xs sm:text-sm font-bold text-neutral-800">
                <img src="https://flagcdn.com/sa.svg" width="20" height="15" alt="SA Flag" class="rounded-xs">
                <span class="text-[#0c234a]">الخيار الأول للمطابخ التجارية في السعودية</span>
            </div>

            <!-- Left Navigation Links -->
            <div class="flex items-center gap-5 text-sm font-semibold">
                <a href="{{ route('todays-deal') }}" class="flex items-center gap-1.5 text-neutral-700 hover:text-[#4868e6] transition no-underline">
                    <i class="fa-solid fa-percent text-xs text-rose-500"></i>
                    <span>منتجات مخفضة</span>
                </a>

                <a href="{{ route('about.us') }}" class="flex items-center gap-1.5 text-neutral-700 hover:text-[#4868e6] transition no-underline">
                    <i class="fa-regular fa-clock text-xs text-neutral-500"></i>
                    <span>من نحن</span>
                </a>

                <!-- Products Dropdown Button -->
                <div class="relative mega-category">
                    <a href="{{ route('search') }}"
                        onmouseover="showMegaMenu()" onmouseout="hideMegaMenu()"
                        class="inline-flex items-center gap-2 bg-[#4868e6] hover:bg-[#3753c8] text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-xs transition no-underline">
                        <i class="fa-solid fa-table-cells"></i>
                        <span>المنتجات</span>
                        <i class="fa-solid fa-chevron-down text-[9px]"></i>
                    </a>

                    <!-- Mega Menu Dropdown -->
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
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Header (Matching Exact Mobile Screenshot) -->
<header class="d-lg-none sticky-top shadow-xs">
    <!-- 1. Mobile Top Announcement -->
    <div class="bg-white border-b border-neutral-100 py-1 px-3 text-center">
        <div class="flex items-center justify-center gap-1.5 text-xs font-bold text-rose-600">
            <img src="https://flagcdn.com/sa.svg" width="16" height="12" alt="SA Flag" class="rounded-xs">
            <span>الخيار الأول للمطابخ التجارية في السعودية</span>
        </div>
    </div>

    <!-- 2. Mobile Brand Header Bar (Royal Blue) -->
    <div class="royal-header-top py-2.5 px-4 text-center flex items-center justify-center">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-white no-underline mx-auto">
            @php $header_logo = get_setting('header_logo'); @endphp
            @if ($header_logo)
                <img src="{{ uploaded_asset($header_logo) }}" class="h-7 w-auto object-contain brightness-0 invert" alt="Logo">
            @else
                <div class="flex items-center gap-2">
                    <span class="flex size-7 items-center justify-center rounded-full bg-cyan-400/20 text-cyan-300 ring-2 ring-cyan-400/50">
                        <i class="fa-solid fa-atom text-sm"></i>
                    </span>
                    <span class="text-lg font-extrabold tracking-wider text-white uppercase">{{ get_setting('website_name') ?? 'ALNASSER' }}</span>
                </div>
            @endif
        </a>
    </div>

    <!-- 3. Mobile Search & Action Sub-Bar -->
    <div class="bg-white border-b border-neutral-200 py-2 px-3">
        <div class="flex items-center gap-2">
            <!-- Menu button: القائمة ☰ -->
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg border border-neutral-200 bg-white text-xs font-bold text-neutral-800 shadow-2xs hover:bg-neutral-50 flex-shrink-0">
                <span>القائمة</span>
                <i class="fa-solid fa-bars text-xs"></i>
            </button>

            <!-- Search input with search icon on left -->
            <div class="flex-1">
                <form action="{{ route('search') }}" method="GET" class="m-0">
                    <div class="relative flex items-center rounded-lg border border-neutral-200 bg-white px-2.5 py-1 shadow-2xs focus-within:border-primary">
                        <button type="submit" class="p-0.5 text-neutral-400 focus:outline-none">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                        <input type="text" name="keyword"
                            placeholder="ابحث عن منتج"
                            class="w-full bg-transparent border-0 px-2 py-0.5 text-xs text-neutral-800 focus:outline-none">
                    </div>
                </form>
            </div>

            <!-- Profile icon -->
            @auth
                <a href="{{ route('dashboard') }}" class="flex size-8 items-center justify-center rounded-lg border border-neutral-200 bg-white text-neutral-700 shadow-2xs flex-shrink-0">
                    <i class="fa-solid fa-user text-xs"></i>
                </a>
            @else
                <a href="{{ route('user.login') }}" class="flex size-8 items-center justify-center rounded-lg border border-neutral-200 bg-white text-neutral-700 shadow-2xs flex-shrink-0">
                    <i class="fa-regular fa-user text-xs"></i>
                </a>
            @endauth
        </div>
    </div>

    <!-- Offcanvas Menu Drawer -->
    <div class="offcanvas offcanvas-start" style="padding-bottom: 80px;" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header bg-[#0c234a] text-white">
            <h5 class="offcanvas-title font-bold text-white">{{ get_setting('website_name') ?? 'ALNASSER' }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-3">
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-home text-primary"></i> {{ translate('Home') }}
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('todays-deal') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-percent text-rose-500"></i> منتجات مخفضة
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('about.us') }}" class="text-decoration-none fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fa fa-info-circle text-primary"></i> {{ translate('About') }}
                    </a>
                </li>

                <!-- Products Accordion -->
                <li class="mb-3">
                    <a class="text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                        <span class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-table-cells text-primary"></i> {{ translate('All Products') }}
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
            </ul>
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
