<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carrier;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Country;
use Auth;
use App\Utility\CartUtility;
use Session;
use Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            if ($request->session()->get('temp_user_id')) {
                Cart::where('temp_user_id', $request->session()->get('temp_user_id'))
                    ->update(
                        [
                            'user_id' => $user_id,
                            'temp_user_id' => null
                        ]
                    );

                Session::forget('temp_user_id');
            }
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = ($temp_user_id != null) ? Cart::where('temp_user_id', $temp_user_id)->get() : [];
        }
        if (count($carts) > 0) {
            $carts->toQuery()->update(['shipping_cost' => 0]);
            $carts = $carts->fresh();
        }

        return view('frontend.view_cart', compact('carts'));
    }

    public function getCartSummaryToast()
    {
        $user = auth()->user();
        $temp_user = session()->get('temp_user_id');

        $carts = $user
            ? \App\Models\Cart::where('user_id', $user->id)->latest()->get()
            : \App\Models\Cart::where('temp_user_id', $temp_user)->latest()->get();

        return view('frontend.partials.cart.cart_summary_body', compact('carts'))->render();
    }


    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.partials.cart.addToCart', compact('product'));
    }

    public function showCartModalAuction(Request $request)
    {
        $product = Product::find($request->id);
        return view('auction.frontend.addToCartAuction', compact('product'));
    }

    // public function addToCart(Request $request)
    // {
    //     $authUser = auth()->user();
    //     if($authUser != null) {
    //         $user_id = $authUser->id;
    //         $data['user_id'] = $user_id;
    //         $carts = Cart::where('user_id', $user_id)->get();
    //     } else {
    //         if($request->session()->get('temp_user_id')) {
    //             $temp_user_id = $request->session()->get('temp_user_id');
    //         } else {
    //             $temp_user_id = bin2hex(random_bytes(10));
    //             $request->session()->put('temp_user_id', $temp_user_id);
    //         }
    //         $data['temp_user_id'] = $temp_user_id;
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);
    //     $product = Product::find($request->id);
    //     $carts = array();

    //     if($check_auction_in_cart && $product->auction_product == 0) {
    //         return array(
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.cart.removeAuctionProductFromCart')->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         );
    //     }

    //     $quantity = $request['quantity'];

    //     if ($quantity < $product->min_qty) {
    //         return array(
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         );
    //     }

    //     //check the color enabled or disabled for the product
    //     $str = CartUtility::create_cart_variant($product, $request->all());
    //     $product_stock = $product->stocks->where('variant', $str)->first();

    //     if($authUser != null) {
    //         $user_id = $authUser->id;
    //         $cart = Cart::firstOrNew([
    //             'variation' => $str,
    //             'user_id' => $user_id,
    //             'product_id' => $request['id']
    //         ]);
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $cart = Cart::firstOrNew([
    //             'variation' => $str,
    //             'temp_user_id' => $temp_user_id,
    //             'product_id' => $request['id']
    //         ]);
    //     }

    //     if ($cart->exists && $product->digital == 0) {
    //         if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
    //             return array(
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.cart.auctionProductAlredayAddedCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             );
    //         }
    //         if ($product_stock->qty < $cart->quantity + $request['quantity']) {
    //             return array(
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.outOfStockCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             );
    //         }
    //         $quantity = $cart->quantity + $request['quantity'];
    //     }

    //     $price = CartUtility::get_price($product, $product_stock, $request->quantity);
    //     $tax = CartUtility::tax_calculation($product, $price);

    //     CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

    //     if($authUser != null) {
    //         $user_id = $authUser->id;
    //         $carts = Cart::where('user_id', $user_id)->get();
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     return array(
    //         'status' => 1,
    //         'cart_count' => count($carts),
    //         'modal_view' => view('frontend.partials.cart.addedToCart', compact('product', 'cart'))->render(),
    //         'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //     );
    // }
    // public function addToCart(Request $request)
    // {
    //     $authUser = auth()->user();
    //     if ($authUser != null) {
    //         $user_id = $authUser->id;
    //         $carts = Cart::where('user_id', $user_id)->get();
    //     } else {
    //         if ($request->session()->get('temp_user_id')) {
    //             $temp_user_id = $request->session()->get('temp_user_id');
    //         } else {
    //             $temp_user_id = bin2hex(random_bytes(10));
    //             $request->session()->put('temp_user_id', $temp_user_id);
    //         }
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);
    //     $product = Product::find($request->id);
    //     $carts = array();

    //     if ($check_auction_in_cart && $product->auction_product == 0) {
    //         return array(
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.cart.removeAuctionProductFromCart')->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         );
    //     }

    //     $quantity = $request['quantity'];

    //     if ($quantity < $product->min_qty) {
    //         return array(
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         );
    //     }

    //     $str = CartUtility::create_cart_variant($product, $request->all());
    //     $product_stock = $product->stocks->where('variant', $str)->first();

    //     if ($authUser != null) {
    //         $cart = Cart::firstOrNew([
    //             'variation' => $str,
    //             'user_id' => $authUser->id,
    //             'product_id' => $request['id']
    //         ]);
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $cart = Cart::firstOrNew([
    //             'variation' => $str,
    //             'temp_user_id' => $temp_user_id,
    //             'product_id' => $request['id']
    //         ]);
    //     }

    //     if ($cart->exists && $product->digital == 0) {
    //         if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
    //             return array(
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.cart.auctionProductAlredayAddedCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             );
    //         }
    //         if ($product_stock->qty < $cart->quantity + $request['quantity']) {
    //             return array(
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.outOfStockCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             );
    //         }
    //         $quantity = $request['quantity'];
    //     }

    //     // ابدأ السعر من سعر المخزن
    //     $price = $product_stock ? $product_stock->price : $product->unit_price;

    //     // لو Wholesale product، حاول تجيب سعر wholesale
    //     if ($product->wholesale_product) {
    //         $wholesalePrice = $product_stock->wholesalePrices
    //             ->where('min_qty', '<=', $quantity)
    //             ->where('max_qty', '>=', $quantity)
    //             ->first();
    //         if ($wholesalePrice) {
    //             $price = $wholesalePrice->price;
    //         }
    //     }

    //     // احسب الخصم
    //     $price = CartUtility::discount_calculation($product, $price);


    //     // اضف الخدمة لو متعلم عليها
    //     $add_service = $request->has('add_service') && $request->add_service == 1;
    //     // if ($add_service) {
    //     //     $price += $product->service_fee;
    //     // }

    //     $tax = CartUtility::tax_calculation($product, $price);

    //     $cart->add_service = $add_service ? 1 : 0;

    //     CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

    //     if ($authUser != null) {
    //         $carts = Cart::where('user_id', $authUser->id)->get();
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     return array(
    //         'status' => 1,
    //         'cart_count' => count($carts),
    //         'modal_view' => view('frontend.partials.cart.addedToCart', compact('product', 'cart'))->render(),
    //         'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //     );
    // }

    public function addToCart(Request $request)
    {
        try {
            $authUser = auth()->user();

            if ($authUser) {
                $carts = Cart::where('user_id', $authUser->id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                if (!$temp_user_id) {
                    $temp_user_id = bin2hex(random_bytes(10));
                    $request->session()->put('temp_user_id', $temp_user_id);
                }
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }

            $product = Product::findOrFail($request->id);

            // لو في مزاد الخ...
            if (CartUtility::check_auction_in_cart($carts) && $product->auction_product == 0) {
                return [
                    'status' => 0,
                    'cart_count' => $carts->count(),
                    'modal_view' => view('frontend.partials.cart.removeAuctionProductFromCart')->render(),
                    'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
                ];
            }

            $quantity = max(1, (int) $request->input('quantity', 1));
            if ($quantity < (int) $product->min_qty) {
                return [
                    'status' => 0,
                    'cart_count' => $carts->count(),
                    'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
                    'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
                ];
            }

            $str = CartUtility::create_cart_variant($product, $request->all());

            // حاول بالأول على الڤاريانت.. لو فاضي/مش موجود خُد أول ستوك كـ fallback
            $product_stock = $product->stocks->where('variant', $str)->first();
            if (!$product_stock) {
                $product_stock = $product->stocks->first(); // ممكن تبقى برضه null لو مفيش ستوكس
            }

            // جهّز الـCart row
            if ($authUser) {
                $cart = Cart::firstOrNew([
                    'variation'  => $str,
                    'user_id'    => $authUser->id,
                    'product_id' => $product->id,
                ]);
            } else {
                $cart = Cart::firstOrNew([
                    'variation'    => $str,
                    'temp_user_id' => $temp_user_id,
                    'product_id'   => $product->id,
                ]);
            }

            // فحص الكمية مع مراعاة احتمال عدم وجود stock record
            if ($cart->exists && $product->digital == 0) {
                if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
                    return [
                        'status' => 0,
                        'cart_count' => $carts->count(),
                        'modal_view' => view('frontend.partials.cart.auctionProductAlredayAddedCart')->render(),
                        'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
                    ];
                }

                if ($product_stock && $product_stock->qty < ($cart->quantity + $quantity)) {
                    return [
                        'status' => 0,
                        'cart_count' => $carts->count(),
                        'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                        'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
                    ];
                }
            } else {
                // أول إضافة: برضه افحص الحد الأقصى لو عندك stock record
                if ($product->digital == 0 && $product_stock && $product_stock->qty < $quantity) {
                    return [
                        'status' => 0,
                        'cart_count' => $carts->count(),
                        'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                        'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
                    ];
                }
            }

            // السعر الأساسي (لو مفيش stock خالص، استخدم unit_price)
            $price = $product_stock ? $product_stock->price : $product->unit_price;

            // wholesale
            if ($product->wholesale_product && $product_stock) {
                $wholesalePrice = $product_stock->wholesalePrices
                    ->where('min_qty', '<=', $quantity)
                    ->where('max_qty', '>=', $quantity)
                    ->first();
                if ($wholesalePrice) {
                    $price = $wholesalePrice->price;
                }
            }

            // الخصم والضريبة
            $price = CartUtility::discount_calculation($product, $price);
            $tax   = CartUtility::tax_calculation($product, $price);

            // خدمة إضافية (اختياري)
            $cart->add_service = (int) $request->boolean('add_service');

            // احفظ
            CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

            // أعد تحميل عدد العناصر
            if ($authUser) {
                $carts = Cart::where('user_id', $authUser->id)->get();
            } else {
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }

            return [
                'status'        => 1,
                'cart_count'    => $carts->count(),
                'modal_view'    => view('frontend.partials.cart.addedToCartToast', compact('product', 'cart'))->render(),
                'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
            ];
        } catch (\Throwable $e) {
            \Log::error('addToCart error: ' . $e->getMessage(), ['exception' => $e]);
            $message = translate('Something went wrong. Please try again.');
            return response()->json([
                'status'  => 0,
                'modal_view' => '<div class="p-4 text-center">' . e($message) . '</div>',
                'message' => 'حدث خطأ غير متوقع.',
            ]);
        }
    }

    // public function addToCart(Request $request)
    // {
    //     $authUser = auth()->user();
    //     if ($authUser != null) {
    //         $user_id = $authUser->id;
    //         $carts = Cart::where('user_id', $user_id)->get();
    //     } else {
    //         if ($request->session()->get('temp_user_id')) {
    //             $temp_user_id = $request->session()->get('temp_user_id');
    //         } else {
    //             $temp_user_id = bin2hex(random_bytes(10));
    //             $request->session()->put('temp_user_id', $temp_user_id);
    //         }
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);
    //     $product = Product::find($request->id);
    //     $carts = [];

    //     if ($check_auction_in_cart && $product->auction_product == 0) {
    //         return [
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.cart.removeAuctionProductFromCart')->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         ];
    //     }

    //     $quantity = (int) $request['quantity'];

    //     if ($quantity < $product->min_qty) {
    //         return [
    //             'status' => 0,
    //             'cart_count' => count($carts),
    //             'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
    //             'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //         ];
    //     }

    //     $str = CartUtility::create_cart_variant($product, $request->all());
    //     $product_stock = $product->stocks->where('variant', $str)->first();

    //     if ($authUser != null) {
    //         $cart = Cart::firstOrNew([
    //             'variation' => $str,
    //             'user_id'   => $authUser->id,
    //             'product_id' => $request['id']
    //         ]);
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $cart = Cart::firstOrNew([
    //             'variation'   => $str,
    //             'temp_user_id' => $temp_user_id,
    //             'product_id'  => $request['id']
    //         ]);
    //     }

    //     if ($cart->exists && $product->digital == 0) {
    //         if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
    //             return [
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.cart.auctionProductAlredayAddedCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             ];
    //         }
    //         if ($product_stock->qty < $cart->quantity + $request['quantity']) {
    //             return [
    //                 'status' => 0,
    //                 'cart_count' => count($carts),
    //                 'modal_view' => view('frontend.partials.outOfStockCart')->render(),
    //                 'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //             ];
    //         }
    //         $quantity = (int) $request['quantity'];
    //     }

    //     // السعر الأساسي
    //     $price = $product_stock ? $product_stock->price : $product->unit_price;

    //     // wholesale
    //     if ($product->wholesale_product && $product_stock) {
    //         $wholesalePrice = $product_stock->wholesalePrices
    //             ->where('min_qty', '<=', $quantity)
    //             ->where('max_qty', '>=', $quantity)
    //             ->first();
    //         if ($wholesalePrice) {
    //             $price = $wholesalePrice->price;
    //         }
    //     }

    //     // الخصم
    //     $price = CartUtility::discount_calculation($product, $price);

    //     // خدمة إضافية
    //     $add_service = $request->has('add_service') && $request->add_service == 1;

    //     $tax = CartUtility::tax_calculation($product, $price);
    //     $cart->add_service = $add_service ? 1 : 0;

    //     CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

    //     // أعِد تحميل العربة بعد الحفظ
    //     if ($authUser != null) {
    //         $carts = Cart::where('user_id', $authUser->id)->get();
    //     } else {
    //         $temp_user_id = $request->session()->get('temp_user_id');
    //         $carts = Cart::where('temp_user_id', $temp_user_id)->get();
    //     }

    //     // >>> الريترن النهائي (نجاح) — بنفس المفتاح modal_view لكن محتواه توست
    //     return [
    //         'status'        => 1,
    //         'cart_count'    => count($carts),
    //         'auth'          => auth()->check(),
    //         'item'          => [
    //             'id'       => $product->id,
    //             'name'     => $product->getTranslation('name', app()->getLocale()),
    //             'price'    => (float) $price,
    //             'qty'      => (int) $cart->quantity,
    //             'image'    => uploaded_asset($product->thumbnail_img), // عدّل حسب مشروعك
    //             'currency' => function_exists('currency_symbol') ? currency_symbol() : '',
    //         ],
    //         'modal_view'    => view('frontend.partials.cart.addedToCartToast', compact('product', 'cart'))->render(),
    //         'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
    //     ];
    // }



    //removes from Cart
    public function removeFromCart(Request $request)
    {
        Cart::destroy($request->id);
        $authUser = auth()->user();
        if ($authUser != null) {
            $user_id = $authUser->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend.partials.cart.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
        );
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cartItem = Cart::findOrFail($request->id);

        if ($cartItem['id'] == $request->id) {
            $product = Product::find($cartItem['product_id']);
            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();

            $quantity = $product_stock ? $product_stock->qty : 0;
            $price = $product_stock ? $product_stock->price : $product->unit_price;

            // لو Wholesale product، حاول تجيب سعر wholesale
            if ($product->wholesale_product && $product_stock) {
                $wholesalePrice = $product_stock->wholesalePrices
                    ->where('min_qty', '<=', $request->quantity)
                    ->where('max_qty', '>=', $request->quantity)
                    ->first();
                if ($wholesalePrice) {
                    $price = $wholesalePrice->price;
                }
            }

            // احسب الخصم
            $price = CartUtility::discount_calculation($product, $price);

            // اضف الخدمة لو موجودة
            $add_service = $cartItem->add_service == 1;
            // if ($add_service) {
            //     $price += $product->service_fee;
            // }

            if ($quantity >= $request->quantity) {
                if ($request->quantity >= $product->min_qty) {
                    $cartItem['quantity'] = $request->quantity;
                }
            }

            $cartItem['price'] = $price;
            $cartItem->save();
        }

        if (auth()->user() != null) {
            $carts = Cart::where('user_id', auth()->id())->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend.partials.cart.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend.partials.cart.cart')->render(),
        );
    }



    public function updateCartStatus(Request $request)
    {
        $product_ids = $request->product_id;

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        $coupon_applied = $carts->toQuery()->where('coupon_applied', 1)->first();
        if ($coupon_applied != null) {
            $owner_id = $coupon_applied->owner_id;
            $coupon_code = $coupon_applied->coupon_code;
            $user_carts = $carts->toQuery()->where('owner_id', $owner_id)->get();
            $coupon_discount = $user_carts->toQuery()->sum('discount');
            $user_carts->toQuery()->update(
                [
                    'discount' => 0.00,
                    'coupon_code' => '',
                    'coupon_applied' => 0
                ]
            );
        }

        $carts->toQuery()->update(['status' => 0]);
        if ($product_ids != null) {
            if ($coupon_applied != null) {
                $active_user_carts = $user_carts->toQuery()->whereIn('product_id', $product_ids)->get();
                if (count($active_user_carts) > 0) {
                    $active_user_carts->toQuery()->update(
                        [
                            'discount' => $coupon_discount / count($active_user_carts),
                            'coupon_code' => $coupon_code,
                            'coupon_applied' => 1
                        ]
                    );
                }
            }

            $carts->toQuery()->whereIn('product_id', $product_ids)->update(['status' => 1]);
        }
        $carts = $carts->fresh();

        return view('frontend.partials.cart.cart_details', compact('carts'))->render();
    }

    public function offcanvas(Request $request)
    {
        // هات نفس السلة اللي بتستخدمها في كل مكان (يوزر/زائر مؤقت)
        $query = auth()->check()
            ? Cart::where('user_id', auth()->id())
            : Cart::where('temp_user_id', session()->get('temp_user_id'));

        $carts = $query->latest()->get();

        // رجّع HTML للأجزاء الديناميكية فقط (items + summary)
        $html = view('frontend.partials.cart.cart_summary_toast', compact('carts'))->render();

        return response()->json([
            'html'  => $html,
            'count' => $carts->count(), // عشان نحدّث عداد الكارت في الهيدر
        ]);
    }
}
