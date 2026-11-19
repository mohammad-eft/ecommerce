
@extends('app.document')

@section('title', 'دیار ابزار | درباره ما')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    .container-x {
        width: min(1180px, calc(100% - 32px));
        margin-inline: auto;
    }

    .diar-hero {
        background:
            radial-gradient(circle at 10% 20%, rgba(237, 23, 31, .13), transparent 35%),
            linear-gradient(135deg, #071b49 0%, #102b61 65%, #17428b 100%);
    }

    .diar-image {
        min-height: 440px;
    }

    .diar-glass {
        background: rgba(255, 255, 255, .94);
        backdrop-filter: blur(12px);
    }

    .diar-line::after {
        content: "";
        display: block;
        width: 48px;
        height: 3px;
        background: #ed171f;
        border-radius: 20px;
        margin: 12px auto 0;
    }

    .diar-card {
        transition: all .3s ease;
    }

    .diar-card:hover {
        transform: translateY(-6px);
        border-color: rgba(237, 23, 31, .4);
        box-shadow: 0 18px 35px rgba(7, 27, 73, .08);
    }

    .diar-icon {
        background: #edf2ff;
        color: #1455b8;
    }

    .diar-orange {
        color: #ed171f;
    }

    .diar-bg {
        background: #f5f7f9;
    }

    .diar-cta {
        background: linear-gradient(120deg, #071b49, #153b7a);
    }

    @media(max-width: 768px) {
        .diar-image {
            min-height: 290px;
        }
    }
</style>

<div class="bg-white text-slate-800 mt-3">

    {{-- Top Bar --}}
    <div class="bg-[#ed171f] text-white text-center text-xs sm:text-sm py-2 px-4">
        دیار ابزار؛ همراه مطمئن شما در انتخاب ابزار مناسب
    </div>

    <main>

        {{-- Hero --}}
        <section class="diar-hero text-white overflow-hidden">
            <div class="container-x grid lg:grid-cols-2 items-center gap-10">

                <div class="py-16 sm:py-20 lg:py-24">

                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-[3px] bg-[#ed171f] rounded-full"></span>
                        <span class="text-red-400 font-bold text-sm">
                            آشنایی با دیار ابزار
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.5]">
                        ابزار درست،
                        <span class="text-[#ed171f]">شروع یک کار حرفه‌ای</span>
                    </h1>

                    <p class="mt-6 text-sm sm:text-base leading-9 text-slate-300 max-w-xl">
                        دیار ابزار با هدف فراهم کردن دسترسی آسان به ابزارآلات
                        ساختمانی و صنعتی فعالیت می‌کند. ما باور داریم انتخاب
                        ابزار مناسب، فقط خرید یک محصول نیست؛ بلکه قدمی مهم
                        برای افزایش کیفیت، سرعت و دقت در انجام کارهاست.
                    </p>

                    <p class="mt-3 text-sm sm:text-base leading-9 text-slate-300 max-w-xl">
                        تلاش ما این است که تجربه‌ای ساده و مطمئن از جست‌وجو،
                        انتخاب و خرید ابزار را برای فعالان حوزه ساختمان،
                        صنعت و تمام علاقه‌مندان به کارهای فنی فراهم کنیم.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-3">
                        <a href="{{ url('/') }}"
                           class="px-7 py-3.5 rounded-xl bg-[#ed171f] text-white font-bold hover:bg-red-700 transition">
                            مشاهده فروشگاه
                        </a>

                        <a href="#why-diar"
                           class="px-7 py-3.5 rounded-xl border border-white/25 text-white font-bold hover:bg-white/10 transition">
                            چرا دیار ابزار؟
                        </a>
                    </div>

                </div>

                <div class="diar-image relative overflow-hidden rounded-t-[30px] lg:rounded-t-none lg:rounded-l-[30px]">

                    <img
                        src="{{ asset('img/about.png') }}"
                        alt="ابزارآلات ساختمانی و صنعتی دیار ابزار"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#071b49]/80 via-transparent to-transparent"></div>

                    <div class="absolute bottom-6 right-6 left-6 diar-glass rounded-2xl p-5 shadow-xl">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#edf2ff] flex items-center justify-center text-2xl">
                                🔧
                            </div>

                            <div>
                                <p class="font-extrabold text-slate-900">
                                    ابزار مناسب برای هر پروژه
                                </p>
                                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                    انتخابی آگاهانه برای کاری باکیفیت‌تر
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>


        {{-- Introduction --}}
        <section class="py-16 sm:py-20">

            <div class="container-x grid lg:grid-cols-2 gap-12 items-center">

                <div>
                    <span class="text-[#ed171f] font-bold text-sm">
                        ما چه کاری انجام می‌دهیم؟
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-4 leading-relaxed">
                        فقط فروش ابزار نیست؛
                        <span class="text-[#ed171f]">کمک به انتخاب بهتر است.</span>
                    </h2>

                    <p class="mt-5 text-sm sm:text-base leading-9 text-slate-600">
                        در دیار ابزار تلاش می‌کنیم مجموعه‌ای کاربردی از
                        ابزارآلات موردنیاز پروژه‌های ساختمانی، صنعتی و فنی
                        در اختیار شما قرار دهیم.
                    </p>

                    <p class="mt-4 text-sm sm:text-base leading-9 text-slate-600">
                        از ابزارهای برقی و دستی گرفته تا تجهیزات موردنیاز
                        کارگاه‌ها و پروژه‌های ساختمانی، هدف ما این است که
                        بتوانید متناسب با نیاز و نوع فعالیت خود، محصول
                        مناسبی انتخاب کنید.
                    </p>

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div class="rounded-3xl bg-[#f5f7f9] p-6">
                        <div class="text-3xl mb-5">⚙️</div>
                        <h3 class="font-extrabold text-slate-800">
                            ابزارهای برقی
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-7 mt-3">
                            تجهیزات کاربردی برای انجام کارهای فنی و ساختمانی
                        </p>
                    </div>

                    <div class="rounded-3xl bg-[#eef3ff] p-6 mt-8">
                        <div class="text-3xl mb-5">🔨</div>
                        <h3 class="font-extrabold text-slate-800">
                            ابزارهای دستی
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-7 mt-3">
                            ابزارهای موردنیاز برای کارهای روزمره و تخصصی
                        </p>
                    </div>

                    <div class="rounded-3xl bg-[#eef3ff] p-6">
                        <div class="text-3xl mb-5">📐</div>
                        <h3 class="font-extrabold text-slate-800">
                            ابزار اندازه‌گیری
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-7 mt-3">
                            تجهیزات لازم برای اندازه‌گیری دقیق‌تر
                        </p>
                    </div>

                    <div class="rounded-3xl bg-[#f5f7f9] p-6 mt-8">
                        <div class="text-3xl mb-5">🏗️</div>
                        <h3 class="font-extrabold text-slate-800">
                            تجهیزات ساختمانی
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-7 mt-3">
                            محصولات کاربردی برای پروژه‌های ساختمانی
                        </p>
                    </div>

                </div>

            </div>

        </section>


        {{-- Why Diar Abzar --}}
        <section id="why-diar" class="diar-bg py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">
                    <h2 class="diar-line text-2xl sm:text-3xl font-bold text-slate-900">
                        چرا دیار ابزار؟
                    </h2>

                    <p class="mt-6 text-sm sm:text-base text-slate-500 leading-8">
                        تجربه خرید خوب از انتخاب درست شروع می‌شود.
                        ما در تلاشیم این مسیر را برای شما ساده‌تر کنیم.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🛡️
                        </div>

                        <h3 class="font-extrabold mt-5 text-slate-800">
                            خرید مطمئن
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            تلاش می‌کنیم اطلاعات محصولات را به شکلی شفاف
                            ارائه کنیم تا با اطمینان بیشتری خرید کنید.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🧰
                        </div>

                        <h3 class="font-extrabold mt-5 text-slate-800">
                            تنوع ابزار
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            مجموعه‌ای از ابزارهای موردنیاز برای فعالیت‌های
                            ساختمانی، صنعتی و فنی.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            💬
                        </div>

                        <h3 class="font-extrabold mt-5 text-slate-800">
                            راهنمایی مشتری
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            انتخاب ابزار مناسب اهمیت زیادی دارد؛
                            برای پیدا کردن گزینه مناسب، همراه شما هستیم.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🛒
                        </div>

                        <h3 class="font-extrabold mt-5 text-slate-800">
                            خرید آسان
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            می‌خواهیم فرایند بررسی محصولات و ثبت سفارش
                            برای شما ساده و قابل‌دسترس باشد.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- Our Approach --}}
        <section class="py-16 sm:py-20">

            <div class="container-x">

                <div class="rounded-[30px] overflow-hidden bg-[#071b49] text-white grid lg:grid-cols-2">

                    <div class="p-8 sm:p-12 lg:p-14 flex flex-col justify-center">

                        <span class="text-[#ed171f] font-bold text-sm">
                            نگاه ما به آینده
                        </span>

                        <h2 class="text-2xl sm:text-3xl font-bold leading-relaxed mt-4">
                            ساختن تجربه‌ای بهتر برای خرید ابزار
                        </h2>

                        <p class="mt-5 text-sm sm:text-base text-slate-300 leading-9">
                            باور داریم یک فروشگاه تخصصی ابزار باید بیشتر
                            از نمایش چند محصول باشد. مشتری باید بتواند
                            محصول موردنیاز خود را پیدا کند، مشخصات آن را
                            بررسی کند و با آگاهی تصمیم بگیرد.
                        </p>

                        <p class="mt-4 text-sm sm:text-base text-slate-300 leading-9">
                            به همین دلیل، در دیار ابزار به دنبال ایجاد
                            تجربه‌ای ساده، شفاف و قابل اعتماد هستیم؛
                            تجربه‌ای که در آن نیاز مشتری در اولویت قرار دارد.
                        </p>

                        <a href="{{ url('/') }}"
                           class="mt-7 self-start rounded-xl bg-[#ed171f] px-6 py-3 font-bold text-white hover:bg-red-700 transition">
                            همراه ما باشید
                        </a>

                    </div>

                    <div class="relative min-h-[300px] lg:min-h-[460px]">

                        <img
                            src="{{ asset('img/about.png') }}"
                            alt="تجهیزات و ابزارآلات فنی"
                            class="absolute inset-0 w-full h-full object-cover"
                        >

                        <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#071b49]/30"></div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Values --}}
        <section class="diar-bg py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-bold text-slate-900">
                        ارزش‌هایی که به آن‌ها پایبندیم
                    </h2>

                    <p class="mt-6 text-sm text-slate-500">
                        اصولی که مسیر فعالیت دیار ابزار را شکل می‌دهند.
                    </p>

                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

                    <div class="text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-3xl shadow-sm">
                            🤝
                        </div>

                        <h3 class="font-extrabold mt-5">
                            اعتماد
                        </h3>

                        <p class="text-sm text-slate-500 mt-3 leading-7">
                            اعتماد مشتری، سرمایه اصلی یک کسب‌وکار است.
                        </p>

                    </div>

                    <div class="text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-3xl shadow-sm">
                            🎯
                        </div>

                        <h3 class="font-extrabold mt-5">
                            دقت
                        </h3>

                        <p class="text-sm text-slate-500 mt-3 leading-7">
                            توجه به نیاز مشتری و انتخاب درست محصولات.
                        </p>

                    </div>

                    <div class="text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-3xl shadow-sm">
                            💡
                        </div>

                        <h3 class="font-extrabold mt-5">
                            یادگیری و پیشرفت
                        </h3>

                        <p class="text-sm text-slate-500 mt-3 leading-7">
                            تلاش مستمر برای ارائه تجربه‌ای بهتر.
                        </p>

                    </div>

                    <div class="text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-3xl shadow-sm">
                            ❤️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            مشتری‌مداری
                        </h3>

                        <p class="text-sm text-slate-500 mt-3 leading-7">
                            توجه به رضایت و نیاز واقعی خریداران.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- CTA --}}
        <section class="py-16 sm:py-20">

            <div class="container-x">

                <div class="diar-cta rounded-[30px] p-8 sm:p-14 text-center relative overflow-hidden">

                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-[#ed171f]/10 rounded-full blur-3xl"></div>

                    <div class="relative ">

                        <div class="text-4xl mb-5">🔧</div>

                        <h2 class="text-2xl sm:text-3xl font-bold text-white leading-relaxed">
                            برای شروع یک کار حرفه‌ای آماده‌اید؟
                        </h2>

                        <p class="mt-4 text-sm sm:text-base text-slate-300 leading-8 max-w-2xl mx-auto">
                            ابزار مناسب خود را پیدا کنید و با انتخابی آگاهانه،
                            کیفیت و دقت کارتان را افزایش دهید.
                        </p>

                        <div class="mt-8 flex flex-wrap justify-center gap-3">

                            <a href="{{ url('/') }}"
                               class="px-8 py-3.5 rounded-xl bg-[#ed171f] text-white font-bold hover:bg-red-700 transition">
                                ورود به فروشگاه
                            </a>

                            <a href="#about"
                               class="px-8 py-3.5 rounded-xl border border-white/20 text-white font-bold hover:bg-white/10 transition">
                                بازگشت به بالا
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

@endsection
