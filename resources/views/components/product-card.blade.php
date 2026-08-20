{{--
    The single, shared product card — replaces the product-box partial that
    used to be duplicated per storefront theme folder (classic/megamart/metro/
    minima/reclassic). Pricing uses the app's canonical helpers
    (home_base_price/home_discounted_base_price/discount_in_percentage) so
    every theme gets the same correct discount-window and tax handling.
    Visual design matches the reference homepage the user provided: white
    card, discount badge, wishlist heart, full-width CTA button.

    Usage: <x-product-card :product="$product" />
--}}
@props(['product'])

@php
    $hasDiscount = discount_in_percentage($product) > 0;
    $inStock = $product->current_stock > 0;
@endphp

<div class="group relative flex h-full flex-col overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
    @if($hasDiscount)
        <span class="absolute top-3 start-3 z-10 inline-flex items-center gap-1 rounded-full bg-danger px-2.5 py-1 text-xs font-bold text-white shadow-sm">
            <i class="fa-solid fa-bolt text-[10px]"></i>
            {{ discount_in_percentage($product) }}%
        </span>
    @endif

    <button
        type="button"
        class="absolute top-3 end-3 z-10 flex size-8 items-center justify-center rounded-full bg-white/90 text-neutral-400 shadow-sm hover:text-danger"
        onclick="addToWishList({{ $product->id }})"
        aria-label="{{ translate('Add to wishlist') }}"
    >
        <i class="fa-regular fa-heart"></i>
    </button>

    <a href="{{ route('product', $product->slug) }}" class="relative block aspect-square bg-neutral-50 p-4">
        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}" loading="lazy" class="h-full w-full object-contain">
    </a>

    <div class="flex flex-1 flex-col gap-2 p-4 pt-1 text-start">
        <a href="{{ route('product', $product->slug) }}" class="line-clamp-2 min-h-10 text-sm font-bold text-neutral-900 no-underline">
            {{ $product->getTranslation('name') }}
        </a>

        <div class="mt-auto flex items-baseline gap-2 flex-wrap">
            <span class="text-lg font-extrabold text-neutral-900">{{ home_discounted_base_price($product) }}</span>
            @if($hasDiscount)
                <span class="text-sm text-neutral-400 line-through">{{ home_base_price($product) }}</span>
            @endif
        </div>

        @unless($inStock)
            <x-status-badge status="Out of stock" tone="danger" />
        @endunless

        <button
            type="button"
            class="add-to-cart-btn mt-2 flex w-full items-center justify-center gap-2 rounded-lg bg-primary py-2.5 text-sm font-bold text-white transition hover:bg-primary-dark disabled:cursor-not-allowed disabled:opacity-50"
            data-id="{{ $product->id }}"
            @disabled(!$inStock)
        >
            <i class="fa-solid fa-cart-shopping"></i>
            {{ translate('Add to Cart') }}
        </button>
    </div>
</div>
