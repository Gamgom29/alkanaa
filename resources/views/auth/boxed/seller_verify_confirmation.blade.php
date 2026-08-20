@extends('frontend.layouts.app')

@section('content')
    @php $isOtpSystemActivated = addon_is_activated('otp_system'); @endphp
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-xl-8 col-lg-9 col-md-10">
                        <!-- Wrapper with border & shadow -->
                        <div class="bg-white border rounded shadow p-4 p-lg-5">

                            <!-- Logo in center -->
                            <div class="text-center mb-3">
                                <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon') }}"
                                    style="height: 50px;">
                            </div>

                            <!-- Title -->
                            <h2 class="text-center text-primary fw-bold mb-4" style="text-transform: uppercase;">
                                {{ !$isOtpSystemActivated ? translate('Verify Your Email') : translate('Verify Your Email/Phone') }}
                            </h2>

                            <!-- Form -->
                            <form id="reg-form" class="form-default" role="form"
                                action="{{ route('shop-reg.verify_code_confirmation') }}" method="POST">
                                @csrf
                                <input type="hidden" name="seller_verification_id" value="{{ $sellerVerification->id }}">

                                @if ($sellerVerification->email != null)
                                    <div class="form-group mb-3">
                                        <label class="fs-14 fw-600 text-soft-dark">{{ translate('Email') }}</label>
                                        <input type="text" name="email" class="form-control rounded-0"
                                            value="{{ $sellerVerification->email }}" readonly>
                                    </div>
                                @else
                                    <div class="form-group mb-3">
                                        <label class="fs-14 fw-600 text-soft-dark">{{ translate('Phone') }}</label>
                                        <input type="text" name="phone" class="form-control rounded-0"
                                            value="{{ $sellerVerification->phone }}" readonly>
                                    </div>
                                @endif

                                <div class="form-group mb-4">
                                    <label class="fs-14 fw-600 text-soft-dark">{{ translate('Verification Code') }}</label>
                                    <input type="number" name="verification_code" class="form-control rounded-0">
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary w-100 fw-600 rounded-0 mb-3">
                                    {{ translate('Submit') }}
                                </button>

                                <!-- Login link -->
                                <p class="text-center fs-13 text-muted mb-0">
                                    {{ translate('Already have an account?') }}
                                    <a href="{{ route('seller.login') }}"
                                        class="fw-700 text-primary ms-2 text-decoration-underline">
                                        {{ translate('Log In') }}
                                    </a>
                                </p>
                            </form>
                        </div>

                        <!-- Go back -->
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
