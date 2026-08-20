@extends('frontend.layouts.app')

@section('content')
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <!-- كارت الفورم -->
                        <div class="p-4 p-md-5 bg-white shadow rounded border">

                            <!-- اللوجو في النص -->
                            <div class="text-center mb-4">
                                <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="Logo" style="height: 50px;">
                            </div>

                            <!-- عنوان التسجيل -->
                            <h2 class="text-center text-primary fw-bold mb-4">{{ translate('Register your shop') }}</h2>

                            <!-- Start Form -->
                            <form id="reg-form" action="{{ route('shops.store') }}" method="POST" class="form-default">
                                @csrf

                                <!-- معلومات شخصية -->
                                <div class="fs-15 fw-600 pb-2">{{ translate('Personal Info') }}</div>
                                <div class="row g-3">

                                    <!-- الاسم -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Your Name') }}</label>
                                        <input type="text" name="name"
                                            class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            required placeholder="{{ translate('Full Name') }}" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- البريد الإلكتروني -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Your Email') }}</label>
                                        <input type="email" name="email"
                                            class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            required placeholder="{{ translate('Email') }}"
                                            value="{{ $email ?? old('email') }}" {{ $email ? 'readonly' : '' }}>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- الهاتف -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Your Phone') }}</label>
                                        <input type="text" name="phone"
                                            class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            required placeholder="{{ translate('Phone') }}"
                                            value="{{ $phone ?? old('phone') }}" {{ $phone ? 'readonly' : '' }}>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- كلمة المرور -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Password') }}</label>
                                        <div class="position-relative">
                                            <input type="password" name="password"
                                                class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                required placeholder="{{ translate('Password') }}">
                                            <i
                                                class="password-toggle las la-eye la-2x position-absolute top-50 translate-middle-y pe-3"></i>
                                        </div>
                                        <small
                                            class="text-muted d-block mt-1">{{ translate('Password must contain at least 6 digits') }}</small>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- تأكيد كلمة المرور -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Confirm Password') }}</label>
                                        <div class="position-relative">
                                            <input type="password" name="password_confirmation"
                                                class="form-control rounded-0" required
                                                placeholder="{{ translate('Confirm Password') }}">
                                            <i
                                                class="password-toggle las la-eye la-2x position-absolute top-50 translate-middle-y pe-3"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- معلومات المتجر -->
                                <div class="fs-15 fw-600 pt-4 pb-2">{{ translate('Basic Info') }}</div>
                                <div class="row g-3">

                                    <!-- اسم المتجر -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Shop Name') }}</label>
                                        <input type="text" name="shop_name"
                                            class="form-control rounded-0{{ $errors->has('shop_name') ? ' is-invalid' : '' }}"
                                            required placeholder="{{ translate('Shop Name') }}"
                                            value="{{ old('shop_name') }}">
                                        @error('shop_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- عنوان المتجر -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Address') }}</label>
                                        <input type="text" name="address"
                                            class="form-control rounded-0{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            required placeholder="{{ translate('Address') }}"
                                            value="{{ old('address') }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- الرقم الضريبي -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Tax Number') }}</label>
                                        <input type="text" name="tax_number" class="form-control rounded-0"
                                            placeholder="{{ translate('Optional') }}">
                                    </div>

                                    <!-- السجل التجاري -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-600">{{ translate('Commercial Register') }}</label>
                                        <input type="text" name="commercial_register" class="form-control rounded-0"
                                            placeholder="{{ translate('Optional') }}">
                                    </div>
                                </div>

                                <!-- Recaptcha -->
                                @if (get_setting('google_recaptcha') == 1)
                                    <div class="my-3">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                        @error('g-recaptcha-response')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endif

                                <!-- زر التسجيل -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100 fw-bold fs-6">
                                        {{ translate('Register Your Shop') }}
                                    </button>
                                </div>

                                <!-- رابط تسجيل الدخول -->
                                <p class="text-center mt-3 mb-0 fs-14">
                                    {{ translate('Already have an account?') }}
                                    <a href="{{ route('seller.login') }}" class="text-decoration-underline text-primary">
                                        {{ translate('Log In') }}
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    @include('auth.login_register_js')
@endsection

@section('script')
    @if (get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
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
    </script>
@endsection
