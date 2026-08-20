@extends('frontend.layouts.app')

@section('content')
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
                <div class="row w-100">
                    <div class="col-xxl-6 col-xl-9 col-lg-10 col-md-8 mx-auto py-lg-4">
                        <div class="card shadow-sm border-0 rounded-3 px-3 py-4">

                            <!-- أيقونة المتجر + عنوان -->
                            <div class="text-center mb-4">
                                <i class="fas fa-store login-icon fs-1 mb-2" style="color: #ae2025;" ></i>
                                <h4 class="fw-700">{{ translate('register as a seller') }}</h4>
                            </div>

                            <!-- فورم تسجيل الدخول -->
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <form class="form-default" action="{{ route('login') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label class="fs-12 fw-700 text-soft-dark"
                                                for="email">{{ translate('Email') }}</label>
                                            <input type="email"
                                                class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" placeholder="{{ translate('johndoe@example.com') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback d-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="fs-12 fw-700 text-soft-dark"
                                                for="password">{{ translate('Password') }}</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control rounded-0 {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" placeholder="{{ translate('Password') }}">
                                                <i class="password-toggle las la-eye la-2x position-absolute top-50  translate-middle-y me-3 text-muted"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="aiz-checkbox mb-0">
                                                    <input type="checkbox" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="fs-12 text-gray-dark">{{ translate('Remember Me') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a href="{{ route('password.request') }}" class="fs-12">
                                                    <u>{{ translate('Forgot password?') }}</u>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="submit"
                                                class="btn btn-primary btn-block rounded-0 fw-700 fs-14" style="background-color: #ae2025">{{ translate('Login') }}</button>
                                        </div>
                                    </form>

                                    <p class="fs-12 text-gray text-center mb-0">
                                        {{ translate("Don't have a Seller account") }}
                                        <a href="{{ route('shop-reg.verification') }}"
                                            class="fs-14 fw-700 text-primary ms-2">{{ translate('Register Now Seller') }}</a>
                                    </p>

                                    <div class="text-center mt-3">
                                        <a href="{{ url()->previous() }}"
                                            class="fs-14 fw-700 text-primary d-inline-flex align-items-center">
                                            <i class="las la-arrow-left fs-20 me-1"></i>
                                            {{ translate('Back to Previous Page') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>

        </section>
    </div>
    @include('auth.login_register_js')
@endsection

@section('script')
    <script type="text/javascript">
        function autoFillSeller() {
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
