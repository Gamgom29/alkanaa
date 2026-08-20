{{--
    Replaces AIZ.plugins.slickCarousel(). Usage:

        <x-carousel :options="['slidesPerView' => 4, 'loop' => true]">
            @foreach ($products as $product)
                <div class="swiper-slide"><x-product-card :product="$product" /></div>
            @endforeach
        </x-carousel>
--}}
@props(['options' => []])

<div x-data="carousel(@js($options))" class="relative">
    <div class="swiper">
        <div class="swiper-wrapper">
            {{ $slot }}
        </div>
    </div>
    <button type="button" class="swiper-button-prev !text-primary"></button>
    <button type="button" class="swiper-button-next !text-primary"></button>
    <div class="swiper-pagination mt-2"></div>
</div>
