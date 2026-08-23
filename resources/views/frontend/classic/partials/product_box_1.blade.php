@php
    $cart_added = [];
@endphp

@once
    <style>
        .box-product-allpro {
            width: 100%;
            height: 100%;
        }

        .product-box-modern {
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #fff;
            border: 1px solid #f0f1f3;
            border-radius: 16px;
            padding: 16px 14px 18px;
            box-shadow: 0 6px 20px rgba(17, 24, 39, .07);
            transition: transform .25s ease, box-shadow .25s ease;
            text-align: center;
        }

        .product-box-modern:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgba(17, 24, 39, .14);
        }

        .product-box-modern .pb-badge {
            position: absolute;
            top: 12px;
            inset-inline-start: 12px;
            background: #ae2025;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 4px 14px 14px 4px;
            z-index: 2;
            box-shadow: 0 3px 8px rgba(174, 32, 37, .35);
        }

        .product-box-modern .pb-wishlist {
            position: absolute;
            top: 10px;
            inset-inline-end: 10px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(17, 24, 39, .1);
            z-index: 2;
            transition: all .2s ease;
        }

        .product-box-modern .pb-wishlist:hover {
            background: #ae2025;
        }

        .product-box-modern .pb-wishlist:hover i {
            color: #fff !important;
        }

        .product-box-modern .pb-img-wrap {
            background: #f6f7f9;
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 14px;
        }

        .product-box-modern .pb-img-wrap img {
            width: 100%;
            max-width: 180px;
            height: 160px;
            object-fit: contain;
            margin: 0 auto;
            display: block;
        }

        .product-box-modern .pb-badges-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 8px;
        }

        .product-box-modern .pb-title {
            font-weight: 700;
            font-size: .95rem;
            color: #1f2430;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
        }

        .product-box-modern .pb-sub {
            font-size: .78rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .product-box-modern .pb-price {
            margin-top: auto;
            margin-bottom: 12px;
        }

        .product-box-modern .pb-price .old {
            font-size: .85rem;
            color: #9ca3af;
            text-decoration: line-through;
            margin-inline-end: 6px;
        }

        .product-box-modern .pb-price .new {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1f2430;
        }

        .product-box-modern .pb-vat {
            font-size: .72rem;
            color: #9ca3af;
            margin-top: 2px;
        }

        .product-box-modern .pb-add-btn {
            width: 100%;
            border-radius: 999px;
            background: #ae2025;
            color: #fff;
            font-weight: 700;
            font-size: .85rem;
            padding: 10px;
            border: none;
            transition: filter .2s ease, transform .15s ease;
        }

        .product-box-modern .pb-add-btn:hover:not(:disabled) {
            filter: brightness(1.08);
        }

        .product-box-modern .pb-add-btn:active:not(:disabled) {
            transform: scale(.98);
        }

        .product-box-modern .pb-add-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        @media (max-width: 575px) {
            .product-box-modern {
                padding: 12px 10px 14px;
                border-radius: 12px;
            }

            .product-box-modern .pb-img-wrap img {
                height: 110px;
                max-width: 130px;
            }

            .product-box-modern .pb-title {
                font-size: .85rem;
            }

            .product-box-modern .pb-price .new {
                font-size: 1rem;
            }

            .product-box-modern .pb-add-btn {
                font-size: .78rem;
                padding: 8px;
            }
        }
    </style>
@endonce

<div class="box-product-allpro">
    <div class="product-box-modern">
        @if ($product->discount > 0)
            <div class="pb-badge">-{{ round($product->discount) }}%</div>
        @endif
        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" class="pb-wishlist"
            style="border: none !important; text-decoration: none !important; border-radius: 50%;">
            <i class="fa-regular fa-heart" style="font-size: 15px; color: #e11d48;"></i>
        </a>

        <a href="{{ route('product', $product->slug) }}" class="pb-img-wrap d-block">
            <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}">
        </a>

        <div class="pb-badges-row">
            <span class="badge bg-light border text-dark" style="font-size: 0.7rem;">
                {{ translate('sku') }}: {{ $product->stocks->first()->sku ?? '' }}
            </span>
            <span class="badge {{ $product->current_stock > 0 ? 'bg-success' : 'bg-danger' }}"
                style="font-size: 0.7rem;">
                {{ $product->current_stock > 0 ? '✔ ' . translate('Available') : translate('Out of stock') }}
            </span>
        </div>

        <a href="{{ route('product', $product->slug) }}" class="text-decoration-none">
            <h6 class="pb-title">{{ $product->getTranslation('name') }}</h6>
        </a>

        <div class="pb-sub">
            {{ $product->is_local_shipping ? translate('Local Shipping') : translate('Shipping') }}
        </div>

        <div class="pb-price">
            @if ($product->discount > 0.0 && $product->discount_type == 'percent')
                <span class="old">{{ $product->unit_price }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 12px; height: 12px;">
                </span>
                <span class="new">{{ $product->unit_price - ($product->unit_price * $product->discount) / 100 }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 14px; height: 14px;">
                </span>
            @elseif($product->discount > 0.0 && $product->discount_type == 'amount')
                <span class="old">{{ $product->unit_price }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 12px; height: 12px;">
                </span>
                <span class="new">{{ $product->unit_price - $product->discount }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 14px; height: 14px;">
                </span>
            @else
                <span class="new">{{ $product->unit_price }}
                    <img src="{{ static_asset('assets/front_img/rs.png') }}" style="width: 14px; height: 14px;">
                </span>
            @endif
            <div class="pb-vat">{{ translate('inclusive_of_vat') }}</div>
        </div>

        <button type="button" @if ($product->current_stock <= 0) disabled @endif
            class="pb-add-btn add-to-cart-btn" data-id="{{ $product->id }}">
            <i class="fa-solid fa-cart-shopping me-1"></i>
            {{ translate('Add to Cart') }}
        </button>
    </div>
</div>
