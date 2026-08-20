@extends('frontend.layouts.app')

@section('style')
    <style>
        .thank-you-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .thank-you-icon {
            font-size: 64px;
            color: #28a745;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            color: #555;
        }
    </style>
@endsection
@section('content')
    @if (app()->getLocale() == 'sa')
        <div class="container" style=" margin-top: 5%; margin-bottom: 5%; width: 100%;">
            <div class="row justify-content-center">
                <div class="thank-you-box">
                    <div class="thank-you-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1>شكراً لك!</h1>
                    <p>تم إرسال طلب عرض السعر إلى البريد الإلكتروني المسجل لدينا.</p>
                </div>
            </div>
        </div>
    @elseif(app()->getLocale() == 'cn')
        <div class="container" style=" margin-top: 5%; margin-bottom: 5%; width: 100%;">
            <div class="row justify-content-center">
                <div class="thank-you-box">
                    <div class="thank-you-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1>谢谢您！</h1>
                    <p>报价请求已发送至您在我们系统中注册的电子邮箱。</p>
                </div>
            </div>
        </div>
    @else
        <div class="container" style=" margin-top: 5%; margin-bottom: 5%; width: 100%;">
            <div class="row justify-content-center">
                <div class="thank-you-box">
                    <div class="thank-you-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1>Thank You!</h1>
                    <p>The quotation request has been sent to the email registered with us.</p>
                </div>
            </div>
        </div>
    @endif
@endsection
