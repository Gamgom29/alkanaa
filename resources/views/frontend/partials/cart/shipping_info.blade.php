@if ($errors->any())
    <div class="alert alert-danger rounded-xl mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Auth::check())
    @php
        $userAddresses = Auth::user()->addresses;
    @endphp

    @if ($userAddresses->count() > 0)
        <div class="row gy-3 mb-4">
            @foreach ($userAddresses as $key => $address)
                @php
                    $isSelected = ($address->id == $address_id) || ($address_id == null && $key == 0);
                @endphp
                <div class="col-md-6">
                    <label class="d-block cursor-pointer position-relative h-100 mb-0">
                        <input type="radio" name="address_id" value="{{ $address->id }}" class="d-none address-radio-input"
                            @if ($isSelected) checked @endif required>
                        <div class="p-3.5 rounded-2xl border transition-all h-100 address-card-box {{ $isSelected ? 'border-[#4868e6] bg-[#f0f4ff] shadow-sm' : 'border-neutral-200 bg-white hover:border-neutral-300' }}"
                            style="cursor: pointer; min-height: 140px;">
                            <div class="d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="custom-radio-circle flex size-5 items-center justify-center rounded-full border {{ $isSelected ? 'border-[#4868e6] bg-[#4868e6] text-white' : 'border-neutral-300 bg-white' }}">
                                        <i class="fa-solid fa-check text-[10px] {{ $isSelected ? '' : 'd-none' }}"></i>
                                    </span>
                                    <span class="font-bold text-sm text-[#0c234a]">
                                        {{ optional($address->city)->name ?? translate('Address') }} {{ $key + 1 }}
                                    </span>
                                </div>
                                <button type="button" class="btn btn-sm btn-link text-[#4868e6] text-xs font-bold p-0 text-decoration-none" onclick="edit_address('{{$address->id}}')">
                                    <i class="fa-solid fa-pen-to-square"></i> {{ translate('Change') }}
                                </button>
                            </div>

                            <div class="text-xs text-neutral-600 space-y-1 pe-4">
                                <div class="d-flex align-items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-neutral-400 text-xs"></i>
                                    <span>{{ $address->address }}</span>
                                </div>
                                @if (optional($address->city)->name || optional($address->country)->name)
                                    <div class="d-flex align-items-center gap-1.5">
                                        <i class="fa-solid fa-city text-neutral-400 text-xs"></i>
                                        <span>{{ optional($address->city)->name }} {{ optional($address->country)->name ? ', ' . optional($address->country)->name : '' }}</span>
                                    </div>
                                @endif
                                @if ($address->phone)
                                    <div class="d-flex align-items-center gap-1.5">
                                        <i class="fa-solid fa-phone text-neutral-400 text-xs"></i>
                                        <span dir="ltr">{{ $address->phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>

        <input type="hidden" name="checkout_type" value="logged">

        <!-- Add Another Address Button -->
        <div class="mt-3">
            <button type="button" class="btn border-2 border-dashed border-[#4868e6]/40 bg-[#4868e6]/5 text-[#4868e6] hover:bg-[#4868e6]/10 font-bold text-xs sm:text-sm py-3 px-5 rounded-xl w-100 d-flex align-items-center justify-content-center gap-2 transition"
                onclick="add_new_address()">
                <i class="fa-solid fa-plus"></i>
                <span>{{ translate('Add New Address') }}</span>
            </button>
        </div>
    @else
        <!-- Empty Addresses State -->
        <div class="text-center py-5 px-4 rounded-2xl border-2 border-dashed border-neutral-200 bg-neutral-50/50">
            <div class="flex size-14 items-center justify-center rounded-full bg-[#4868e6]/10 text-[#4868e6] mx-auto mb-3">
                <i class="fa-solid fa-location-dot text-2xl"></i>
            </div>
            <h4 class="text-base font-bold text-[#0c234a] mb-1">
                لا يوجد لديك أي عنوان شحن مسجل
            </h4>
            <p class="text-xs text-neutral-500 mb-4 max-w-sm mx-auto">
                يرجى إضافة عنوانك لتتمكن من اختيار خيارات التوصيل وإتمام طلبك بكل سهولة
            </p>
            <input type="hidden" name="checkout_type" value="logged">
            <button type="button" class="yellow-cta-btn px-6 py-2.5 text-sm font-bold shadow-sm" onclick="add_new_address()">
                <i class="fa-solid fa-plus me-1"></i> إضافة عنوان جديد للشحن
            </button>
        </div>
    @endif
@else
    <!-- Guest Shipping address -->
    @include('frontend.partials.cart.guest_shipping_info')
@endif

<script>
    document.querySelectorAll('.address-radio-input').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.address-card-box').forEach(function(card) {
                card.classList.remove('border-[#4868e6]', 'bg-[#f0f4ff]', 'shadow-sm');
                card.classList.add('border-neutral-200', 'bg-white');
                const checkIcon = card.querySelector('.custom-radio-circle i');
                const radioCircle = card.querySelector('.custom-radio-circle');
                if (checkIcon) checkIcon.classList.add('d-none');
                if (radioCircle) {
                    radioCircle.classList.remove('border-[#4868e6]', 'bg-[#4868e6]', 'text-white');
                    radioCircle.classList.add('border-neutral-300', 'bg-white');
                }
            });

            if (this.checked) {
                const parentCard = this.closest('label').querySelector('.address-card-box');
                if (parentCard) {
                    parentCard.classList.add('border-[#4868e6]', 'bg-[#f0f4ff]', 'shadow-sm');
                    parentCard.classList.remove('border-neutral-200', 'bg-white');
                    const checkIcon = parentCard.querySelector('.custom-radio-circle i');
                    const radioCircle = parentCard.querySelector('.custom-radio-circle');
                    if (checkIcon) checkIcon.classList.remove('d-none');
                    if (radioCircle) {
                        radioCircle.classList.add('border-[#4868e6]', 'bg-[#4868e6]', 'text-white');
                        radioCircle.classList.remove('border-neutral-300', 'bg-white');
                    }
                }
            }
        });
    });
</script>
