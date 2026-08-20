@extends('frontend.layouts.app')

@section('content')
    <section class="logos py-5">
        <div class="container">
            <h2 class="section-title text-center mb-4">{{ translate('partners') }}</h2>
            <div class="logos-grid">
                @foreach ($all_partners as $partner)
                    <div class="logo-item"><img
                            src="{{ $partner->logo ? uploaded_asset($partner->logo) : static_asset('assets/img/placeholder.jpg') }}"
                            alt="logo"></div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .logos {
            background: #f9f9f9;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .logos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 25px;
            align-items: center;
            justify-items: center;
        }

        .logo-item {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .logo-item img {
            max-width: 100%;
            max-height: 70px;
            object-fit: contain;
            filter: grayscale(100%);
            transition: filter 0.3s ease, transform 0.3s ease;
        }

        .logo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo-item:hover img {
            filter: grayscale(0%);
            transform: scale(1.05);
        }
    </style>
@endsection
