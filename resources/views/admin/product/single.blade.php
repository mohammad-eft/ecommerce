@extends('app.document')

@section('title')
    دیارابزار | {{ $product->title }}
@endsection

@section('content')

@php
    $mainMedia = $product->media->firstWhere('is_main', true) ?? $product->media->first();
    $galleryMedia = $product->media->where('id', '!=', $mainMedia?->id);
    $category = $product->categories->first();
    $isInCart = Auth::check() && in_array($product->id, $cartProIds ?? []);
    $cartQuantity = $product->carts->first()?->quantity ?? 1;

    $hasPrice = $product->primary_price !== null && $product->primary_price > 0;
    $hasDiscount = $hasPrice && $product->secondary_price && $product->secondary_price > 0
        && $product->secondary_price < $product->primary_price;

    $discountPercent = $hasDiscount
        ? round((($product->primary_price - $product->secondary_price) / $product->primary_price) * 100)
        : 0;
@endphp

<style>
    .product-page {
        color: #010348;
    }

    .product-shadow {
        box-shadow: 0 8px 30px rgba(1, 3, 72, .055);
    }

    .product-card {
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        background: #fff;
    }

    .product-gallery-main {
        background: linear-gradient(145deg, #F8FAFF 0%, #EAF2FF 100%);
        border: 1px solid #EAF0FA;
        border-radius: 20px;
    }

    .product-thumb {
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        transition: .2s ease;
        background: #fff;
    }

    .product-thumb:hover,
    .product-thumb:focus-within {
        border-color: #0055AA;
        box-shadow: 0 0 0 3px rgba(0, 85, 170, .08);
    }

    .product-feature {
        background: #F5F8FF;
        border: 1px solid #E8EEFA;
        border-radius: 12px;
    }

    .product-primary-btn {
        background: #010348;
        color: #fff;
        transition: .2s ease;
    }

    .product-primary-btn:hover {
        background: #0055AA;
        transform: translateY(-1px);
    }

    .product-primary-btn:active {
        transform: translateY(0);
    }

    .product-section-title {
        position: relative;
        padding-right: 14px;
    }

    .product-section-title::before {
        content: "";
        position: absolute;
        right: 0;
        top: 5px;
        width: 4px;
        height: 22px;
        border-radius: 5px;
        background: #0055AA;
    }

    .product-table-row:nth-child(odd) {
        background: #F8FAFC;
    }

    .product-table-row {
        border-radius: 8px;
    }

    .product-page img {
        max-width: 100%;
    }

    @media (max-width: 1023px) {
        .product-mobile-buy {
            padding-bottom: max(12px, env(safe-area-inset-bottom));
        }

        .product-description img {
            height: auto;
        }
    }
</style>

<div class="product-page bg-white pb-28 lg:pb-12">

    {{-- Breadcrumb --}}
    <section class="w-11/12 mx-auto pt-5 pb-4">
        <nav class="flex items-center flex-wrap gap-2 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-[#0055AA] transition">
                صفحه اصلی
            </a>

            <span>/</span>

            @if($category)
                <form action="{{ route('search.page') }}" method="POST" class="inline-flex items-center gap-2">
                    @csrf
                    <input type="hidden" name="categoryId" value="{{ $category->id }}">
                    <button type="submit" class="hover:text-[#0055AA] transition">
                        {{ $category->title }}
                    </button>
                </form>
                <span>/</span>
            @endif

            <span class="text-[#010348] font-bold line-clamp-1">
                {{ $product->title }}
            </span>
        </nav>
    </section>


    {{-- Product main --}}
    <section class="w-11/12 mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-9 items-start">

            {{-- Gallery --}}
            <div class="lg:col-span-5 xl:col-span-5">

                <div class="product-gallery-main relative p-4 sm:p-6">

                    @if($hasDiscount)
                        <div class="absolute top-4 right-4 z-10 flex items-center gap-1 bg-[#E5232E] text-white text-xs font-bold px-3 py-1.5 rounded-full">
                            <span>{{ $discountPercent }}٪ تخفیف</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-center h-[280px] sm:h-[380px] lg:h-[420px]">
                        @if($mainMedia && $mainMedia->media_path)
                            <img
                                class="gallery_pack_single_primary_img w-full h-full object-contain"
                                src="{{ asset('storage/' . $mainMedia->media_path) }}"
                                alt="{{ $product->title }}"
                                fetchpriority="high"
                            >
                        @else
                            <img
                                class="w-3/5 h-3/5 object-contain opacity-50"
                                src="{{ asset('storage/images/noImage.png') }}"
                                alt="{{ $product->title }}"
                            >
                        @endif
                    </div>
                </div>

                {{-- Thumbnails --}}
                @if($galleryMedia->count())
                    <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2" style="scrollbar-width:none;">
                        @if($mainMedia && $mainMedia->media_path)
                            <div class="product-thumb shrink-0 p-1.5 cursor-pointer">
                                <div class="gallery_pack_single w-[68px] h-[68px]">
                                    <img
                                        src="{{ asset('storage/' . $mainMedia->media_path) }}"
                                        alt="{{ $product->title }}"
                                        class="w-full h-full object-contain"
                                    >
                                </div>
                            </div>
                        @endif

                        @foreach($galleryMedia as $media)
                            @if($media->media_path)
                                <div class="product-thumb shrink-0 p-1.5 cursor-pointer">
                                    <div class="gallery_pack_single w-[68px] h-[68px]">
                                        <img
                                            src="{{ asset('storage/' . $media->media_path) }}"
                                            alt="{{ $product->title }}"
                                            class="w-full h-full object-contain"
                                        >
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Trust items --}}
                <div class="hidden lg:grid grid-cols-3 gap-3 mt-5">
                    <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#F8FAFC]">
                        <span class="size-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#0055AA]">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M12 3 4.5 6v5.5c0 4.5 3.2 7.8 7.5 9.5 4.3-1.7 7.5-5 7.5-9.5V6L12 3Z"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                        </span>
                        <span class="text-xs font-medium">خرید مطمئن</span>
                    </div>

                    <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#F8FAFC]">
                        <span class="size-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#0055AA]">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 7h11v11H3zM14 11h4l3 3v4h-7z"/>
                                <circle cx="7.5" cy="18" r="1.5"/>
                                <circle cx="17.5" cy="18" r="1.5"/>
                            </svg>
                        </span>
                        <span class="text-xs font-medium">ارسال سفارش</span>
                    </div>

                    <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#F8FAFC]">
                        <span class="size-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#0055AA]">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M12 8v4l2.5 2.5"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </span>
                        <span class="text-xs font-medium">پشتیبانی خرید</span>
                    </div>
                </div>

            </div>


            {{-- Product information --}}
            <div class="lg:col-span-7 xl:col-span-7 min-w-0">

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                    {{-- Title, features and description --}}
                    <div class="xl:col-span-7">

                        <div class="mb-5">
                            @if($product->brand)
                                <div class="inline-flex items-center gap-2 text-xs text-slate-500 bg-slate-50 border border-slate-100 rounded-full px-3 py-1.5 mb-3">
                                    <span class="size-1.5 rounded-full bg-[#0055AA]"></span>
                                    {{ $product->brand }}
                                </div>
                            @endif

                            <h1 class="text-xl xl:text-[18px] font-bold leading-[1.9] text-[#010348]">
                                {{ $product->title }}
                            </h1>

                            @if($product->summary)
                                <p class="text-sm text-slate-500 leading-8 mt-3 text-justify">
                                    {{ $product->summary }}
                                </p>
                            @endif
                        </div>


                        {{-- Key features --}}
                        @if($product->attributes->count())
                            <div class="border-t border-slate-100 pt-5 mt-5">

                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="font-bold text-base text-[#010348]">
                                        ویژگی‌های محصول
                                    </h2>

                                    <a href="#product-specifications" class="text-xs text-[#0055AA] hover:underline">
                                        مشاهده همه
                                    </a>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    @foreach($product->attributes->take(6) as $attr)
                                        <div class="product-feature p-3 min-w-0">
                                            <p class="text-[11px] text-slate-500 mb-1.5 truncate">
                                                {{ $attr->attribute_key }}
                                            </p>
                                            <p class="text-sm font-bold text-[#010348] leading-6 break-words line-clamp-2">
                                                {{ $attr->attribute_value }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endif


                        {{-- Desktop short description --}}
                        <div class="hidden xl:block border-t border-slate-100 mt-6 pt-5">
                            <h2 class="font-bold text-base mb-3">درباره محصول</h2>
                            <p class="text-sm text-slate-500 leading-8 text-justify line-clamp-4">
                                {{ $product->summary ?: 'برای مشاهده اطلاعات کامل این محصول، بخش توضیحات و مشخصات را بررسی کنید.' }}
                            </p>
                            <a href="#product-description" class="inline-flex items-center gap-2 mt-3 text-xs text-[#0055AA] font-bold hover:underline">
                                مطالعه توضیحات کامل
                                <span>←</span>
                            </a>
                        </div>

                    </div>


                    {{-- Purchase card --}}
                    <div class="xl:col-span-5">

                        <div class="product-card product-shadow p-4 sm:p-5 xl:sticky xl:top-6">

                            {{-- Seller --}}
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">فروشنده</p>
                                    <div class="flex items-center gap-2">
                                        <span class="size-8 rounded-xl bg-[#EAF2FF] flex items-center justify-center text-[#0055AA]">
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M3 10h18l-1.5-6h-15L3 10Z"/>
                                                <path d="M5 10v10h14V10M9 20v-6h6v6"/>
                                            </svg>
                                        </span>
                                        <span class="font-bold text-sm">دیارابزار</span>
                                    </div>
                                </div>

                                <span class="text-[10px] text-[#0055AA] bg-[#EAF2FF] px-2.5 py-1.5 rounded-full">
                                    فروشگاه دیارابزار
                                </span>
                            </div>


                            {{-- Price --}}
                            <div class="py-5">

                                @if($hasPrice)

                                    @if($hasDiscount)
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-xs text-slate-400 line-through in-fa">
                                                {{ number_format($product->primary_price) }}
                                            </span>
                                            <span class="text-[11px] font-bold text-white bg-[#E5232E] px-2 py-1 rounded-md">
                                                {{ $discountPercent }}٪ تخفیف
                                            </span>
                                        </div>
                                    @endif

                                    <div class="flex items-end justify-between gap-2">
                                        <div>
                                            <p class="text-xs text-slate-400 mb-2">قیمت محصول</p>
                                            <div class="flex items-baseline gap-2">
                                                <span class="text-2xl sm:text-3xl font-extrabold text-[#010348] in-fa">
                                                    {{ number_format($hasDiscount ? $product->secondary_price : $product->primary_price) }}
                                                </span>
                                                <span class="text-xs text-slate-500">تومان</span>
                                            </div>
                                        </div>

                                        <span class="text-[10px] text-emerald-600 bg-emerald-50 rounded-full px-2.5 py-1.5">
                                            قیمت درج‌شده
                                        </span>
                                    </div>

                                @else

                                    <div class="rounded-xl bg-[#F5F8FF] border border-[#E5EDFC] p-4">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="size-8 rounded-lg bg-[#EAF2FF] flex items-center justify-center text-[#0055AA]">
                                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <path d="M12 11v5M12 8h.01"/>
                                                </svg>
                                            </span>
                                            <span class="font-bold text-sm">استعلام قیمت محصول</span>
                                        </div>

                                        <p class="text-xs text-slate-500 leading-6">
                                            برای اطلاع از قیمت و شرایط خرید این محصول، با کارشناسان دیارابزار تماس بگیرید.
                                        </p>

                                        <a href="tel:09142302912" dir="ltr"
                                           class="inline-flex items-center gap-2 mt-3 text-sm font-bold text-[#0055AA]">
                                            09142302912
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z"/>
                                            </svg>
                                        </a>
                                    </div>

                                @endif

                            </div>


                            {{-- Add to cart --}}
                            @if($hasPrice)

                                <div class="products" data-product-id="{{ $product->id }}">

                                    @if($isInCart)

                                        <div class="h-12 w-full px-3 bg-[#EAF2FF] border border-[#D8E6FF] rounded-xl flex items-center justify-between">
                                            <button
                                                onclick="setCount(this)"
                                                data-state="+"
                                                class="w-1/3 h-full text-xl font-bold text-[#010348] hover:text-[#0055AA]">
                                                +
                                            </button>

                                            <input
                                                type="number"
                                                readonly
                                                value="{{ $cartQuantity }}"
                                                class="w-1/3 text-center text-sm font-bold text-[#010348] bg-transparent outline-none"
                                            >

                                            <button
                                                onclick="setCount(this)"
                                                data-state="-"
                                                class="w-1/3 h-full text-xl font-bold text-[#010348] hover:text-[#E5232E]">
                                                -
                                            </button>
                                        </div>

                                    @else

                                        <button
                                            onclick="addToCart(this)"
                                            class="addToCartBtns product-primary-btn w-full h-12 rounded-xl flex items-center justify-center gap-2 font-bold text-sm"
                                            data-product-id="{{ $product->id }}"
                                            data-count="{{ $product->count }}"
                                        >
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6"/>
                                                <circle cx="10" cy="20" r="1"/>
                                                <circle cx="18" cy="20" r="1"/>
                                                <path d="M14 9v5M11.5 11.5h5"/>
                                            </svg>
                                            افزودن به سبد خرید
                                        </button>

                                    @endif

                                </div>

                            @else

                                <a href="tel:09142302912"
                                   class="product-primary-btn w-full h-12 rounded-xl flex items-center justify-center gap-2 text-sm font-bold">
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z"/>
                                    </svg>
                                    تماس برای استعلام قیمت
                                </a>

                            @endif


                            {{-- Purchase notes --}}
                            <div class="border-t border-slate-100 mt-5 pt-4 space-y-3">

                                <div class="flex items-center gap-2.5 text-xs text-slate-500">
                                    <svg class="size-4 text-[#0055AA] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 3 4.5 6v5.5c0 4.5 3.2 7.8 7.5 9.5 4.3-1.7 7.5-5 7.5-9.5V6L12 3Z"/>
                                        <path d="m9 12 2 2 4-4"/>
                                    </svg>
                                    خرید از فروشگاه دیارابزار
                                </div>

                                <div class="flex items-center gap-2.5 text-xs text-slate-500">
                                    <svg class="size-4 text-[#0055AA] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M3 7h11v11H3zM14 11h4l3 3v4h-7z"/>
                                        <circle cx="7.5" cy="18" r="1.5"/>
                                        <circle cx="17.5" cy="18" r="1.5"/>
                                    </svg>
                                    هماهنگی ارسال پس از ثبت سفارش
                                </div>

                                <div class="flex items-center gap-2.5 text-xs text-slate-500">
                                    <svg class="size-4 text-[#0055AA] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 8v4l2.5 2.5"/>
                                        <circle cx="12" cy="12" r="9"/>
                                    </svg>
                                    پاسخ‌گویی و پشتیبانی خرید
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- Product description --}}
    <section id="product-description" class="w-11/12 mx-auto mt-10 lg:mt-14">

        <div class="product-card p-5 sm:p-7">

            <div class="mb-5">
                <h2 class="product-section-title text-lg font-extrabold">
                    معرفی محصول
                </h2>
                <p class="text-xs text-slate-400 mt-2 mr-3.5">
                    توضیحات و اطلاعات تکمیلی درباره {{ $product->title }}
                </p>
            </div>

            <div class="product-description text-sm text-slate-600 leading-9 text-justify overflow-hidden">
                {!! $product->description !!}
            </div>

        </div>

    </section>


    {{-- Product specifications --}}
    @if($product->attributes->count())
        <section id="product-specifications" class="w-11/12 mx-auto mt-6 lg:mt-8">

            <div class="product-card p-5 sm:p-7">

                <div class="mb-6">
                    <h2 class="product-section-title text-lg font-extrabold">
                        مشخصات فنی محصول
                    </h2>
                    <p class="text-xs text-slate-400 mt-2 mr-3.5">
                        جزئیات و ویژگی‌های فنی محصول
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1">

                    @foreach($product->attributes as $attribute)
                        <div class="product-table-row flex items-center gap-4 px-3 py-3.5 min-w-0">

                            <div class="w-2/5 shrink-0 text-xs sm:text-sm text-slate-500">
                                {{ $attribute->attribute_key }}
                            </div>

                            <div class="w-3/5 text-xs sm:text-sm font-bold text-[#010348] break-words">
                                {{ $attribute->attribute_value }}
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>
    @endif

</div>


{{-- Mobile fixed purchase bar --}}
<div class="product-mobile-buy fixed bottom-0 right-0 z-[1000] w-full bg-white/95 backdrop-blur-md border-t border-slate-200 px-3 py-3 lg:hidden">

    <div class="flex items-center gap-3">

        <div class="flex-1 min-w-0">

            @if($hasPrice)

                @if($hasDiscount)
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[10px] text-slate-400 line-through in-fa">
                            {{ number_format($product->primary_price) }}
                        </span>
                        <span class="text-[10px] text-[#E5232E] font-bold">
                            {{ $discountPercent }}٪ تخفیف
                        </span>
                    </div>
                @endif

                <div class="flex items-baseline gap-1.5">
                    <span class="text-lg font-extrabold text-[#010348] in-fa">
                        {{ number_format($hasDiscount ? $product->secondary_price : $product->primary_price) }}
                    </span>
                    <span class="text-[10px] text-slate-500">تومان</span>
                </div>

            @else

                <p class="text-xs font-bold text-[#010348]">
                    نیاز به استعلام قیمت
                </p>
                <a href="tel:09142302912" dir="ltr" class="text-xs text-[#0055AA] font-bold">
                    09142302912
                </a>

            @endif

        </div>


        <div class="w-[48%]">

            @if($hasPrice)

                <div class="products w-full" data-product-id="{{ $product->id }}">

                    @if($isInCart)

                        <div class="h-11 w-full px-2 bg-[#EAF2FF] border border-[#D8E6FF] rounded-xl flex items-center justify-between">

                            <button
                                onclick="setCount(this)"
                                data-state="+"
                                class="w-1/3 h-full text-xl font-bold text-[#010348]">
                                +
                            </button>

                            <input
                                type="number"
                                readonly
                                value="{{ $cartQuantity }}"
                                class="w-1/3 text-center text-sm font-bold text-[#010348] bg-transparent outline-none"
                            >

                            <button
                                onclick="setCount(this)"
                                data-state="-"
                                class="w-1/3 h-full text-xl font-bold text-[#010348]">
                                -
                            </button>

                        </div>

                    @else

                        <button
                            onclick="addToCart(this)"
                            class="addToCartBtns product-primary-btn w-full h-11 rounded-xl flex items-center justify-center gap-2 text-xs font-bold"
                            data-product-id="{{ $product->id }}"
                            data-count="{{ $product->count }}"
                        >
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6"/>
                                <circle cx="10" cy="20" r="1"/>
                                <circle cx="18" cy="20" r="1"/>
                                <path d="M14 9v5M11.5 11.5h5"/>
                            </svg>
                            افزودن به سبد
                        </button>

                    @endif

                </div>

            @else

                <a href="tel:09142302912"
                   class="product-primary-btn w-full h-11 rounded-xl flex items-center justify-center text-xs font-bold">
                    تماس برای استعلام
                </a>

            @endif

        </div>

    </div>

</div>


<script>
    let productId = "{{ $product->id }}";
</script>

<script src="{{ asset('js/singleProduct.js') }}"></script>

@endsection