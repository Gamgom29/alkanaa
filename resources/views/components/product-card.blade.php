{{--
    The single, shared product card — replaces the product-box partial that
    used to be duplicated per storefront theme folder (classic/megamart/metro/
    minima/reclassic). Pricing uses the app's canonical helpers
    (home_base_price/home_discounted_base_price/discount_in_percentage) so
    every theme gets the same correct discount-window and tax handling
    instead of each theme re-implementing (and sometimes getting wrong) its
    own price math.

    Usage: <x-product-card :product="$product" />
--}}
@props(['product'])

@php
    $hasDiscount = discount_in_percentage($product) > 0;
    $inStock = $product->current_stock > 0;
@endphp

<div class="relative flex h-full flex-col overflow-hidden rounded-md border border-neutral-200 bg-white transition hover:-translate-y-0.5 hover:shadow-md">
    @if($hasDiscount)
        <span class="absolute top-2 left-2 z-10 rounded-full bg-danger px-2 py-0.5 text-xs font-semibold text-white">
            -{{ discount_in_percentage($product) }}%
        </span>
    @endif

    <a href="{{ route('product', $product->slug) }}" class="relative block aspect-square bg-neutral-50">
        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}" loading="lazy" class="h-full w-full object-contain">
    </a>

    <div class="flex flex-1 flex-col gap-1.5 p-3">
        <a href="{{ route('product', $product->slug) }}" class="line-clamp-2 text-sm font-medium text-neutral-900 no-underline">
            {{ $product->getTranslation('name') }}
        </a>

        <div class="mt-auto flex items-baseline gap-2 font-bold">
            <span>{{ home_discounted_base_price($product) }}</span>
            @if($hasDiscount)
                <span class="text-sm font-normal text-neutral-500 line-through">{{ home_base_price($product) }}</span>
            @endif
        </div>

        @unless($inStock)
            <x-status-badge status="Out of stock" tone="danger" />
        @endunless
    </div>
</div>
