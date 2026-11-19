@extends('app.document')

@section('title', 'دیارابزار | فروشگاه ابزار آلات ساختمانی')

@section('content')

    @session('clearStorage')
        <script>
            localStorage.clear();
        </script>
    @endsession

    <main class="diar-home w-full flex flex-col gap-10 justify-start items-center my-3 lg:my-5">

        {{-- ========================= HERO ========================= --}}
        <section
            class="diar-hero max-w-[1800px] w-full mx-auto xl:h-90 lg:h-80 bg-[url('{{ asset('storage/' . $setting['heroBanner']) }}')] bg-cover bg-no-repeat bg-center flex max-lg:flex-col xl:gap-20 lg:gap-15 gap-5 justify-start items-center max-lg:pb-5 relative">

            <div class="lg:w-1/2 w-full h-full flex justify-center items-center">
                <img src="{{ asset('storage/' . $setting['heroBanner']) }}" alt=""
                    class="w-full lg:h-full max-h-full hidden">
            </div>

            <div class="lg:w-1/2 w-full h-full flex lg:justify-start justify-end pl-5 lg:pl-0 items-center">
                <div class="xl:w-9/12 lg:w-10/12 w-11/12 h-full flex flex-col gap-5 justify-center lg:items-start items-end">

                    <div
                        class="flex flex-col gap-2 justify-start items-end max-lg:items-center text-lg xl:text-4xl lg:text-4xl font-bold text-center lg:text-start">
                        <h1 class="text-white">
                            {{ $setting['heroTitle'] }}
                        </h1>
                    </div>

                    <p class="max-xl:text-sm w-2/3 lg:w-full max-lg:text-center text-[#E5E7EB]">
                        {{ $setting['heroSubtitle'] }}
                    </p>

                    <div class="w-full flex lg:gap-6 gap-3 justify-between items-center">
                        <a href="{{ $setting['heroPrimaryButtonLink'] }}"
                            class="diar-hero-primary w-1/2 lg:py-4 py-3 xl:text-lg max-lg:text-sm font-bold rounded-xl flex justify-center items-center">
                            {{ $setting['heroPrimaryButton'] }}
                        </a>

                        <a href="{{ $setting['heroSecondaryButtonLink'] }}"
                            class="diar-hero-secondary w-1/2 lg:py-3 py-2 rounded-xl xl:text-lg max-lg:text-sm font-bold flex justify-center items-center">
                            {{ $setting['heroSecondaryButton'] }}
                        </a>
                    </div>

                </div>
            </div>
        </section>


        {{-- ========================= PACKS ========================= --}}
        @if (count($packs) > 0)
            <section class="max-w-[1800px] w-11/12 mx-auto diar-section">

                <div class="w-full mx-auto flex flex-col items-center">

                    <div class="w-full flex flex-col items-center">
                        <div class="w-full flex gap-2 items-center">
                            <div class="w-[50px] h-1 bg-(--primary-text-color) rounded-full"></div>
                            <span class="text-sm lg:text-lg text-(--secondary-text-color)">
                                {{ $setting['packSubtitle'] }}
                            </span>
                        </div>

                        <div class="w-full flex flex-row justify-between items-center">
                            <span class="lg:text-[30px] text-xl text-(--primary-text-color) font-bold">
                                {{ $setting['packTitle'] }}
                            </span>

                            <a href="{{ route('pack.index') }}" class="diar-section-link text-sm">
                                مشاهده همه
                            </a>
                        </div>
                    </div>

                    <div class="w-full grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 lg:gap-6 mt-5">

                        @foreach ($packs as $pack)
                            <div class="diar-pack-card relative overflow-hidden rounded-2xl">

                                <div class="relative h-[180px] lg:h-[250px] w-full">
                                    <img src="{{ asset('storage/' . $pack->image) }}" class="h-full w-full object-cover"
                                        alt="">

                                    <div class="absolute inset-y-0 right-0 w-[45%] diar-pack-shape">
                                        <div class="absolute -left-3 -top-8 h-28 w-28 rounded-full diar-pack-shape"></div>
                                        <div
                                            class="absolute -left-5 lg:-left-8 top-4 h-28 w-28 rounded-full diar-pack-shape">
                                        </div>
                                        <div
                                            class="absolute -left-2 lg:-left-8 top-1/2 h-40 w-40 -translate-y-1/2 rounded-full diar-pack-shape">
                                        </div>
                                        <div class="absolute -left-5 bottom-2 h-28 w-28 rounded-full diar-pack-shape"></div>
                                        <div class="absolute -left-3 -bottom-8 h-28 w-28 rounded-full diar-pack-shape">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute right-0 top-0 flex h-full w-[45%] items-center justify-center px-3 py-4 lg:py-8">
                                    <div class="text-right flex flex-col gap-3 relative z-10">

                                        <h3 class="text-lg lg:text-2xl font-bold diar-pack-title">
                                            {{ $pack->title }}
                                        </h3>

                                        <p class="text-sm leading-7 diar-pack-summary">
                                            {{ $pack->summary }}
                                        </p>

                                        <div class="flex">
                                            <a href="{{ route('pack.single', $pack->id) }}"
                                                class="diar-pack-button mt-3 rounded-full px-6 py-2 text-white text-sm lg:text-base">
                                                مشاهده
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif


        {{-- ========================= POPULAR PRODUCTS ========================= --}}
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start diar-section">

            <div class="w-full flex flex-row gap-1 justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">
                    محبوب ترین های این روز ها
                </h3>

                <a href="#" class="diar-section-link text-sm">
                    مشاهده همه
                </a>
            </div>

            <div
                class="max-w-full w-full py-2 px-1 grid grid-cols-2 lg:grid-cols-5 gap-4 justify-start overflow-x-auto lg:overflow-x-visible">

                @foreach ($products as $product)
                    <div class="diar-product-card w-full flex flex-col gap-2 justify-start items-center rounded-xl p-3 products"
                        data-product-id="{{ $product->id }}">

                        <div class="diar-product-image w-full flex justify-center items-center relative py-7">
                            <a href="{{ route('product.show', [$product->id]) }}" class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="max-w-full max-h-24 lg:max-h-42 object-contain">
                            </a>

                            @if ($product->percent)
                                <span
                                    class="diar-discount absolute top-0 right-0 lg:px-2 px-1 lg:py-1 py-0.5 rounded-md text-xs max-lg:text-[9px] text-white">
                                    {{ $product->percent }}%
                                </span>
                            @endif
                        </div>

                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">

                            <a href="{{ route('product.show', [$product->id]) }}"
                                class="diar-product-title lg:text-lg text-sm font-bold max-w-full truncate">
                                {{ $product->title }}
                            </a>
                            @if ($product->summary)
                                <span class="diar-product-summary text-sm h-10 max-h-10 ellipsis-2">
                                    {{ $product->summary }}
                                </span>
                            @endif
                            @if ($product->primary_price || $product->secondary_price)
                                <div class="flex items-center gap-3 min-h-7">
                                    @if ($product->secondary_price)
                                        <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                            {{ $product->primary_price }} تومان
                                        </div>

                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->secondary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->primary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="text-sm text-gray-400">جهت استعلام قیمت تماس بگیرید</div>
                            @endif


                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">

                                @if ($product->count > 0)
                                    <button onclick="addToCart(this)"
                                        class="diar-cart-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 group">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                            class="lg:size-4 size-3 fill-current transition-all duration-300">
                                            <path
                                                d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 0 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 0 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 0 1-48 0zm80 0a56 56 0 1 0-112 0 56 56 0 0 0 112 0z" />
                                        </svg>

                                        <span class="lg:text-sm text-[10px] font-bold transition-all duration-300">
                                            افزودن به سبد خرید
                                        </span>
                                    </button>
                                @else
                                    <button
                                        class="diar-unavailable-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl relative cursor-not-allowed">
                                        <span class="lg:text-sm text-[10px] font-bold">
                                            عدم موجودی
                                        </span>
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        {{-- ========================= SECOND BANNER ========================= --}}
        <section
            class="diar-feature-banner max-w-[1800px] w-11/12 mx-auto flex max-lg:flex-col justify-start items-center rounded-2xl overflow-hidden">

            <div class="lg:w-1/2 w-full flex justify-center items-center relative">
                <img src="{{ asset('storage/' . $setting['secondBanner']) }}" alt=""
                    class="w-full h-full object-cover lg:max-h-90 max-h-70">
            </div>

            <div
                class="lg:w-1/2 w-full min-h-full flex lg:justify-start justify-center items-center lg:pr-20 lg:py-4 max-lg:px-5 max-lg:pt-7 max-lg:pb-8">
                <div class="w-full h-full flex flex-col gap-4 justify-center lg:items-start items-center">

                    <span class="diar-feature-label">
                        انتخاب حرفه‌ای برای حرفه‌ای‌ها
                    </span>

                    <h3 class="lg:text-4xl text-2xl font-bold diar-feature-title">
                        {{ $setting['secondBannerTitle'] }}
                    </h3>

                    <p class="max-xl:text-sm max-lg:text-xs max-lg:text-center diar-feature-description">
                        {{ $setting['secondBannerSubtitle'] }}
                    </p>

                    <a href="{{ $setting['secondBannerButtonLink'] }}"
                        class="diar-feature-button px-7 lg:py-3 py-2 text-sm font-bold rounded-xl flex justify-center items-center mt-2">
                        {{ $setting['secondBannerButton'] }}
                    </a>

                </div>
            </div>
        </section>


        {{-- ========================= NEW PRODUCTS ========================= --}}
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start diar-section">

            <div class="w-full flex flex-row justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">
                    تازه به قفسه ها اضافه شده
                </h3>

                <a href="#" class="diar-section-link text-sm">
                    مشاهده همه
                </a>
            </div>

            <div
                class="max-w-full w-full py-2 px-1 grid grid-cols-2 lg:grid-cols-5 gap-4 justify-start overflow-x-auto lg:overflow-x-visible">

                @foreach ($newProducts as $product)
                    <div class="diar-product-card w-full flex flex-col gap-2 justify-start items-center rounded-xl p-3 pb-5 products"
                        data-product-id="{{ $product->id }}">

                        <div class="diar-product-image w-full flex justify-center items-center relative py-7">
                            <a href="{{ route('product.show', [$product->id]) }}" class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="max-w-full max-h-24 lg:max-h-42 object-contain">
                            </a>

                            @if ($product->percent)
                                <span
                                    class="diar-discount absolute top-0 right-0 lg:px-2 px-1 lg:py-1 py-0.5 rounded-md text-xs max-lg:text-[9px] text-white">
                                    {{ $product->percent }}%
                                </span>
                            @endif
                        </div>

                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">

                            <a href="{{ route('product.show', [$product->id]) }}"
                                class="diar-product-title lg:text-lg text-sm font-bold max-w-full truncate">
                                {{ $product->title }}
                            </a>
                            @if ($product->summary)
                                <span class="diar-product-summary text-sm h-10 max-h-10 ellipsis-2">
                                    {{ $product->summary }}
                                </span>
                            @endif

                            @if ($product->primary_price || $product->secondary_price)
                                <div class="flex items-center gap-3 min-h-7">


                                    @if ($product->secondary_price)
                                        <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                            {{ $product->primary_price }} تومان
                                        </div>

                                        <div class="fle$product->secondary_pricex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->secondary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->primary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @endif

                                </div>
                            @else
                                <div class="text-sm text-gray-400">جهت استعلام قیمت تماس بگیرید</div>
                            @endif

                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">

                                @if ($product->count > 0)
                                    <button onclick="addToCart(this)"
                                        class="diar-cart-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 group">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                            class="lg:size-4 size-3 fill-current transition-all duration-300">
                                            <path
                                                d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 0 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 0 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 0 1-48 0zm80 0a56 56 0 1 0-112 0 56 56 0 0 0 112 0z" />
                                        </svg>

                                        <span class="lg:text-sm text-[10px] font-bold transition-all duration-300">
                                            افزودن به سبد خرید
                                        </span>
                                    </button>
                                @else
                                    <button
                                        class="diar-unavailable-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl relative cursor-not-allowed">
                                        <span class="lg:text-sm text-[10px] font-bold">
                                            عدم موجودی
                                        </span>
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        {{-- ========================= SIDE BANNERS ========================= --}}
        <section class="w-full flex justify-center">
            <div class="max-w-[1800px] w-11/12 mx-auto lg:h-60 flex max-lg:flex-col justify-between gap-4">

                <a href="{{ $setting['rightBannerLink'] }}"
                    class="diar-side-banner lg:w-5/12 w-full rounded-2xl h-full flex justify-center items-center overflow-hidden">
                    <img class="w-full h-full rounded-xl object-cover"
                        src="{{ asset('storage/' . $setting['rightBanner']) }}" alt="">
                </a>

                <div
                    class="diar-side-content lg:w-7/12 w-full h-full relative flex max-lg:flex-col items-center gap-3 rounded-xl overflow-hidden">

                    <img class="h-full w-full lg:w-1/2 rounded-r-xl object-cover max-h-full"
                        src="{{ asset('storage/' . $setting['leftBanner']) }}" alt="">

                    <div class="lg:w-1/2 w-full flex flex-col gap-3 lg:items-start items-center p-5">

                        <span class="lg:text-xl text-md font-bold text-(--primary-text-color)">
                            {{ $setting['leftBannerTitle'] }}
                        </span>

                        <span class="lg:text-md text-xs text-(--secondary-text-color)">
                            {{ $setting['leftBannerSubtitle'] }}
                        </span>

                        <a href="{{ $setting['leftBannerButtonLink'] }}"
                            class="diar-side-button w-1/2 rounded-xl flex items-center justify-center gap-2 mt-3 p-2">

                            <span class="lg:text-md text-xs">
                                {{ $setting['leftBannerButton'] }}
                            </span>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="lg:size-5 size-3 fill-current">
                                <path
                                    d="M7.4 273.4C2.7 268.8 0 262.6 0 256s2.7-12.8 7.4-17.4l176-168c9.6-9.2 24.8-8.8 33.9 .8s8.8 24.8-.8 33.9L83.9 232 424 232c13.3 0 24 10.7 24 24s-10.7 24-24 24L83.9 280 216.6 406.6c9.2 9.2 9.9 24.3 .8 33.9s-24.3 9.9-33.9 .8l-176-168z" />
                            </svg>

                        </a>
                    </div>
                </div>
            </div>
        </section>


        {{-- ========================= TWO PROMO CARDS ========================= --}}
        <section class="w-full flex justify-center gap-5">
            <div class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-5">

                <div class="w-full flex justify-between items-center">
                    <span class="lg:text-2xl text-xl font-bold text-(--primary-text-color)">
                        {{ $setting['twoCardsSectionTitle'] }}
                    </span>

                    <a href="{{ $setting['twoCardsSectionLinkUrl'] }}" class="diar-section-link text-sm">
                        {{ $setting['twoCardsSectionLinkText'] }}
                    </a>
                </div>

                <div class="flex items-center flex-col lg:flex-row gap-5">

                    <div
                        class="diar-promo-card lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between py-5 px-7 rounded-xl">

                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">

                            <span class="text-xl max-lg:text-lg font-bold text-(--primary-text-color)">
                                {{ $setting['twoCardsRightTitle'] }}
                            </span>

                            <span class="max-lg:text-sm text-(--secondary-text-color) max-lg:text-center">
                                {{ $setting['twoCardsRightSubtitle'] }}
                            </span>

                            <a href="{{ $setting['twoCardsRightButtonLink'] }}"
                                class="diar-outline-button flex justify-center items-center w-9/12 py-2 rounded-xl">
                                <span>
                                    {{ $setting['twoCardsRightButton'] }}
                                </span>
                            </a>
                        </div>

                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1 object-contain"
                            src="{{ asset('storage/' . $setting['twoCardsRightImage']) }}" alt="">
                    </div>


                    <div
                        class="diar-promo-card diar-promo-card-alt lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between p-5 px-7 rounded-xl">

                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">

                            <span class="text-2xl font-bold text-(--primary-text-color)">
                                {{ $setting['twoCardsLeftTitle'] }}
                            </span>

                            <span class="max-lg:text-sm max-lg:text-center text-(--secondary-text-color)">
                                {{ $setting['twoCardsLeftSubtitle'] }}
                            </span>

                            <a href="{{ $setting['twoCardsLeftButtonLink'] }}"
                                class="diar-outline-button flex justify-center items-center w-9/12 py-2 rounded-xl">
                                <span>
                                    {{ $setting['twoCardsLeftButton'] }}
                                </span>
                            </a>
                        </div>

                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1 object-contain"
                            src="{{ asset('storage/' . $setting['twoCardsLeftImage']) }}" alt="">
                    </div>

                </div>
            </div>
        </section>


        {{-- ========================= SERVICES ========================= --}}
        <section
            class="diar-services max-w-[1800px] w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center lg:py-6 sm:py-4 rounded-xl">

            @for ($i = 1; $i <= 5; $i++)
                <div class="w-full flex items-center justify-center px-3 py-4">
                    <div class="group w-full flex flex-col gap-3 justify-center items-center">

                        <div class="diar-service-icon">
                            <img src="{{ asset('storage/' . $setting['serviceImage' . $i]) }}"
                                class="lg:w-8 w-6 object-contain" alt="">
                        </div>

                        <div class="flex flex-col sm:gap-2 gap-1 items-center justify-center">
                            <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color) text-center">
                                {{ $setting['serviceTitle' . $i] }}
                            </h5>

                            <div
                                class="flex flex-col items-center justify-center xl:text-[11px] sm:text-[10px] text-[11px]">
                                <span class="font-bold text-center text-(--secondary-text-color)">
                                    {{ $setting['serviceSubTitle' . $i] }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endfor

        </section>


        {{-- ========================= PAGE STYLES ========================= --}}
        <style>
            .diar-home {
                --primary-text-color: #07145c;
                --secondary-text-color: #64748b;
                --secondary-text: #64748b;

                --green-btn: #07145c;
                --light-green-btn: #e8edff;
                --bg-dark-green: #07145c;

                --cream-color: #f3f5fa;
                --second-cream-color: #edf1f8;

                --purple-btn: #0877d1;
                --pastel-pink: #e50914;
                --discount-color: #e50914;

                --diar-navy: #07145c;
                --diar-red: #e50914;
                --diar-blue: #0877d1;
                --diar-light: #f3f5fa;

                color: #172554;
                direction: rtl;
            }

            .diar-home * {
                box-sizing: border-box;
            }

            /* General links */
            .diar-home .diar-section-link {
                color: #64748b;
                transition: color .2s ease;
            }

            .diar-home .diar-section-link:hover {
                color: #0877d1;
            }

            /* Hero */
            .diar-home .diar-hero {
                min-height: 320px;
                border-radius: 20px;
                overflow: hidden;
                isolation: isolate;
                background-color: #07145c;
            }

            .diar-home .diar-hero::before {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg,
                        rgba(7, 20, 92, .45) 0%,
                        rgba(7, 20, 92, .82) 100%);
                z-index: -1;
            }

            .diar-home .diar-hero-primary,
            .diar-home .diar-hero-secondary {
                min-height: 48px;
                color: #fff !important;
                transition: all .25s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, .12);
            }

            .diar-home .diar-hero-primary {
                background: #e50914 !important;
            }

            .diar-home .diar-hero-primary:hover {
                background: #c40710 !important;
                transform: translateY(-2px);
            }

            .diar-home .diar-hero-secondary {
                background: #07145c !important;
                border: 1px solid rgba(255, 255, 255, .35);
            }

            .diar-home .diar-hero-secondary:hover {
                background: #0877d1 !important;
                transform: translateY(-2px);
            }

            /* Packs */
            .diar-home .diar-pack-card {
                background: #f3f5fa;
                border: 1px solid #e2e8f0;
                box-shadow: 0 5px 18px rgba(7, 20, 92, .05);
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .diar-home .diar-pack-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 28px rgba(7, 20, 92, .11);
            }

            .diar-home .diar-pack-shape {
                background: #f3f5fa;
            }

            .diar-home .diar-pack-title {
                color: #07145c;
            }

            .diar-home .diar-pack-summary {
                color: #64748b;
            }

            .diar-home .diar-pack-button {
                background: #07145c;
                color: #fff;
                transition: background .2s ease, transform .2s ease;
            }

            .diar-home .diar-pack-button:hover {
                background: #0877d1;
                transform: translateY(-2px);
            }

            /* Product cards */
            .diar-home .diar-product-card {
                min-width: 0;
                min-height: 100%;
                background: #fff;
                border: 1px solid #e5eaf2;
                box-shadow: 0 4px 14px rgba(7, 20, 92, .055);
                transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            }

            .diar-home .diar-product-card:hover {
                transform: translateY(-4px);
                border-color: #cbd5e1;
                box-shadow: 0 12px 28px rgba(7, 20, 92, .11);
            }

            .diar-home .diar-product-image {
                min-height: 155px;
                background: #f8f9fc;
                border-radius: 12px;
            }

            .diar-home .diar-product-image img {
                transition: transform .3s ease;
            }

            .diar-home .diar-product-card:hover .diar-product-image img {
                transform: scale(1.045);
            }

            .diar-home .diar-product-title {
                color: #07145c;
                transition: color .2s ease;
            }

            .diar-home .diar-product-title:hover {
                color: #0877d1;
            }

            .diar-home .diar-product-summary {
                color: #64748b;
                line-height: 1.8;
            }

            .diar-home .diar-product-price {
                color: #07145c;
            }

            .diar-home .diar-discount {
                background: #e50914;
                font-weight: 700;
            }

            /* Add to cart buttons */
            .diar-home .diar-cart-button {
                background: #07145c !important;
                color: #fff !important;
                border: 1px solid #07145c;
                box-shadow: 0 4px 10px rgba(7, 20, 92, .12);
            }

            .diar-home .diar-cart-button svg {
                color: #fff !important;
                fill: currentColor !important;
            }

            .diar-home .diar-cart-button span {
                color: #fff !important;
            }

            .diar-home .diar-cart-button:hover {
                background: #0877d1 !important;
                border-color: #0877d1;
                box-shadow: 0 6px 16px rgba(8, 119, 209, .22);
                transform: translateY(-1px);
            }

            .diar-home .diar-unavailable-button {
                background: #fff1f2 !important;
                border: 1px solid #fecdd3;
                color: #e50914 !important;
            }

            .diar-home .diar-unavailable-button span {
                color: #e50914 !important;
            }

            /* Feature banner */
            .diar-home .diar-feature-banner {
                background: #07145c !important;
                color: #fff;
                box-shadow: 0 12px 30px rgba(7, 20, 92, .12);
            }

            .diar-home .diar-feature-banner>div:first-child {
                align-self: stretch;
            }

            .diar-home .diar-feature-banner>div:first-child img {
                min-height: 280px;
            }

            .diar-home .diar-feature-label {
                display: inline-flex;
                align-items: center;
                width: fit-content;
                padding: 7px 13px;
                border-radius: 999px;
                background: rgba(255, 255, 255, .12);
                color: #bfdbfe;
                font-size: 12px;
                font-weight: 700;
            }

            .diar-home .diar-feature-title {
                color: #fff !important;
                line-height: 1.6;
            }

            .diar-home .diar-feature-description {
                color: #cbd5e1 !important;
                line-height: 2;
            }

            .diar-home .diar-feature-button {
                color: #fff !important;
                background: #e50914 !important;
                transition: all .25s ease;
                box-shadow: 0 5px 15px rgba(229, 9, 20, .2);
            }

            .diar-home .diar-feature-button:hover {
                background: #c40710 !important;
                transform: translateY(-2px);
            }

            /* Side banners */
            .diar-home .diar-side-banner {
                background: #07145c;
                min-height: 180px;
            }

            .diar-home .diar-side-content {
                background: #f3f5fa;
                border: 1px solid #e5eaf2;
            }

            .diar-home .diar-side-button {
                color: #fff !important;
                background: #e50914;
                transition: all .2s ease;
            }

            .diar-home .diar-side-button:hover {
                background: #c40710;
                transform: translateY(-2px);
            }

            /* Promo cards */
            .diar-home .diar-promo-card {
                background: #f3f5fa;
                border: 1px solid #e5eaf2;
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .diar-home .diar-promo-card-alt {
                background: #edf1f8;
            }

            .diar-home .diar-promo-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 24px rgba(7, 20, 92, .08);
            }

            .diar-home .diar-outline-button {
                color: #07145c !important;
                border: 1px solid #cbd5e1;
                background: rgba(255, 255, 255, .65);
                transition: all .2s ease;
            }

            .diar-home .diar-outline-button:hover {
                color: #fff !important;
                background: #07145c;
                border-color: #07145c;
            }

            /* Services */
            .diar-home .diar-services {
                border-top: 1px solid #e5eaf2;
                border-bottom: 1px solid #e5eaf2;
            }

            .diar-home .diar-service-icon {
                width: 54px;
                height: 54px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 16px;
                background: #edf1f8;
                transition: background .2s ease, transform .2s ease;
            }

            .diar-home .diar-services>div:hover .diar-service-icon {
                background: #e8edff;
                transform: translateY(-3px);
            }

            /* Responsive */
            @media (max-width: 1023px) {
                .diar-home .diar-hero {
                    min-height: 360px;
                    border-radius: 16px;
                }

                .diar-home .diar-product-image {
                    min-height: 125px;
                }

                .diar-home .diar-feature-banner>div:first-child img {
                    min-height: 220px;
                    max-height: 260px;
                }

                .diar-home .diar-pack-card {
                    min-height: 180px;
                }
            }

            @media (max-width: 640px) {
                .diar-home {
                    gap: 2rem;
                }

                .diar-home .diar-hero {
                    min-height: 340px;
                }

                .diar-home .diar-hero::before {
                    background: rgba(7, 20, 92, .72);
                }

                .diar-home .diar-product-card {
                    padding: 9px;
                    border-radius: 13px;
                }

                .diar-home .diar-product-image {
                    min-height: 115px;
                    padding-top: 20px;
                    padding-bottom: 20px;
                }

                .diar-home .diar-cart-button {
                    padding-left: 5px;
                    padding-right: 5px;
                }

                .diar-home .diar-pack-card {
                    min-height: 180px;
                }

                .diar-home .diar-pack-card p {
                    line-height: 1.6;
                    font-size: 11px;
                }

                .diar-home .diar-pack-card h3 {
                    font-size: 16px;
                }
            }

            @media (prefers-reduced-motion: reduce) {

                .diar-home *,
                .diar-home *::before,
                .diar-home *::after {
                    transition-duration: .01ms !important;
                    animation-duration: .01ms !important;
                }
            }
        </style>

    </main>

@endsection
