@php
    $cart_added = [];
@endphp


<div class="box-product-allpro">
    <div class="card shadow-sm text-center p-2 position-relative" style="height: 450px;">
        @if ($product->discount > 0)
            <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end"
                style="font-size: 14px;">
                -{{ round($product->discount) }}%
            </div>
        @endif

        <a href="{{ route('product', $product->slug) }}">
            <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="card-img-top p-3 product-img"
                style="width: 220px; height: 220px;object-fit: contain;" alt="{{ $product->getTranslation('name') }}">
        </a>

        <div class="card-body position-relative">
            <div class="mb-2">
                <div class="d-flex justify-content-center flex-wrap gap-2">
                    <span class="badge bg-light border text-dark" style="font-size: 0.75rem;">
                        {{ translate('sku') }}: {{ $product->stocks->first()->sku ?? '' }}
                    </span>
                    <span class="badge {{ $product->current_stock > 0 ? 'bg-success' : 'bg-danger' }}"
                        style="font-size: 0.75rem;">
                        {{ $product->current_stock > 0 ? '✔ ' . translate('Available') : translate('Out of stock') }}
                    </span>
                    <span class="badge bg-warning text-dark" style="font-size: 0.75rem;">
                        {{ $product->is_local_shipping ? translate('Local Shipping') : translate('Shipping') }}
                    </span>
                </div>
            </div>
            <h6 class="card-title fw-bold mt-2">
                {{ $product->getTranslation('name') }}
            </h6>
            <div class="mb-3">
                @if ($product->discount > 0.0 && $product->discount_type == 'percent')
                    <span class="fs-5 fw-bold text-dark text-decoration-line-through">
                        {{ $product->unit_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}"
                            style="width: 15px; height: 15px;">
                    </span>
                    <span class="text-muted mx-2">
                        {{ $product->unit_price - ($product->unit_price * $product->discount) / 100 }}
                        <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 15px; height: 15px;">
                    </span>
                @elseif($product->discount > 0.0 && $product->discount_type == 'amount')
                    <span class="fs-5 fw-bold text-dark text-decoration-line-through">
                        {{ $product->unit_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}"
                            style="width: 15px; height: 15px;">
                    </span>
                    {{ $product->unit_price - $product->discount }} <img
                        src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 15px; height: 15px;">
                @else
                    <span class="fs-5 fw-bold text-dark">
                        {{ $product->unit_price }} <img src="{{ static_asset('assets/front_img/rs.png') }}"
                            style="width: 15px; height: 15px;">
                    </span>
                @endif
                <div class="text-muted" style="font-size: 12px;">
                    {{ translate('inclusive_of_vat') }}
                </div>
            </div>


            {{-- @if (auth()->check())
            <button type="button" class="btn position-absolute w-100 bottom-0 start-50 translate-middle-x add-to-cart-btn mb-2" data-id="{{ $product->id }}"
                style="background-color: #ae2025; color: #fff; font-size: 0.85rem;">
                <i class="fa-solid fa-cart-shopping me-1"></i>
                {{ translate('Add to Cart') }}
            </button>
            @else
            <button type="button" onclick="window.location.href='{{ route('user.login') }}'" class="btn position-absolute w-100 bottom-0 start-50 translate-middle-x mb-2" data-id="{{ $product->id }}"
                style="background-color: #ae2025; color: #fff; font-size: 0.85rem;" data-toggle="modal"
                data-target="#loginModal">
                <i class="fa-solid fa-cart-shopping me-1"></i>
                {{ translate('Add to Cart') }}
            </button>
            @endif --}}
            <button type="button" @if($product->current_stock <= 0) disabled @endif
                                                
                class="btn position-absolute w-100 bottom-0 start-50 translate-middle-x add-to-cart-btn"
                data-id="{{ $product->id }}" style="background-color: #ae2025; color: #fff; font-size: 0.85rem;">
                <i class="fa-solid fa-cart-shopping me-1"></i>
                {{ translate('Add to Cart') }}
            </button>
        </div>
    </div>
</div>
