<style>
    /* المتغيّرات محليّة على عنصر الشريط نفسه */
    .dmnt-bar {
        --dmnt-primary: #ae2025;
        --dmnt-primary-rgb: 174, 32, 37;
        --dmnt-text: #111827;
        --dmnt-muted: #6b7280;
        --dmnt-bg: rgba(255, 255, 255, .95);
        --dmnt-divider: #e5e7eb;
        --dmnt-badge: #ff7a00;
        --dmnt-radius: 14px;

        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 8px 10px calc(8px + env(safe-area-inset-bottom));
        background: var(--dmnt-bg);
        -webkit-backdrop-filter: saturate(180%) blur(10px);
        backdrop-filter: saturate(180%) blur(10px);
        border-top: 1px solid var(--dmnt-divider);
        z-index: 1000;
        display: none;
        /* يظهر فقط على الموبايل */
    }

    @media (max-width: 820px) {
        .dmnt-bar {
            display: block
        }
    }

    .dmnt-bar__inner {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: space-between;
        max-width: 900px;
        margin: 0 auto;
    }

    .dmnt-tab {
        flex: 1;
        min-height: 56px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        text-decoration: none;
        color: var(--dmnt-muted);
        border-radius: var(--dmnt-radius);
        position: relative;
        padding: 8px 4px;
        transition: background .2s ease, color .2s ease, transform .06s ease;
        -webkit-tap-highlight-color: transparent;
    }

    .dmnt-tab:active {
        transform: translateY(1px)
    }

    .dmnt-tab:focus-visible {
        outline: 2px solid rgba(var(--dmnt-primary-rgb), .35);
        outline-offset: 3px
    }

    .dmnt-tab svg {
        width: 24px;
        height: 24px;
        display: block
    }

    .dmnt-tab span {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .2px
    }

    .dmnt-tab.is-active {
        color: var(--dmnt-primary);
        background: rgba(var(--dmnt-primary-rgb), .08)
    }

    .dmnt-tab--brand {
        font-weight: 800;
        font-size: 18px;
        color: var(--dmnt-primary);
        background: rgba(var(--dmnt-primary-rgb), .08);
        padding: 8px 10px;
        border-radius: 18px;
        line-height: 1;
    }

    .dmnt-badge {
        position: absolute;
        top: 4px;
        inset-inline-end: 18px;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--dmnt-badge);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        border-radius: 999px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .12);
    }

    .dmnt-badge[data-count="0"] {
        display: none
    }

    /* اختياري: سبيسر تتضيف تحت المحتوى لو محتاج تمنع التداخل */
    .dmnt-spacer {
        height: 72px;
        display: none
    }

    @media (max-width: 820px) {
        .dmnt-spacer {
            display: block
        }
    }
</style>
<!-- ===== Bottom Navigation ===== -->
<div class="mob">
    <div class="dmnt-spacer" aria-hidden="true"></div>

    <nav class="dmnt-bar" role="navigation" aria-label="التنقل السفلي" dir="rtl">
        <div class="dmnt-bar__inner">

            <a class="dmnt-tab is-active" href="{{ route('home') }}" data-tab="home" aria-label="الرئيسية">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M3 10.5L12 3l9 7.5"></path>
                    <path d="M5 9.5V21h14V9.5"></path>
                    <path d="M9 21v-6h6v6"></path>
                </svg>
                <span>@if(app()->getLocale() == 'sa') الرئيسية  @elseif(app()->getLocale() == 'cn') 首页 @else Home @endif</span>
            </a>

            <a class="dmnt-tab" href="{{ route('categories.all') }}" data-tab="categories" aria-label="التصنيفات">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="4" y="4" width="16" height="16" rx="3"></rect>
                    <path d="M9 8h6M9 12h6M9 16h6"></path>
                </svg>
                <span>@if(app()->getLocale() == 'sa') التصنيفات  @elseif(app()->getLocale() == 'cn') 分类 @else Categories @endif</span>
            </a>

            <a class="dmnt-tab dmnt-tab--brand" href="#rowad" data-tab="rowad" aria-label="القناعه">@if(app()->getLocale() == 'sa') القناعه  @elseif(app()->getLocale() == 'cn') 品牌 @else Alkanaa @endif</a>

            <a class="dmnt-tab" href="{{ route('dashboard') }}" data-tab="account" aria-label="الحساب">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>@if(app()->getLocale() == 'sa') الحساب  @elseif(app()->getLocale() == 'cn') 账户 @else Account @endif</span>
            </a>

            <a class="dmnt-tab" href="{{ route('cart') }}" data-tab="cart" aria-label="السلة">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="9" cy="20" r="1.8"></circle>
                    <circle cx="18" cy="20" r="1.8"></circle>
                    <path d="M3 4h2l2.4 10.5a2 2 0 0 0 2 1.5h8.6a2 2 0 0 0 2-1.6L22 8H7.2"></path>
                </svg>
                <span>@if(app()->getLocale() == 'sa') السلة  @elseif(app()->getLocale() == 'cn') 购物车 @else Cart @endif</span>
                
            </a>

        </div>
    </nav>
</div>


<script>
  // كله متسمّي dmnt علشان ما يتعارضش مع أي سكربت تاني
  document.querySelectorAll('.dmnt-bar .dmnt-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.dmnt-bar .dmnt-tab').forEach(t => t.classList.remove('is-active'));
      tab.classList.add('is-active');
    });
  });

  // تحديث رقم السلة (اختياري)
  function dmntSetCartCount(n){
    const b = document.getElementById('dmntCartBadge');
    if(!b) return;
    b.dataset.count = String(n);
    b.textContent = n;
  }
  // مثال: dmntSetCartCount(0);
</script>