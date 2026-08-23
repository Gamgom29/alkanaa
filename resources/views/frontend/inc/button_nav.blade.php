<style>
    .mobile-bottom-nav {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.96);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border-top: 1px solid #e2e8f0;
        z-index: 1000;
        padding: 6px 16px calc(6px + env(safe-area-inset-bottom));
        display: none;
    }

    @media (max-width: 991px) {
        .mobile-bottom-nav {
            display: block;
        }
        .mobile-bottom-spacer {
            height: 70px;
            display: block;
        }
    }

    .mobile-bottom-nav__inner {
        display: flex;
        align-items: center;
        justify-content: space-around;
        max-width: 500px;
        margin: 0 auto;
    }

    .mobile-nav-tab {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        color: #475569;
        text-decoration: none !important;
        font-size: 11px;
        font-weight: 700;
        position: relative;
        padding: 4px;
        transition: color 0.2s ease;
    }

    .mobile-nav-tab:hover,
    .mobile-nav-tab.is-active {
        color: #4868e6;
    }

    .mobile-nav-tab i {
        font-size: 20px;
    }

    .mobile-nav-badge {
        position: absolute;
        top: 0;
        right: calc(50% - 18px);
        background: #0c234a;
        color: #ffffff;
        font-size: 9px;
        font-weight: 800;
        min-width: 16px;
        height: 16px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ffffff;
    }
</style>

<div class="d-lg-none">
    <div class="mobile-bottom-spacer" aria-hidden="true"></div>

    <nav class="mobile-bottom-nav" role="navigation" aria-label="التنقل السفلي">
        <div class="mobile-bottom-nav__inner">
            <!-- Menu / Offcanvas trigger -->
            <button type="button" class="mobile-nav-tab border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="القائمة">
                <i class="fa-solid fa-bars"></i>
                <span>القائمة</span>
            </button>

            <!-- Wishlist -->
            <a class="mobile-nav-tab" href="{{ route('wishlists.index') }}" aria-label="قائمة الامنيات">
                <i class="fa-regular fa-heart"></i>
                @php
                    $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
                @endphp
                <span class="mobile-nav-badge">{{ $wishlistCount }}</span>
                <span>قائمة الامنيات</span>
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
            <a class="mobile-nav-tab" href="javascript:void(0);" onclick="openCartOffcanvas()" aria-label="عربة التسوق">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="mobile-nav-badge cart-count-span">{{ $cartCount }}</span>
                <span>عربة التسوق</span>
            </a>
        </div>
    </nav>
</div>