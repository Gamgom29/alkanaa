@extends('frontend.layouts.app')

@section('style')
    <style>
        .support-box {
            background: #f2f2f2;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: auto;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            width: 100%;
        }
         /* اصلاح شكل المودال */
        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }

        .modal-body {
            font-size: 16px;
            color: #333;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="support-box">
            <h4 class="mb-4 text-center">{{ translate('maintainence_request') }}</h4>
            <form id="supportForm" enctype="multipart/form-data" method="POST" action="{{ route('quote.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="problemDesc" class="form-label">
                        @if (app()->getLocale() == 'sa')
                            وصف المشكلة:
                        @elseif(app()->getLocale() == 'cn')
                            问题描述:
                        @elseif(app()->getLocale() == 'en')
                            Problem Description:
                        @endif
                    </label>
                    <textarea id="problemDesc" class="form-control" rows="5" name="problem_desc"></textarea>
                </div>

                <div class="mb-3">
                    <label for="invoiceFile" class="form-label">
                        @if (app()->getLocale() == 'sa')
                            أرفق صورة الفاتورة:
                        @elseif(app()->getLocale() == 'cn')
                            上传发票图片:
                        @elseif(app()->getLocale() == 'en')
                            Upload Invoice Image:
                        @endif
                    </label>
                    <input type="file" class="form-control" name="invoice_file" id="invoiceFile"
                        accept="image/*, .pdf" />
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn text-white w-50" style="background-color:#242e40;">
                        @if (app()->getLocale() == 'sa')
                            إرسال
                            الطلب
                        @elseif(app()->getLocale() == 'cn')
                            提交请求
                        @elseif(app()->getLocale() == 'en')
                            Submit Request
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="confirmationModalLabel">
                        @if (app()->getLocale() == 'sa')
                            تم إرسال الطلب
                        @elseif(app()->getLocale() == 'cn')
                            请求已提交
                        @elseif(app()->getLocale() == 'en')
                            Request Submitted
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="
                    @if (app()->getLocale() == 'sa') إغلاق
                    @elseif(app()->getLocale() == 'cn')
                        关闭
                    @elseif(app()->getLocale() == 'en')
                        Close @endif
                "></button>
                </div>
                <div class="modal-body">
                    @if (app()->getLocale() == 'sa')
                        تم إرسال طلبك بنجاح، وسيتم التواصل معك خلال ٢٤ ساعة عمل.
                    @elseif(app()->getLocale() == 'cn')
                        您的请求已成功提交，我们将在 24 个工作小时内与您联系。
                    @elseif(app()->getLocale() == 'en')
                        Your request has been submitted successfully. We will contact you within 24 business hours.
                    @endif
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn" style="background-color: #bc9a9a;" data-bs-dismiss="modal">
                        @if (app()->getLocale() == 'sa')
                            تم
                        @elseif(app()->getLocale() == 'cn')
                            确定
                        @elseif(app()->getLocale() == 'en')
                            OK
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                myModal.show();
            });
        </script>
    @endif

      <style>
        .mini-cart-toast {
            position: fixed;
            top: 80px;
            z-index: 9999;
            width: min(420px, 92vw);
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            padding: 14px;
            opacity: 0;
            transform: translateX(120%);
            transition: transform .35s ease, opacity .35s ease;
        }

        .mini-cart-toast.rtl {
            right: 16px;
        }

        .mini-cart-toast.ltr {
            left: 16px;
            transform: translateX(-120%);
        }

        .mini-cart-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .mct-head {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #16a34a;
        }

        .mct-close {
            margin-inline-start: auto;
            border: 0;
            background: transparent;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .mct-body {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .mct-thumb {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #eee;
        }

        .mct-title {
            font-weight: 600;
            margin: 0 0 4px;
            font-size: 15px;
        }

        .mct-meta {
            font-size: 13px;
            color: #6b7280;
        }

        .mct-cart-link {
            display: inline-block;
            margin-top: 8px;
            font-size: 13px;
            text-decoration: underline;
        }

        .mct-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .mct-btn {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            cursor: pointer;
            font-weight: 600;
            text-align: center;
        }

        .mct-btn.primary {
            background: #111827;
            color: #fff;
            border-color: #111827;
        }
    </style>
    
    {{-- Host (not required anymore but harmless) --}}
    <div id="miniCartHost"></div>



    @include('frontend.partials.cart.cart_summary_toast')
@endsection

@section('script')
    <script type="text/javascript">
        function filter() {
            $('#search-form').submit();
        }

        function rangefilter(arg) {
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
        // ===== Format price (kept from your code) =====
        function formatPrice(n, cur) {
            try {
                return new Intl.NumberFormat(document.documentElement.lang || 'sa').format(n) + (cur ? (' ' + cur) : '');
            } catch (e) {
                return n + (cur ? (' ' + cur) : '');
            }
        }

        // ===== Show toast near the cart icon with proper arrow and scroll =====
        function mountMiniCartToastNearCart(html) {
            // Remove any existing toast (from anywhere)
            $('.mini-cart-toast').remove();

            // Append, measure, and hide initially
            const $toast = $(html).appendTo('body').css({
                position: 'absolute',
                top: 0,
                left: 0,
                visibility: 'hidden'
            });

            const cartEl = document.getElementById('nav-cart-area');
            if (!cartEl) {
                // Fallback: fixed position if cart icon missing for any reason
                $toast.css({
                    position: 'fixed',
                    visibility: 'visible',
                    top: 80,
                    right: 16
                }).addClass('show');
                return;
            }

            const rect = cartEl.getBoundingClientRect();
            const scrollY = window.scrollY || window.pageYOffset;
            const scrollX = window.scrollX || window.pageXOffset;

            const w = $toast.outerWidth();
            const isRTL = $toast.hasClass('rtl');

            const gap = 10; // distance below the icon
            let top = rect.bottom + scrollY + gap;

            // Align horizontally depending on direction
            let left;
            if (isRTL) {
                // RTL: align left edges
                left = rect.left + scrollX;
            } else {
                // LTR: align right edges
                left = rect.right + scrollX - w;
            }

            // Clamp within viewport
            const minLeft = 8 + scrollX;
            const maxLeft = scrollX + document.documentElement.clientWidth - w - 8;
            left = Math.max(minLeft, Math.min(left, maxLeft));

            // Place and animate
            $toast.css({
                top: top,
                left: left,
                visibility: 'visible',
                opacity: 0,
                transform: 'translateY(-6px)'
            });
            requestAnimationFrame(() => $toast.addClass('show').css({
                opacity: 1,
                transform: 'translateY(0)'
            }));

            // Compute arrow offset so it points to icon center
            const iconCenterX = rect.left + rect.width / 2 + scrollX;
            const toastLeft = left;
            const toastRight = left + w;
            let arrowOffset = isRTL ? (iconCenterX - toastLeft) : (toastRight - iconCenterX);
            const pad = 18;
            arrowOffset = Math.max(pad, Math.min(arrowOffset, w - pad));
            $toast[0].style.setProperty('--arrow-offset', arrowOffset + 'px');

            // Auto close after 6s
            clearTimeout(window.__mctTimer);
            window.__mctTimer = setTimeout(() => {
                $toast.find('.mct-close').trigger('click');
            }, 2500);

            // Smooth scroll to the toast area
            const targetY = Math.max(0, top - 120);
            window.scrollTo({
                top: targetY,
                behavior: 'smooth'
            });
        }

        // Close & remove toast
        $(document).on('click', '.mct-close', function() {
            $(this).closest('.mini-cart-toast').remove();
        });

        // ===== Add-to-Cart with loading state =====
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const id = $btn.data('id');

            const originalHtml = $btn.html();
            $btn.addClass('is-loading').prop('disabled', true)
                .html('<span class="btn-spinner" aria-hidden="true"></span>');

            $.post('{{ route('cart.addToCart') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: 1
            }).done(function(res) {
                if (typeof res.cart_count !== 'undefined') {
                    $('.cart-count-span').text(res.cart_count);
                }
                if (res.modal_view) {
                    mountMiniCartToastNearCart(res.modal_view);
                } else if (res.status != 1) {
                    alert(res.message || 'تعذر الإضافة');
                }
            }).fail(function() {
                alert('تعذر الاتصال بالسيرفر');
            }).always(function() {
                $btn.removeClass('is-loading').prop('disabled', false).html(originalHtml);
            });
        });

        // ===== Sliders (as in your original) =====
        const slider = document.getElementById('slider');
        const nextBtn = document.querySelector('.next-btn');
        const prevBtn = document.querySelector('.prev-btn');
        if (nextBtn && prevBtn && slider) {
            nextBtn.addEventListener('click', () => slider.scrollBy({
                left: -180,
                behavior: 'smooth'
            }));
            prevBtn.addEventListener('click', () => slider.scrollBy({
                left: 180,
                behavior: 'smooth'
            }));
        }

        const sliderarrivals = document.getElementById('slider-arrivals');
        const nextBtnarrivals = document.querySelector('.next-btn-arrivals');
        const prevBtnarrivals = document.querySelector('.prev-btn-arrivals');
        if (nextBtnarrivals && prevBtnarrivals && sliderarrivals) {
            nextBtnarrivals.addEventListener('click', () => sliderarrivals.scrollBy({
                left: -180,
                behavior: 'smooth'
            }));
            prevBtnarrivals.addEventListener('click', () => sliderarrivals.scrollBy({
                left: 180,
                behavior: 'smooth'
            }));
        }

        // فتح الـ Offcanvas عند الضغط على زر "اذهب إلى السلة" داخل التوست
        $(document).on('click', '.go-cart-btn', function(e) {
            e.preventDefault();
            const el = document.getElementById('cartOffcanvas');
            if (!el) {
                window.location.href = "{{ route('cart') }}";
                return;
            }

            // هات أحدث محتوى للأصناف + الملخص بس
            refreshCartToast();
            const off = bootstrap.Offcanvas.getOrCreateInstance(el);
            off.show();
        });


        document.addEventListener("click", function(e) {
            if (e.target && e.target.id === "openFormBtn") {
                const bottomSheet = document.getElementById("bottomSheet");
                if (bottomSheet) bottomSheet.style.display = "flex";
            }

            if (e.target && e.target.id === "closeFormBtn") {
                const bottomSheet = document.getElementById("bottomSheet");
                if (bottomSheet) bottomSheet.style.display = "none";
            }

            if (e.target && e.target.id === "bottomSheet") {
                e.target.style.display = "none";
            }
        });
    </script>
@endsection

