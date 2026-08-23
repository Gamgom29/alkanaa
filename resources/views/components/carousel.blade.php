@props(['options' => []])

{{--
    Swiper-backed carousel. Swiper auto-detects RTL from the ancestor
    dir="rtl" attribute, so this one component works correctly in Arabic,
    English, and Chinese without any locale branching — replacing the three
    separate hand-rolled sliders that used to disagree with each other
    (one class-swapped prev/next per locale, one checked `dir` at runtime,
    one ignored RTL entirely).
--}}
<div x-data="carousel(@js($options))" class="relative">
    <div class="swiper" x-ref="swiper">
        <div class="swiper-wrapper">
            {{ $slot }}
        </div>
    </div>

    <button type="button" x-ref="prev" aria-label="{{ translate('Previous') }}"
        class="absolute inset-y-0 my-auto start-0 z-10 hidden size-10 -translate-x-1/2 items-center justify-center rounded-full border border-neutral-200 bg-white text-neutral-700 shadow-sm transition hover:border-primary hover:bg-primary hover:text-white rtl:translate-x-1/2 lg:flex">
        <i class="fa-solid fa-chevron-left rtl:rotate-180"></i>
    </button>
    <button type="button" x-ref="next" aria-label="{{ translate('Next') }}"
        class="absolute inset-y-0 my-auto end-0 z-10 hidden size-10 translate-x-1/2 items-center justify-center rounded-full border border-neutral-200 bg-white text-neutral-700 shadow-sm transition hover:border-primary hover:bg-primary hover:text-white rtl:-translate-x-1/2 lg:flex">
        <i class="fa-solid fa-chevron-right rtl:rotate-180"></i>
    </button>
</div>
