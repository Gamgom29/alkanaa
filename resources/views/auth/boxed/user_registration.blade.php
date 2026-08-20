@extends('frontend.layouts.app')
@section('style')
    <!-- Toastr CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white mt-5">
        <section class="bg-white overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="card shadow-none rounded-0 border-0">

                            <div class="no-gutters">
                                {{-- <!-- Left Side Image-->
                            <div class="col-lg-6">
                                <img src="{{ uploaded_asset(get_setting('customer_register_page_image')) }}" alt="{{ translate('Customer Register Page Image') }}" class="img-fit h-100">
                            </div> --}}

                                <!-- Right Side -->
                                <div class="p-4 p-lg-5 d-flex flex-column justify-content-center border right-content"
                                    style="height: auto;">
                                    <!-- Site Icon -->
                                    <div class="size-48px mb-3 mx-auto mx-lg-0">
                                        <img src="{{ uploaded_asset(get_setting('site_icon')) }}"
                                            alt="{{ translate('Site Icon') }}" class="img-fit h-100">
                                    </div>

                                    <!-- Titles -->
                                    <div class="text-center text-lg-left">
                                        <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;">
                                            {{ translate('Create an account') }}</h1>
                                    </div>

                                    <!-- Register form -->
                                    <div class="pt-3">
                                        <div class="">
                                            <form id="reg-form" class="form-default" role="form"
                                                action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name"
                                                        class="fs-12 fw-700 text-soft-dark">{{ translate('Full Name') }}</label>
                                                    <input type="text" required
                                                        class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        value="{{ old('name') }}"
                                                        placeholder="{{ translate('Full Name') }}" name="name">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>



                                                @if (true)
                                                    {{-- Show both fields with the toggle button if neither email nor phone is set --}}
                                                    <div class="form-group phone-form-group mb-1">
                                                        <label for="phone"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Phone') }}</label>
                                                        <input type="tel" id="phone-code" required
                                                            class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                            value="{{ old('phone') }}" placeholder="" name="phone"
                                                            autocomplete="off">
                                                    </div>

                                                    <input type="hidden" id="country_code" name="country_code"
                                                        value="{{ old('country_code', 'SA') }}"> {{-- Default to 'US' --}}

                                                    <div class="form-group email-form-group mb-1">
                                                        <label for="email"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                                        <input type="email" required
                                                            class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{ old('email') }}"
                                                            placeholder="{{ translate('Email') }}" name="email"
                                                            autocomplete="off">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- <div class="form-group text-right">
                                                            <button class="btn btn-link p-0 text-primary" type="button"
                                                                onclick="toggleEmailPhone(this)">
                                                                <i>*{{ translate('Use Email Instead') }}</i>
                                                            </button>
                                                        </div> --}}
                                                @else
                                                    {{-- If OTP system is disabled, show only the email field --}}
                                                    <div class="form-group">
                                                        <label for="email"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                                        <input type="email" required
                                                            class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{ $email ?? old('email') }}"
                                                            placeholder="{{ translate('Email') }}" name="email"
                                                            {{ $email ? 'readonly' : '' }}>
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif


                                                <!-- password -->
                                                <div class="form-group mb-0">
                                                    <label for="password"
                                                        class="fs-12 fw-700 text-soft-dark">{{ translate('Password') }}</label>
                                                    <div class="position-relative">
                                                        <input type="password" required
                                                            class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ translate('Password') }}" name="password">
                                                        <i class="password-toggle las la-2x la-eye"></i>
                                                    </div>
                                                    <div class="text-right mt-1">
                                                        <span
                                                            class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- password Confirm -->
                                                <div class="form-group">
                                                    <label for="password_confirmation"
                                                        class="fs-12 fw-700 text-soft-dark">{{ translate('Confirm Password') }}</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control rounded-0"
                                                            placeholder="{{ translate('Confirm Password') }}"
                                                            name="password_confirmation">
                                                        <i class="password-toggle las la-2x la-eye"></i>
                                                    </div>
                                                </div>

                                                <div class="border p-3 m-2 c-pointer text-center bg-light has-transition hov-bg-soft-light h-100 d-flex flex-column justify-content-center"
                                                    onclick="add_new_address()">
                                                    <i class="las la-plus mb-1 fs-20 text-gray"></i>
                                                    <div class="alpha-7 fw-700">{{ translate('Add New Address') }}</div>
                                                </div>

                                                <!-- ✅ أضف هذا قبل شروط الاستخدام مباشرة -->

                                                <!-- Company Checkbox -->
                                                <div class="mb-3">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" id="is_company_checkbox" name="is_company"
                                                            value="1" onchange="toggleCompanyFields()">
                                                        <span>{{ translate('Register as a Company') }}</span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>

                                                <!-- Hidden Company Fields -->
                                                <div id="company_fields" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="company_name"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Company Name') }}</label>
                                                        <input type="text" name="company_name"
                                                            class="form-control rounded-0"
                                                            placeholder="{{ translate('Enter company name') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="commercial_register"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Commercial Register') }}</label>
                                                        <input type="text" name="commercial_register"
                                                            class="form-control rounded-0"
                                                            placeholder="{{ translate('Enter commercial register number') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tax_number"
                                                            class="fs-12 fw-700 text-soft-dark">{{ translate('Tax Number') }}</label>
                                                        <input type="text" name="tax_number"
                                                            class="form-control rounded-0"
                                                            placeholder="{{ translate('Enter tax number') }}">
                                                    </div>
                                                    <div class="alert alert-danger mt-3 fw-bold" role="alert">
                                                        @if(app()->getLocale()=="sa")
                                                        <p class="mb-1">⚠️ يرجى التأكد من إدخال البيانات المطلوبة بدقة،
                                                            لأنها ستُستخدم في إعداد الفواتير وعروض الأسعار الخاصة بك.</p>
                                                        @elseif(app()->getLocale() == "cn")
                                                        <p class="mb-0">⚠️ 请确保准确填写所需信息，这些信息将用于您的发票和报价单。</p>
                                                        
                                                        @else
                                                        <p class="mb-1">⚠️ Please make sure to enter the required data
                                                            accurately, as it will be used for your invoices and quotations.
                                                        </p>
                                                        @endif
                                                    </div>

                                                </div>


                                                <div class="modal fade" id="new-address-modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="newAddressLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document"> <!-- modal-lg هنا أساسي -->
                                                        <div class="modal-content rounded-0"
                                                            style="width: 100%; background-color: white; margin: 0% auto;">
                                                            <div class="modal-header bg-light border-bottom">
                                                                <h5 class="modal-title fw-600" id="newAddressLabel">
                                                                    {{ translate('New Address') }}</h5>
                                                                {{-- <button type="button" class="close btn btn-sm btn-light"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    &times;
                                                                </button> --}}
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <!-- Address -->
                                                                <div class="form-group">
                                                                    <label
                                                                        class="fw-600">{{ translate('Address') }}</label>
                                                                    <textarea class="form-control rounded-0" name="address" rows="2" required
                                                                        placeholder="{{ translate('Your Address') }}"></textarea>
                                                                </div>

                                                                <!-- Country -->
                                                                <div class="form-group">
                                                                    <label
                                                                        class="fw-600">{{ translate('Country') }}</label>
                                                                    <select class="form-select rounded-0"
                                                                        data-live-search="true" name="country_id"
                                                                        required>
                                                                        <option value="">
                                                                            {{ translate('Select your country') }}</option>
                                                                        @foreach (get_active_countries() as $country)
                                                                            <option value="{{ $country->id }}">
                                                                                {{ translate($country->name) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- State -->
                                                                <div class="form-group">
                                                                    <label class="fw-600">{{ translate('State') }}</label>
                                                                    <select class="form-select rounded-0"
                                                                        data-live-search="true" name="state_id"
                                                                        required></select>
                                                                </div>

                                                                <!-- City -->
                                                                <div class="form-group">
                                                                    <label class="fw-600">{{ translate('City') }}</label>
                                                                    <select class="form-select rounded-0"
                                                                        data-live-search="true" name="city_id"
                                                                        required></select>
                                                                </div>

                                                                <!-- Postal Code -->
                                                                <div class="form-group">
                                                                    <label
                                                                        class="fw-600">{{ translate('Postal code') }}</label>
                                                                    <input type="text" class="form-control rounded-0"
                                                                        name="postal_code" required
                                                                        placeholder="{{ translate('Your Postal Code') }}">
                                                                </div>

                                                                <!-- Save button -->
                                                                <div class="form-group text-right mt-4">
                                                                    <button type="button" onclick="hideModal()"
                                                                        data-dismiss="modal"
                                                                        class="btn btn-primary w-150px rounded-0">{{ translate('Save') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Recaptcha -->
                                                @if (get_setting('google_recaptcha') == 1)
                                                    <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="invalid-feedback" role="alert"
                                                            style="display: block;">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                @endif

                                                <!-- Terms and Conditions -->
                                                <div class="mb-3">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" name="checkbox_example_1" required>
                                                        <span
                                                            class="">{{ translate('By signing up you agree to our ') }}
                                                            <a href="{{ route('terms') }}"
                                                                class="fw-500">{{ translate('terms and conditions.') }}</a></span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-4 mt-4">
                                                    <button type="submit" onclick="checkAddress()"
                                                        class="btn btn-primary btn-block fw-600 rounded-0">{{ translate('Create Account') }}</button>
                                                </div>
                                            </form>
                                            <!-- Social Login -->
                                            @if (get_setting('google_login') == 1 ||
                                                    get_setting('facebook_login') == 1 ||
                                                    get_setting('twitter_login') == 1 ||
                                                    get_setting('apple_login') == 1)
                                                <div class="text-center mb-3">
                                                    <span
                                                        class="bg-white fs-12 text-gray">{{ translate('Or Join With') }}</span>
                                                </div>
                                                <ul class="list-inline social colored text-center mb-4">
                                                    @if (get_setting('facebook_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                                                class="facebook">
                                                                <i class="lab la-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('google_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                                                class="google">
                                                                <i class="lab la-google"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('twitter_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                                                class="twitter">
                                                                <i class="lab la-twitter"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('apple_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                                class="apple">
                                                                <i class="lab la-apple"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>


                                        <!-- Log In -->
                                        <p class="fs-12 text-gray mb-0">
                                            {{ translate('Already have an account?') }}
                                            <a href="{{ route('user.login') }}"
                                                class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('Log In') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Go Back -->
                            <div class="d-flex justify-content-center text-center">
                                <div class="mt-3 mr-4 mr-md-0">
                                    <a href="{{ url()->previous() }}"
                                        class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary"
                                        style="max-width: fit-content;">
                                        <i class="las la-arrow-left fs-20 mr-1"></i>
                                        {{ translate('Back to Previous Page') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">

        function checkAddress()
        {
            $address = $('#address').val();
            if($address==null || $address=='')
            toastr.error('{{ translate('Please Add Address') }}');
                
        }
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }
        @if (get_setting('google_recaptcha') == 1)
            // making the CAPTCHA  a required field for form submission
            $(document).ready(function() {
                $("#reg-form").on("submit", function(evt) {
                    var response = grecaptcha.getResponse();
                    if (response.length == 0) {
                        //reCaptcha not verified
                        alert("please verify you are human!");
                        evt.preventDefault();
                        return false;
                    }
                    //captcha verified
                    //do the rest of your validations here
                    $("#reg-form").submit();
                });
            });
        @endif

        function hideModal() {
            toastr.success('{{ translate('Address Added') }}');
            $("#new-address-modal").modal('hide');
        }
    </script>
    <script>
        function toggleCompanyFields() {
            const isCompany = document.getElementById('is_company_checkbox').checked;
            const companyFields = document.getElementById('company_fields');
            companyFields.style.display = isCompany ? 'block' : 'none';
        }
    </script>


    @include('frontend.partials.address.address_js')
@endsection
