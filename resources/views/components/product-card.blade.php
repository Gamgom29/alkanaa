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

<div class="group relative flex h-full flex-col justify-between rounded-2xl border border-neutral-200/90 bg-white p-3 sm:p-4 text-start shadow-2xs transition duration-250 hover:-translate-y-1 hover:shadow-md">
    <!-- Top Badges & Wishlist -->
    <div class="flex items-center justify-between mb-1">
        @if ($hasDiscount)
            <span class="rounded-full bg-pink-100 px-2 py-0.5 text-[11px] font-bold text-rose-600">
                -{{ round($product->discount) }}%
            </span>
        @else
            <span></span>
        @endif

        <button type="button" onclick="addToWishList({{ $product->id }})"
            aria-label="{{ translate('Add to wishlist') }}"
            class="flex size-7 items-center justify-center rounded-full text-neutral-400 transition hover:bg-neutral-100 hover:text-rose-500">
            <i class="fa-regular fa-heart text-sm"></i>
        </button>
    </div>

    <!-- Product Image -->
    <a href="{{ route('product', $product->slug) }}" class="my-1 flex h-36 sm:h-44 w-full items-center justify-center overflow-hidden p-2">
        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}"
            class="max-h-full max-w-full object-contain transition duration-300 group-hover:scale-105"
            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
    </a>

    <!-- Badges Row -->
    <div class="mt-2 flex flex-wrap items-center gap-1.5">
        <span class="rounded bg-[#fef08a] px-1.5 py-0.5 text-[10px] font-bold text-[#854d0e]">
            {{ translate('Free Shipping') ?? 'شحن مجاني' }}
        </span>
        <span class="rounded {{ $inStock ? 'bg-[#dcfce7] text-[#166534]' : 'bg-red-100 text-red-700' }} px-1.5 py-0.5 text-[10px] font-bold">
            {{ $inStock ? '✔ ' . translate('Available') : translate('Out of stock') }}
        </span>
        @if ($sku)
            <span class="text-[10px] text-neutral-400 font-mono">
                {{ $sku }}
            </span>
        @endif
    </div>

    <!-- Product Title -->
    <a href="{{ route('product', $product->slug) }}" class="mt-2 block no-underline">
        <h3 class="line-clamp-2 min-h-[2.5rem] text-xs sm:text-sm font-bold text-neutral-900 transition group-hover:text-[#4868e6] leading-snug">
            {{ $product->getTranslation('name') }}
        </h3>
    </a>

    <!-- Price and Add to Cart Button -->
    <div class="mt-3 flex items-end justify-between gap-2 pt-2 border-t border-neutral-100">
        <!-- Add to cart button (Royal Blue) -->
        <button type="button" @if (!$inStock) disabled @endif data-id="{{ $product->id }}"
            title="{{ translate('Add to Cart') }}"
            class="add-to-cart-btn flex size-9 sm:size-10 flex-shrink-0 items-center justify-center rounded-xl bg-[#4868e6] text-white shadow-xs transition hover:bg-[#3753c8] active:scale-95 disabled:cursor-not-allowed disabled:bg-neutral-300">
            <i class="fa-solid fa-cart-shopping text-xs sm:text-sm"></i>
        </button>

        <!-- Price Area -->
        <div class="text-end">
            <div class="flex items-baseline justify-end gap-1.5">
                @if ($hasDiscount)
                    <span class="text-[11px] text-neutral-400 line-through">
                        {{ number_format($product->unit_price, 0) }}
                    </span>
                @endif
                <span class="text-sm sm:text-base font-extrabold text-[#0c234a]">
                    {{ number_format($newPrice, 0) }}
                    <span class="text-xs font-bold text-neutral-600">ر.س</span>
                </span>
            </div>
            <div class="text-[10px] text-neutral-400 font-medium leading-none mt-0.5">
                {{ translate('inclusive_of_vat') }}
            </div>
        </div>
    </div>
</div>
