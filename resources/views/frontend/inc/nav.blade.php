{{--
    Storefront header. Converted from Bootstrap/AIZ (data-toggle, data-bs-toggle,
    onmouseover="showMegaMenu()") to Tailwind + Alpine. Note: the mega-menu
    hover handlers this used to call (showMegaMenu/hideMegaMenu/showSub/
    cancelHide) didn't exist anywhere in the codebase before this conversion
    — the category mega menu never actually worked; it's implemented fresh
    here with Alpine, not ported.
--}}
<header class="hidden md:block bg-neutral-50 border-b border-neutral-200">
    <!-- Top Bar -->
    <div class="border-b border-neutral-200 py-1.5 px-6 text-xs">
        <div class="flex justify-between items-center gap-4">
            <div class="flex items-center gap-2 text-neutral-500">
                @if (app()->getLocale() == 'sa')
                    متجرك الأفضل لكل معدات المطاعم والمقاهي
                @elseif(app()->getLocale() == 'cn')
                    您購買所有餐廳和咖啡館設備的一站式商店。
                @else
                    Your one-stop shop for all your restaurant and cafe equipment.
                @endif
            </div>
            <div class="flex items-center gap-3 flex-wrap text-neutral-600">
                <a href="{{ route('seller.login') }}" class="hover:text-neutral-900">
                    @if (app()->getLocale() == 'sa') سجل كبائع
                    @elseif(app()->getLocale() == 'cn') 註冊成為賣家
                    @else {{ translate('Register as a Seller') }}
                    @endif
                </a>
                <span class="text-neutral-300">|</span>
                <a href="{{ route('faq') }}" class="hover:text-neutral-900">
                    @if (app()->getLocale() == 'sa') الأسئلة الشائعة
                    @elseif(app()->getLocale() == 'cn') 常见问题
                    @else FAQs
                    @endif
                </a>
                <span class="text-neutral-300">|</span>
                <a href="{{ route('orders.track') }}" class="hover:text-neutral-900">
                    @if (app()->getLocale() == 'sa') تتبع طلبك
                    @elseif(app()->getLocale() == 'cn') 订单追踪
                    @else Track Your Order
                    @endif
                </a>
                <span class="text-neutral-300">|</span>

                <div x-data="dropdown()" class="relative">
                    <button type="button" x-on:click="toggle" class="flex items-center gap-1 rounded border border-neutral-300 px-2 py-1 hover:bg-white">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul x-show="open" x-on:click.outside="close" x-transition class="absolute right-0 mt-1 w-44 rounded-md border border-neutral-200 bg-white py-1 shadow-md z-20" style="display: none;">
                        @foreach (get_all_active_language() as $language)
                            <li>
                                <a href="{{ url('language/' . $language->code) }}" class="flex items-center gap-2 px-3 py-1.5 text-neutral-700 hover:bg-neutral-50">
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
    <div class="px-6 py-3">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="shrink-0">
                @php $header_logo = get_setting('header_logo'); @endphp
                @if ($header_logo)
                    <img src="{{ uploaded_asset($header_logo) }}" class="h-10" alt="{{ get_setting('website_name') }}">
                @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" class="h-10" alt="{{ get_setting('website_name') }}">
                @endif
            </a>

            <form action="{{ route('search') }}" method="GET" class="flex-1 max-w-2xl">
                <div class="flex">
                    <input type="text" name="keyword" class="flex-1 rounded-l-md border border-neutral-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30" placeholder="{{ translate('Search...') }}">
                    <button type="submit" class="rounded-r-md bg-primary px-4 text-white hover:bg-primary-dark">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="sr-only">{{ translate('Search') }}</span>
                    </button>
                </div>
            </form>

            <div class="flex items-center gap-5 ml-auto shrink-0">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-neutral-700 hover:text-primary text-lg"><i class="fa fa-user"></i></a>
                @else
                    <a href="{{ route('user.login') }}" class="text-sm text-neutral-700 hover:text-primary">{{ translate('login') }}</a>
                @endauth
                <a href="{{ route('wishlists.index') }}" class="text-neutral-700 hover:text-primary text-lg">
                    <i class="fa fa-heart"></i>
                </a>

                @php
                    $cartCount = \App\Utility\CartUtility::current_user_cart_query()->count();
                @endphp
                <button
                    type="button"
                    class="relative text-neutral-700 hover:text-primary text-lg"
                    x-on:click="$dispatch('open-modal', { id: 'cart-drawer' })"
                >
                    <i class="fa fa-shopping-cart"></i>
                    <span class="cart-count-span absolute -top-2 -right-2 rounded-full bg-warning text-neutral-900 text-[10px] font-bold min-w-4 h-4 px-1 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                </button>
            </div>
        </div>

    </div>

    <!-- Category pills nav -->
    <nav class="border-t border-neutral-200 bg-white px-6">
        <ul class="flex items-center justify-center gap-3 py-2.5 text-sm text-neutral-600">
            <li><a href="{{ route('home') }}" class="font-semibold text-primary">{{ translate('Home') }}</a></li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li><a href="{{ route('about.us') }}" class="hover:text-primary">{{ translate('About') }}</a></li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li
                    class="relative"
                    x-data="{
                        open: false,
                        activeCategory: null,
                        closeTimer: null,
                        show() { clearTimeout(this.closeTimer); this.open = true; },
                        scheduleHide() { this.closeTimer = setTimeout(() => { this.open = false; }, 200); },
                    }"
                    x-on:mouseenter="show"
                    x-on:mouseleave="scheduleHide"
                >
                    <a href="{{ route('search') }}" class="text-neutral-700 hover:text-primary">
                        {{ translate('All Products') }}
                    </a>

                    <div
                        x-show="open"
                        x-transition
                        class="absolute {{ App::getLocale() == 'sa' ? 'right-0' : 'left-0' }} top-full mt-2 flex w-[46rem] max-w-[90vw] rounded-md border border-neutral-200 bg-white shadow-md z-30"
                        style="display: none;"
                    >
                        <ul class="w-64 shrink-0 border-r border-neutral-100 py-2">
                            @foreach ($categories->where('featured', 1) as $category)
                                <li x-on:mouseenter="activeCategory = {{ $category->id }}">
                                    <a href="{{ route('products.category', $category->slug) }}" class="flex items-center gap-3 px-4 py-2 hover:bg-neutral-50" :class="{ 'bg-neutral-50': activeCategory === {{ $category->id }} }">
                                        <img src="{{ uploaded_asset($category->icon) }}" class="size-6 object-contain">
                                        <span class="text-sm text-neutral-800">{{ $category->getTranslation('name') }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex-1 p-4 max-h-96 overflow-y-auto">
                            @foreach ($categories as $category)
                                <div x-show="activeCategory === {{ $category->id }}" style="display: none;">
                                    @if ($category->childrenCategories && $category->childrenCategories->count())
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach ($category->childrenCategories as $child)
                                                <div>
                                                    <a href="{{ route('products.category', $child->slug) }}" class="block font-semibold text-sm text-neutral-900 mb-1">
                                                        {{ $child->getTranslation('name') }}
                                                    </a>
                                                    @if ($child->childrenCategories && $child->childrenCategories->count())
                                                        <ul class="space-y-1">
                                                            @foreach ($child->childrenCategories as $grandChild)
                                                                <li>
                                                                    <a href="{{ route('products.category', $grandChild->slug) }}" class="text-sm text-neutral-500 hover:text-primary">
                                                                        {{ $grandChild->getTranslation('name') }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-neutral-500">{{ translate('No Subcategories') }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
            </li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li><a href="{{ route('get-a-quote') }}" class="hover:text-primary">{{ translate('get_quote') }}</a></li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li><a href="{{ route('service-request') }}" class="hover:text-primary">{{ translate('service_request') }}</a></li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li><a href="{{ route('maintainence-request') }}" class="hover:text-primary">{{ translate('maintainence_request') }}</a></li>
            <li class="text-neutral-300"><i class="fa-solid fa-chevron-left rtl:-scale-x-100 text-[10px]"></i></li>
            <li><a href="{{ route('all-our-partners') }}" class="hover:text-primary">{{ translate('partners') }}</a></li>
        </ul>
    </nav>
</header>

<!-- Mobile header -->
<header class="md:hidden bg-neutral-50 border-b border-neutral-200">
    <div class="flex items-center justify-between px-4 py-3">
        <a href="{{ route('home') }}">
            @php $header_logo = get_setting('header_logo'); @endphp
            @if ($header_logo)
                <img src="{{ uploaded_asset($header_logo) }}" class="h-8" alt="{{ get_setting('website_name') }}">
            @else
                <img src="{{ static_asset('assets/img/logo.png') }}" class="h-8" alt="{{ get_setting('website_name') }}">
            @endif
        </a>

        <div class="flex items-center gap-4">
            <button type="button" class="relative text-neutral-700 text-lg" x-on:click="$dispatch('open-modal', { id: 'cart-drawer' })">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count-span absolute -top-2 -right-2 rounded-full bg-warning text-neutral-900 text-[10px] font-bold min-w-4 h-4 px-1 flex items-center justify-center">
                    {{ $cartCount ?? 0 }}
                </span>
            </button>
            <button type="button" class="text-neutral-700 text-xl" x-on:click="$dispatch('open-modal', { id: 'mobile-nav' })" aria-label="{{ translate('Menu') }}">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<x-drawer-shell id="mobile-nav" side="{{ App::getLocale() == 'sa' ? 'end' : 'start' }}" width="max-w-xs">
    <div class="p-4">
        <ul class="space-y-3">
            <li><a href="{{ route('home') }}" class="font-semibold text-neutral-900">{{ translate('Home') }}</a></li>
            <li><a href="{{ route('about.us') }}" class="font-semibold text-neutral-900">{{ translate('About') }}</a></li>

            <li x-data="dropdown()">
                <button type="button" x-on:click="toggle" class="w-full flex items-center justify-between font-semibold text-neutral-900">
                    {{ translate('All Products') }}
                    <i class="fa fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>
                <ul x-show="open" x-collapse class="mt-3 space-y-3 pl-3" style="display: none;">
                    @foreach ($categories->where('featured', 1) as $category)
                        <li x-data="dropdown()">
                            <button type="button" x-on:click="toggle" class="w-full flex items-center justify-between gap-2 text-neutral-600">
                                <span class="flex items-center gap-2">
                                    <img src="{{ uploaded_asset($category->icon) }}" class="size-6 object-contain">
                                    {{ $category->getTranslation('name') }}
                                </span>
                                @if ($category->childrenCategories && $category->childrenCategories->count())
                                    <i class="fa fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                                @endif
                            </button>
                            @if ($category->childrenCategories && $category->childrenCategories->count())
                                <ul x-show="open" x-collapse class="mt-2 space-y-2 pl-4" style="display: none;">
                                    @foreach ($category->childrenCategories as $sub)
                                        <li x-data="dropdown()">
                                            <button type="button" x-on:click="toggle" class="w-full flex items-center justify-between text-sm text-neutral-500">
                                                {{ $sub->getTranslation('name') }}
                                                @if ($sub->childrenCategories && $sub->childrenCategories->count())
                                                    <i class="fa fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                                                @endif
                                            </button>
                                            @if ($sub->childrenCategories && $sub->childrenCategories->count())
                                                <ul x-show="open" x-collapse class="mt-2 space-y-1 pl-4" style="display: none;">
                                                    @foreach ($sub->childrenCategories as $subsub)
                                                        <li>
                                                            <a href="{{ route('products.category', $subsub->slug) }}" class="text-sm text-neutral-500 hover:text-primary">
                                                                {{ $subsub->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>

            <li><a href="{{ route('get-a-quote') }}" class="font-semibold text-neutral-900">{{ translate('get_quote') }}</a></li>
            <li><a href="{{ route('service-request') }}" class="font-semibold text-neutral-900">{{ translate('service_request') }}</a></li>
            <li><a href="{{ route('maintainence-request') }}" class="font-semibold text-neutral-900">{{ translate('maintainence_request') }}</a></li>
            <li><a href="{{ route('all-our-partners') }}" class="font-semibold text-neutral-900">{{ translate('partners') }}</a></li>
            <li><a href="{{ route('user.login') }}" class="font-semibold text-neutral-900">{{ translate('login') }}</a></li>
            <li><a href="{{ route('wishlists.index') }}" class="font-semibold text-neutral-900">{{ translate('Wishlist') }}</a></li>
            <li><a href="{{ route('cart') }}" class="font-semibold text-neutral-900">{{ translate('Cart') }}</a></li>
        </ul>

        <div x-data="dropdown()" class="relative mt-4">
            <button type="button" x-on:click="toggle" class="w-full flex items-center justify-center gap-1 rounded-md border border-neutral-300 px-3 py-2 text-sm">
                🌐 {{ strtoupper(app()->getLocale()) }}
            </button>
            <ul x-show="open" x-on:click.outside="close" x-transition class="mt-1 w-full rounded-md border border-neutral-200 bg-white py-1 shadow-md" style="display: none;">
                @foreach (get_all_active_language() as $language)
                    <li>
                        <a href="{{ url('language/' . $language->code) }}" class="flex items-center gap-2 px-3 py-1.5 text-neutral-700 hover:bg-neutral-50">
                            @if ($language->code == 'sa')
                                <img src="https://flagcdn.com/sa.svg" width="18" alt="SA">
                            @elseif($language->code == 'en')
                                <img src="https://flagcdn.com/gb.svg" width="18" alt="EN">
                            @elseif($language->code == 'cn')
                                <img src="https://flagcdn.com/cn.svg" width="18" alt="CN">
                            @endif
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-drawer-shell>
