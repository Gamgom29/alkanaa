<div class="p-1 sm:p-3">
    <input type="hidden" name="checkout_type" value="guest">

    <div class="row g-3">
        <!-- Name -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Name') }} <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6] focus:ring-1 focus:ring-[#4868e6]"
                placeholder="{{ translate('Your Name') }}" name="name" required>
        </div>

        <!-- Email -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Email') }} <span class="text-danger">*</span>
            </label>
            <input type="email" class="form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6] focus:ring-1 focus:ring-[#4868e6]"
                placeholder="{{ translate('Your Email') }}" name="email" required>
        </div>

        <!-- Phone -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Phone') }} <span class="text-danger">*</span>
            </label>
            <input type="tel" id="phone-code" class="form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6] focus:ring-1 focus:ring-[#4868e6]"
                placeholder="05xxxxxxxx" name="phone" dir="ltr" required>
            <input type="hidden" name="country_code" value="">
        </div>

        <!-- Country -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Country') }} <span class="text-danger">*</span>
            </label>
            <select class="form-select form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6]"
                name="country_id" onchange="get_states(this.value)" required>
                <option value="">{{ translate('Select your country') }}</option>
                @foreach (get_active_countries() as $key => $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- State -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('State') }} <span class="text-danger">*</span>
            </label>
            <select class="form-select form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6]"
                name="state_id" onchange="get_cities(this.value)" required>
                <option value="">{{ translate('Select state') }}</option>
            </select>
        </div>

        <!-- City -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('City') }} <span class="text-danger">*</span>
            </label>
            <select class="form-select form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6]"
                name="city_id" required>
                <option value="">{{ translate('Select city') }}</option>
            </select>
        </div>

        <!-- Address -->
        <div class="col-12">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Address') }} <span class="text-danger">*</span>
            </label>
            <textarea class="form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6]"
                placeholder="{{ translate('Your Address (Street, District, Building No.)') }}" rows="2" name="address" required></textarea>
        </div>

        <!-- Postal Code -->
        <div class="col-12 col-md-6">
            <label class="form-label text-xs sm:text-sm font-bold text-neutral-800 mb-1.5">
                {{ translate('Postal code') }}
            </label>
            <input type="text" class="form-control rounded-xl border border-neutral-300 px-3.5 py-2.5 text-sm text-neutral-800 focus:border-[#4868e6]"
                placeholder="{{ translate('Your Postal Code') }}" name="postal_code">
        </div>
    </div>

    <!-- Login Prompt Box -->
    <div class="mt-4 p-3 rounded-xl bg-blue-50/70 border border-blue-100 flex items-center gap-2 text-xs text-[#0c234a]">
        <i class="fa-solid fa-circle-info text-[#4868e6] text-sm flex-shrink-0"></i>
        <div>
            {{ translate('If you have already used the same mail address or phone number before, please ') }}
            <a href="{{ route('user.login') }}" class="font-bold text-[#4868e6] underline">{{ translate('Login') }}</a>
            {{ translate(' first to continue') }}
        </div>
    </div>
</div>

<script>
    function get_states(country_id) {
        if (!country_id) return;
        $('select[name="state_id"]').html('<option value="">{{ translate("Loading...") }}</option>');
        $.post('{{ route("get_state") }}', {
            _token: '{{ csrf_token() }}',
            country_id: country_id
        }, function(data) {
            let options = '<option value="">{{ translate("Select state") }}</option>';
            data.forEach(function(state) {
                options += '<option value="' + state.id + '">' + state.name + '</option>';
            });
            $('select[name="state_id"]').html(options);
            $('select[name="city_id"]').html('<option value="">{{ translate("Select city") }}</option>');
        });
    }

    function get_cities(state_id) {
        if (!state_id) return;
        $('select[name="city_id"]').html('<option value="">{{ translate("Loading...") }}</option>');
        $.post('{{ route("get_city") }}', {
            _token: '{{ csrf_token() }}',
            state_id: state_id
        }, function(data) {
            let options = '<option value="">{{ translate("Select city") }}</option>';
            data.forEach(function(city) {
                options += '<option value="' + city.id + '">' + city.name + '</option>';
            });
            $('select[name="city_id"]').html(options);
        });
    }
</script>
