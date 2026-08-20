@extends('frontend.layouts.app')

@section('content')
    @php $isOtpSystemActivated = addon_is_activated('otp_system'); @endphp
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-xl-8 col-lg-9 col-md-10">
                        <!-- الصندوق بكامله -->
                        <div class="bg-white border rounded shadow p-4 p-lg-5">

                            <!-- اللوجو في المنتصف -->
                            <div class="text-center mb-4">
                                <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon') }}"
                                    style="height: 50px;">
                            </div>

                            <!-- العنوان -->
                            <h2 class="text-center text-primary fw-bold mb-4" style="text-transform: uppercase;">
                                {{ !$isOtpSystemActivated ? translate('Verify Your Email') : translate('Verify Your Email/Phone') }}
                            </h2>

                            <!-- الفورم -->
                            <form id="reg-form" class="form-default" role="form"
                                action="{{ route('shop-reg.verification_code_send') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}">

                                @if (addon_is_activated('otp_system'))
                                    <!-- الهاتف -->
                                    <div class="form-group mb-3">
                                        <label for="phone"
                                            class="fs-14 fw-600 text-soft-dark">{{ translate('Phone') }}</label>
                                        <input type="tel" id="phone-code" name="phone"
                                            class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('phone') }}" autocomplete="off">
                                    </div>

                                    <input type="hidden" name="country_code" value="">

                                    <!-- البريد الإلكتروني (مخفي افتراضياً) -->
                                    <div class="form-group mb-3 d-none email-form-group">
                                        <label for="email"
                                            class="fs-14 fw-600 text-soft-dark">{{ translate('Email') }}</label>
                                        <input type="email" name="email"
                                            class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ old('email') }}" autocomplete="off">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- تبديل البريد والهاتف -->
                                    <div class="text-end mb-3">
                                        <button type="button" class="btn btn-link p-0 fs-13 text-primary"
                                            onclick="toggleEmailPhone(this)">
                                            * {{ translate('Use Email Instead') }}
                                        </button>
                                    </div>
                                @else
                                    <!-- فقط البريد -->
                                    <div class="form-group mb-3">
                                        <label for="email"
                                            class="fs-14 fw-600 text-soft-dark">{{ translate('Email') }}</label>
                                        <input type="email" name="email"
                                            class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <!-- زر التحقق -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100 fw-600 rounded-0">
                                        {{ translate('Verify') }}
                                    </button>
                                </div>
                            </form>

                            <!-- رابط الدخول -->
                            <p class="text-center fs-13 text-muted mt-4 mb-0">
                                {{ translate('Already have an account?') }}
                                <a href="{{ route('seller.login') }}"
                                    class="fw-700 text-primary ms-2 text-decoration-underline">
                                    {{ translate('Log In') }}
                                </a>
                            </p>
                        </div>

                        <!-- زر الرجوع -->
                        <div class="text-end mt-3">
                            <a href="{{ url()->previous() }}"
                                class="fs-14 fw-700 text-primary d-inline-flex align-items-center">
                                <i class="las la-arrow-left fs-20 ms-1"></i>
                                {{ translate('Back to Previous Page') }}
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>

        </section>
    </div>
    @include('auth.login_register_js')

@endsection

