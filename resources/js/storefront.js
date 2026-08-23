import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swiper from 'swiper';
import { Navigation, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

Alpine.plugin(collapse);

// Swiper auto-detects RTL from the container's `dir` attribute (inherited
// from <html dir="rtl">), so no manual RTL branching is needed here — this
// replaces three separate hand-rolled, mutually inconsistent slider
// implementations that used to live inline in classic/index.blade.php.
Alpine.data('carousel', (options = {}) => ({
    swiper: null,
    init() {
        this.swiper = new Swiper(this.$refs.swiper, {
            modules: [Navigation, Autoplay],
            slidesPerView: 1,
            spaceBetween: 12,
            navigation: {
                prevEl: this.$refs.prev,
                nextEl: this.$refs.next,
            },
            ...options,
        });
    },
    destroy() {
        this.swiper?.destroy();
    },
}));

window.Alpine = Alpine;
Alpine.start();

/*
 * Quick add-to-cart + mini-cart toast, extracted from being duplicated
 * inline in classic/index.blade.php so every converted page can share it.
 * Requires jQuery (loaded globally via assets/js/vendors.js on the legacy
 * shell) and the .mini-cart-toast markup from
 * frontend.partials.cart.cart_summary_toast.
 */
window.mountMiniCartToastNearCart = function (html) {
    const $ = window.jQuery;
    if (!$) return;

    $('.mini-cart-toast').remove();

    const isRTL = document.documentElement.dir === 'rtl' || document.documentElement.lang === 'sa' || document.documentElement.lang === 'ar';
    const isMobile = window.innerWidth < 992;

    const $toast = $(html).appendTo('body');

    if (isMobile) {
        $toast.css({
            position: 'fixed',
            top: '70px',
            right: isRTL ? '12px' : 'auto',
            left: isRTL ? 'auto' : '12px',
            zIndex: 99999,
            visibility: 'visible',
            opacity: 1,
            transform: 'none'
        }).addClass('show');

        clearTimeout(window.__mctTimer);
        window.__mctTimer = setTimeout(() => $toast.fadeOut(300, () => $toast.remove()), 3500);
        return;
    }

    const cartEl = document.getElementById('nav-cart-area');
    if (!cartEl) {
        $toast.css({
            position: 'fixed',
            top: '75px',
            right: isRTL ? '20px' : 'auto',
            left: isRTL ? 'auto' : '20px',
            zIndex: 99999,
            visibility: 'visible',
            opacity: 1,
            transform: 'none'
        }).addClass('show');

        clearTimeout(window.__mctTimer);
        window.__mctTimer = setTimeout(() => $toast.fadeOut(300, () => $toast.remove()), 3500);
        return;
    }

    const rect = cartEl.getBoundingClientRect();
    const scrollY = window.scrollY || window.pageYOffset;
    const scrollX = window.scrollX || window.pageXOffset;
    const w = $toast.outerWidth() || 340;

    const gap = 10;
    const top = rect.bottom + scrollY + gap;
    let left = isRTL ? rect.left + scrollX : rect.right + scrollX - w;

    const minLeft = 8 + scrollX;
    const maxLeft = scrollX + document.documentElement.clientWidth - w - 8;
    left = Math.max(minLeft, Math.min(left, maxLeft));

    $toast.css({
        position: 'absolute',
        top: top + 'px',
        left: left + 'px',
        zIndex: 99999,
        visibility: 'visible',
        opacity: 1,
        transform: 'none'
    }).addClass('show');

    clearTimeout(window.__mctTimer);
    window.__mctTimer = setTimeout(() => $toast.fadeOut(300, () => $toast.remove()), 3500);
};

document.addEventListener('DOMContentLoaded', function () {
    const $ = window.jQuery;
    if (!$) return;

    $(document).on('click', '.mct-close', function () {
        $(this).closest('.mini-cart-toast').remove();
    });

    $(document).on('click', '.add-to-cart-btn', function (e) {
        e.preventDefault();
        const $btn = $(this);
        const id = $btn.data('id');
        const originalHtml = $btn.html();

        $btn.addClass('is-loading').prop('disabled', true)
            .html('<span class="btn-spinner" aria-hidden="true"></span>');

        $.post(window.AIZ?.routes?.addToCart, {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            quantity: 1,
        }).done(function (res) {
            if (typeof res.cart_count !== 'undefined') {
                $('.cart-count-span').text(res.cart_count);
            }
            if (res.modal_view) {
                window.mountMiniCartToastNearCart(res.modal_view);
            } else if (res.status != 1) {
                alert(res.message || 'تعذر الإضافة');
            }
        }).fail(function () {
            alert('تعذر الاتصال بالسيرفر');
        }).always(function () {
            $btn.removeClass('is-loading').prop('disabled', false).html(originalHtml);
        });
    });
});
