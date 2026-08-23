<!-- Desktop Header -->
<header class="d-none d-lg-block">
    <!-- Top Royal Blue Header -->
    <div class="royal-header-top py-3 px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-8">
            <!-- Brand Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-white no-underline">
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

            <!-- Centered Search Pill -->
            <div class="flex-1 max-w-xl mx-auto flex justify-center">
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
                    <button class="flex items-center gap-1.5 text-xs font-bold text-white bg-white/15 hover:bg-white/25 px-3 py-2 rounded-full transition"
                        type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        @if (app()->getLocale() == 'sa')
                            <img src="https://flagcdn.com/sa.svg" width="16" height="12" alt="SA" class="rounded-xs">
                        @else
                            <img src="https://flagcdn.com/gb.svg" width="16" height="12" alt="GB" class="rounded-xs">
                        @endif
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-75"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-xl border border-neutral-100 p-1.5" aria-labelledby="langDropdown">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a class="dropdown-item flex items-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-lg text-neutral-700 hover:bg-neutral-100 hover:text-[#4868e6]"
                                    href="{{ url('language/' . $language->code) }}">
                                    @if ($language->code == 'sa')
                                        <img src="https://flagcdn.com/sa.svg" width="16" alt="SA" class="rounded-xs">
                                    @elseif($language->code == 'en')
                                        <img src="https://flagcdn.com/gb.svg" width="16" alt="EN" class="rounded-xs">
                                    @elseif($language->code == 'cn')
                                        <img src="https://flagcdn.com/cn.svg" width="16" alt="CN" class="rounded-xs">
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
    <div class="bg-white border-b border-neutral-200 py-3 px-6 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Right Motto (in RTL) -->
            <div class="flex items-center gap-2 text-sm font-bold text-neutral-800">
                <img src="https://flagcdn.com/sa.svg" width="22" height="16" alt="SA Flag" class="rounded-xs">
                <span class="text-[#0c234a]">الخيار الأول للمطابخ التجارية في السعودية</span>
            </div>

            <!-- Left Navigation Links -->
            <div class="flex items-center gap-5 text-sm font-bold">
                <!-- Products Dropdown Button -->
                <div class="relative mega-category">
                    <a href="{{ route('search') }}"
                        onmouseover="showMegaMenu()" onmouseout="hideMegaMenu()"
                        class="inline-flex items-center gap-2 bg-[#4868e6] hover:bg-[#3753c8] text-white text-xs font-bold px-4 py-2 rounded-lg shadow-xs transition no-underline">
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

                <a href="{{ route('todays-deal') }}" class="flex items-center gap-1.5 text-neutral-700 hover:text-[#4868e6] transition no-underline">
                    <i class="fa-solid fa-percent text-xs text-rose-500"></i>
                    <span>منتجات مخفضة</span>
                </a>

                <a href="{{ route('about.us') }}" class="flex items-center gap-1.5 text-neutral-700 hover:text-[#4868e6] transition no-underline">
                    <i class="fa-regular fa-clock text-xs text-neutral-500"></i>
                    <span>من نحن</span>
                </a>
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

            <!-- Search input with search icon cleanly integrated -->
            <div class="flex-1">
                <form action="{{ route('search') }}" method="GET" class="m-0">
                    <div class="flex items-center w-full rounded-lg border border-neutral-300 bg-white px-2.5 py-1 focus-within:border-primary">
                        <input type="text" name="keyword"
                            placeholder="ابحث عن منتج"
                            class="w-full bg-transparent text-xs text-neutral-800 focus:outline-none"
                            style="border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important;">
                        <button type="submit" class="text-neutral-400 focus:outline-none p-0 ms-1"
                            style="border: none !important; background: transparent !important;">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Profile icon -->
            @auth
                <a href="{{ route('dashboard') }}" class="flex size-8 items-center justify-center rounded-lg border border-neutral-200 bg-white text-neutral-700 shadow-2xs flex-shrink-0" title="حسابي">
                    <i class="fa-solid fa-user text-xs"></i>
                </a>
            @else
                <a href="{{ route('user.login') }}" class="flex size-8 items-center justify-center rounded-lg border border-neutral-200 bg-white text-neutral-700 shadow-2xs flex-shrink-0" title="تسجيل الدخول">
                    <i class="fa-regular fa-user text-xs"></i>
                </a>
            @endauth
        </div>
    </div>

    <!-- Offcanvas Menu Drawer (RTL aligned matching Screenshot 2) -->
    <div class="offcanvas offcanvas-start" dir="rtl" style="padding-bottom: 80px;" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header bg-[#0c234a] text-white flex items-center justify-between p-3.5">
            <h5 class="offcanvas-title font-bold text-sm text-white m-0">{{ get_setting('website_name') ?? 'Al Qana\'a' }}</h5>
            <button type="button" class="btn-close btn-close-white m-0 p-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-3">
            <ul class="list-unstyled p-0 m-0">
                <li class="mb-2.5">
                    <a href="{{ route('home') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-house text-[#4868e6] text-sm"></i> <span>الصفحة الرئيسية</span>
                    </a>
                </li>
                <li class="mb-2.5">
                    <a href="{{ route('todays-deal') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-percent text-rose-500 text-sm"></i> <span>منتجات مخفضة</span>
                    </a>
                </li>
                <li class="mb-2.5">
                    <a href="{{ route('about.us') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-circle-info text-[#4868e6] text-sm"></i> <span>عن القناعة</span>
                    </a>
                </li>

                <!-- Products Accordion -->
                <li class="mb-2.5">
                    <a class="text-decoration-none font-bold text-neutral-800 d-flex justify-content-between align-items-center py-1.5 px-2 rounded hover:bg-neutral-100" data-bs-toggle="collapse"
                        href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                        <span class="d-flex align-items-center gap-2.5">
                            <i class="fa-solid fa-table-cells text-[#4868e6] text-sm"></i> <span>جميع المنتجات</span>
                        </span>
                        <i class="fa-solid fa-chevron-down text-neutral-400 text-xs"></i>
                    </a>

                    <div class="collapse mt-1 pe-3" id="productsMenu">
                        <ul class="list-unstyled p-0">
                            @foreach ($categories->where('featured', 1) as $category)
                                <li class="mb-1.5">
                                    <a class="text-decoration-none text-neutral-700 d-flex align-items-center justify-content-between py-1 px-2 rounded hover:bg-neutral-50" data-bs-toggle="collapse"
                                        href="#sub-{{ $category->id }}" role="button" aria-expanded="false"
                                        aria-controls="sub-{{ $category->id }}">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ uploaded_asset($category->icon) }}"
                                                style="width: 20px; height: 20px; object-fit: contain;">
                                            <span class="font-medium text-xs">{{ $category->getTranslation('name') }}</span>
                                        </div>
                                        @if ($category->childrenCategories && $category->childrenCategories->count())
                                            <i class="fa-solid fa-chevron-down text-neutral-400 text-[10px]"></i>
                                        @endif
                                    </a>

                                    @if ($category->childrenCategories && $category->childrenCategories->count())
                                        <div class="collapse pe-3 mt-1" id="sub-{{ $category->id }}">
                                            <ul class="list-unstyled p-0">
                                                @foreach ($category->childrenCategories as $sub)
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none text-neutral-500 text-xs d-block py-1"
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

                <li class="mb-2.5">
                    <a href="{{ route('get-a-quote') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-file-lines text-neutral-500 text-sm"></i> <span>عروض الاسعار</span>
                    </a>
                </li>
                <li class="mb-2.5">
                    <a href="{{ route('service-request') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-screwdriver-wrench text-neutral-500 text-sm"></i> <span>الخدمات الهندسية</span>
                    </a>
                </li>
                <li class="mb-2.5">
                    <a href="{{ route('maintainence-request') }}" class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100">
                        <i class="fa-solid fa-wrench text-neutral-500 text-sm"></i> <span>خدمات الصيانة</span>
                    </a>
                </li>
                <li class="mb-2.5">
                    <a class="text-decoration-none font-bold text-neutral-800 d-flex align-items-center gap-2.5 py-1.5 px-2 rounded hover:bg-neutral-100" href="{{ route('all-our-partners') }}">
                        <i class="fa-solid fa-handshake text-neutral-500 text-sm"></i> <span>شركاء النجاح</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
    let megaMenuTimer = null;

    function showMegaMenu() {
        clearTimeout(megaMenuTimer);
        const menu = document.getElementById('megaMenu');
        if (!menu) return;
        menu.style.display = 'flex';

        // Auto load first category if activeSubCategory is empty
        const container = document.getElementById('activeSubCategory');
        const firstLi = menu.querySelector('.category-list li');
        if (firstLi && (!container || container.innerHTML.trim() === '')) {
            showSub(firstLi);
        }
    }

    function hideMegaMenu() {
        megaMenuTimer = setTimeout(function () {
            const menu = document.getElementById('megaMenu');
            if (menu) {
                menu.style.display = 'none';
            }
        }, 200);
    }

    function cancelHide() {
        clearTimeout(megaMenuTimer);
    }

    function showSub(el) {
        if (!el) return;
        const subId = el.getAttribute('data-sub');
        const template = document.getElementById(subId);
        const container = document.getElementById('activeSubCategory');
        if (template && container) {
            container.innerHTML = template.innerHTML;
        }

        const list = el.closest('.category-list');
        if (list) {
            list.querySelectorAll('li').forEach(li => li.classList.remove('active-cat'));
            el.classList.add('active-cat');
        }
    }

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
