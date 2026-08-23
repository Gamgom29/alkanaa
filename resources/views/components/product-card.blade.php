@props(['product'])

@php
    $hasDiscount = $product->discount > 0;
    $newPrice = $hasDiscount
        ? ($product->discount_type == 'percent'
            ? $product->unit_price - ($product->unit_price * $product->discount) / 100
            : $product->unit_price - $product->discount)
        : $product->unit_price;
    $inStock = $product->current_stock > 0;
    $sku = $product->stocks->first()->sku ?? '';
@endphp

<div class="group relative flex h-full flex-col rounded-lg border border-neutral-200 bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
    @if ($hasDiscount)
        <span class="absolute start-3 top-3 z-10 rounded-md bg-primary px-2 py-1 text-xs font-bold text-white shadow">
            -{{ round($product->discount) }}%
        </span>
    @endif

    <button type="button" onclick="addToWishList({{ $product->id }})"
        aria-label="{{ translate('Add to wishlist') }}"
        class="absolute end-3 top-3 z-10 flex size-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-primary hover:text-white">
        <i class="la la-heart-o text-base"></i>
    </button>

    <a href="{{ route('product', $product->slug) }}" class="mb-3 block overflow-hidden rounded-md bg-neutral-50 p-3">
        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}"
            class="mx-auto h-28 w-full max-w-[140px] object-contain sm:h-36 sm:max-w-[160px]">
    </a>

    <div class="mb-2 flex flex-wrap items-center justify-center gap-1.5">
        @if ($sku)
            <span class="rounded border border-neutral-200 bg-neutral-50 px-1.5 py-0.5 text-[11px] text-neutral-700">
                {{ translate('sku') }}: {{ $sku }}
            </span>
        @endif
        <span class="rounded px-1.5 py-0.5 text-[11px] font-medium text-white {{ $inStock ? 'bg-success' : 'bg-danger' }}">
            {{ $inStock ? '✔ ' . translate('Available') : translate('Out of stock') }}
        </span>
    </div>

    <a href="{{ route('product', $product->slug) }}" class="mb-2 block">
        <h3 class="line-clamp-2 min-h-[2.6em] text-sm font-bold text-neutral-900">
            {{ $product->getTranslation('name') }}
        </h3>
    </a>

    <div class="mt-auto">
        <div class="mb-0.5 flex items-center justify-center gap-2">
            @if ($hasDiscount)
                <span class="flex items-center gap-0.5 text-xs text-neutral-500 line-through">
                    {{ $product->unit_price }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" class="size-3" alt="">
                </span>
            @endif
            <span class="flex items-center gap-0.5 text-base font-extrabold text-neutral-900">
                {{ $newPrice }}
                <img src="{{ static_asset('assets/front_img/rs.png') }}" class="size-3.5" alt="">
            </span>
        </div>
        <div class="mb-3 text-[11px] text-neutral-500">{{ translate('inclusive_of_vat') }}</div>

        <button type="button" @if (!$inStock) disabled @endif data-id="{{ $product->id }}"
            class="add-to-cart-btn w-full rounded-full bg-primary py-2.5 text-sm font-bold text-white transition hover:brightness-110 active:scale-[.98] disabled:cursor-not-allowed disabled:bg-neutral-300">
            <i class="fa-solid fa-cart-shopping me-1"></i>
            {{ translate('Add to Cart') }}
        </button>
    </div>
</div>
