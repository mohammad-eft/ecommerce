
@extends('app.document')

@section('title', 'دیار ابزار | تماس با ما')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    .container-x {
        width: min(1180px, calc(100% - 32px));
        margin-inline: auto;
    }

    .diar-navy {
        background: #071b49;
    }

    .diar-red {
        color: #ed171f;
    }

    .diar-bg {
        background: #f5f7fb;
    }

    .diar-accent {
        background: #ed171f;
    }

    .diar-hero {
        background:
            radial-gradient(circle at 85% 20%, rgba(35, 91, 190, .2), transparent 35%),
            linear-gradient(120deg, #061638, #102b61);
    }

    .diar-card {
        transition: all .25s ease;
    }

    .diar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(7, 27, 73, .09);
    }

    .diar-icon {
        background: #edf2ff;
        color: #102b61;
    }

    .diar-input {
        transition: all .2s ease;
    }

    .diar-input:focus {
        border-color: #ed171f;
        box-shadow: 0 0 0 3px rgba(237, 23, 31, .08);
        outline: none;
    }

    .diar-line::after {
        content: "";
        display: block;
        width: 45px;
        height: 3px;
        background: #ed171f;
        border-radius: 20px;
        margin: 12px auto 0;
    }

    .diar-cta {
        background: linear-gradient(120deg, #071b49, #153b7a);
    }

    @media(max-width: 768px) {
        .contact-image {
            min-height: 220px;
        }
    }
</style>

<div class="bg-white text-slate-800">

    <main id="contact">

        {{-- Hero --}}
        <section class="diar-hero text-white overflow-hidden">

            <div class="container-x grid lg:grid-cols-2 items-center gap-10 py-14 sm:py-20">

                <div class="order-2 lg:order-1">

                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-12 h-[3px] bg-red-500 rounded-full"></span>
                        <span class="text-red-400 font-bold">
                            ارتباط با دیار ابزار
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-[1.6]">
                        ما اینجا هستیم تا
                        <span class="text-red-500">به شما کمک کنیم.</span>
                    </h1>

                    <p class="text-base sm:text-lg font-medium mt-5 leading-9 text-slate-200">
                        انتخاب ابزار مناسب، گاهی به یک راهنمایی ساده نیاز دارد.
                        اگر درباره محصولات، سفارش‌ها یا نحوه خرید سؤالی دارید،
                        خوشحال می‌شویم با شما در ارتباط باشیم.
                    </p>

                    <p class="text-sm sm:text-base text-slate-300 leading-8 mt-4">
                        از مشاوره انتخاب ابزار گرفته تا پیگیری سفارش و ثبت پیشنهادها،
                        می‌توانید از طریق راه‌های ارتباطی دیار ابزار با ما در تماس باشید.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">

                        <a href="#contact-form"
                           class="px-7 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold transition">
                            ارسال پیام
                        </a>

                        <a href="#contact-info"
                           class="px-7 py-3.5 rounded-xl border border-white/25 hover:bg-white/10 text-white font-bold transition">
                            راه‌های ارتباطی
                        </a>

                    </div>

                </div>

                <div class="order-1 lg:order-2 relative">

                    <div class="absolute inset-0 bg-blue-500/10 blur-3xl rounded-full"></div>

                    <img
                        src="{{ asset('img/contact.png') }}"
                        alt="ارتباط با دیار ابزار"
                        class="contact-image relative w-full h-full max-h-[430px] object-cover rounded-3xl shadow-2xl"
                    >

                    <div class="absolute bottom-5 right-5 left-5 bg-white/95 backdrop-blur rounded-2xl p-4 sm:p-5 shadow-xl">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center text-2xl">
                                🛠️
                            </div>

                            <div>
                                <h3 class="font-extrabold text-slate-900">
                                    همراه شما در انتخاب ابزار
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                    پاسخ‌گویی به سؤالات و راهنمایی خرید
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Contact Information + Form --}}
        <section class="py-14 sm:py-20">

            <div class="container-x grid lg:grid-cols-5 gap-6">

                {{-- Contact Info --}}
                <aside id="contact-info"
                       class="lg:col-span-2 rounded-3xl bg-[#071b49] text-white p-7 sm:p-9 overflow-hidden relative">

                    <div class="absolute -left-16 -top-16 w-48 h-48 rounded-full bg-blue-500/10 blur-2xl"></div>

                    <div class="relative z-10">

                        <span class="text-red-400 font-bold text-sm">
                            در کنار شما هستیم
                        </span>

                        <h2 class="text-2xl font-black mt-3">
                            راه‌های ارتباطی
                        </h2>

                        <p class="text-sm text-slate-300 leading-8 mt-4">
                            برای دریافت اطلاعات بیشتر، پیگیری سفارش‌ها و
                            مطرح کردن سؤالات خود می‌توانید از راه‌های ارتباطی
                            فروشگاه با ما در تماس باشید.
                        </p>


                        <div class="mt-9 grid gap-7">

                            {{-- Phone --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl bg-white/10 grid place-items-center text-xl">
                                    ☎
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        شماره تماس
                                    </h3>

                                    {{-- شماره تماس واقعی فروشگاه را اینجا قرار دهید --}}
                                    <p class="text-sm text-slate-300 mt-2">
                                        شماره تماس فروشگاه
                                    </p>

                                    <small class="text-xs text-slate-400">
                                        پاسخ‌گویی به سؤالات شما
                                    </small>
                                </div>

                            </div>


                            {{-- Email --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl bg-white/10 grid place-items-center text-xl">
                                    ✉
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        پست الکترونیکی
                                    </h3>

                                    {{-- ایمیل واقعی فروشگاه را اینجا قرار دهید --}}
                                    <p class="text-sm text-slate-300 mt-2">
                                        ایمیل فروشگاه
                                    </p>

                                    <small class="text-xs text-slate-400">
                                        ارسال درخواست و پیشنهاد
                                    </small>
                                </div>

                            </div>


                            {{-- Address --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl bg-white/10 grid place-items-center text-xl">
                                    📍
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        آدرس فروشگاه
                                    </h3>

                                    {{-- آدرس واقعی فروشگاه را اینجا قرار دهید --}}
                                    <p class="text-sm text-slate-300 mt-2 leading-7">
                                        آدرس فروشگاه دیار ابزار
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="mt-10 pt-6 border-t border-white/10">

                            <p class="text-sm text-slate-300 leading-8">
                                نظرات و پیشنهادهای شما به ما کمک می‌کند
                                خدمات بهتری ارائه دهیم.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-red-400 font-bold text-sm">
                                <span>🔧</span>
                                <span>دیار ابزار، همراه پروژه‌های شما</span>
                            </div>

                        </div>

                    </div>

                </aside>


                {{-- Contact Form --}}
                <section id="contact-form"
                         class="lg:col-span-3 rounded-3xl border border-slate-200 p-7 sm:p-9 shadow-sm bg-white">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-xl">
                            ✉
                        </div>

                        <div>
                            <h2 class="text-2xl font-black text-slate-900">
                                ارسال پیام به ما
                            </h2>

                            <p class="text-sm text-slate-500 mt-2">
                                پیام خود را ثبت کنید تا بتوانیم بهتر راهنمایی‌تان کنیم.
                            </p>
                        </div>

                    </div>


                    <form class="mt-9 grid sm:grid-cols-2 gap-5"
                          onsubmit="event.preventDefault(); document.getElementById('success').classList.remove('hidden');">

                        {{-- Name --}}
                        <label class="block">

                            <span class="text-sm font-bold">
                                نام و نام خانوادگی
                                <b class="text-red-500">*</b>
                            </span>

                            <input
                                required
                                type="text"
                                name="name"
                                class="diar-input mt-2 w-full h-14 rounded-xl border border-slate-200 px-4"
                                placeholder="نام خود را وارد کنید"
                            >

                        </label>


                        {{-- Phone --}}
                        <label class="block">

                            <span class="text-sm font-bold">
                                شماره موبایل
                                <b class="text-red-500">*</b>
                            </span>

                            <input
                                required
                                type="tel"
                                name="phone"
                                dir="ltr"
                                class="diar-input mt-2 w-full h-14 rounded-xl border border-slate-200 px-4 text-right"
                                placeholder="09123456789"
                            >

                        </label>


                        {{-- Email --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold">
                                ایمیل
                                <span class="text-slate-400 font-normal">(اختیاری)</span>
                            </span>

                            <input
                                type="email"
                                name="email"
                                dir="ltr"
                                class="diar-input mt-2 w-full h-14 rounded-xl border border-slate-200 px-4"
                                placeholder="example@email.com"
                            >

                        </label>


                        {{-- Subject --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold">
                                موضوع پیام
                                <b class="text-red-500">*</b>
                            </span>

                            <select
                                required
                                name="subject"
                                class="diar-input mt-2 w-full h-14 rounded-xl border border-slate-200 px-4 bg-white">

                                <option value="">موضوع موردنظر را انتخاب کنید</option>
                                <option value="مشاوره خرید ابزار">مشاوره خرید ابزار</option>
                                <option value="پیگیری سفارش">پیگیری سفارش</option>
                                <option value="اطلاعات محصولات">اطلاعات محصولات</option>
                                <option value="شرایط ارسال">شرایط ارسال</option>
                                <option value="همکاری">همکاری</option>
                                <option value="پیشنهاد و انتقاد">پیشنهاد و انتقاد</option>
                                <option value="سایر">سایر موارد</option>

                            </select>

                        </label>


                        {{-- Message --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold">
                                متن پیام
                                <b class="text-red-500">*</b>
                            </span>

                            <textarea
                                required
                                name="message"
                                rows="6"
                                class="diar-input mt-2 w-full rounded-xl border border-slate-200 p-4 resize-y"
                                placeholder="سؤال یا درخواست خود را اینجا بنویسید..."
                            ></textarea>

                        </label>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="sm:col-span-2 h-14 rounded-xl bg-[#071b49] hover:bg-[#102b61] text-white font-bold transition flex items-center justify-center gap-3">

                            <span>ارسال پیام</span>
                            <span class="text-red-400">➤</span>

                        </button>


                        {{-- Demo Success --}}
                        <div id="success"
                             class="hidden sm:col-span-2 rounded-xl bg-green-50 border border-green-100 text-green-700 p-4 text-sm leading-7">

                            پیام شما ثبت شد. این فرم در حال حاضر نمایشی است
                            و برای ارسال واقعی باید به مسیر پردازش فرم در لاراول متصل شود.

                        </div>

                    </form>

                </section>

            </div>

        </section>


        {{-- Support Section --}}
        <section class="diar-bg py-14 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-black text-slate-900">
                        برای چه موضوعاتی با ما تماس بگیرید؟
                    </h2>

                    <p class="text-sm sm:text-base text-slate-500 mt-6 leading-8">
                        تیم دیار ابزار آماده دریافت سؤالات و درخواست‌های شماست.
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            🛠️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            مشاوره خرید ابزار
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            برای انتخاب ابزار مناسب با نوع کار و نیاز پروژه خود راهنمایی بگیرید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            📦
                        </div>

                        <h3 class="font-extrabold mt-5">
                            پیگیری سفارش
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            سؤالات خود را درباره وضعیت سفارش و فرایند تحویل مطرح کنید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            ⚙️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            مشخصات محصولات
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            درباره ویژگی‌ها، کاربردها و مشخصات فنی ابزارها سؤال کنید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl bg-white border border-slate-100 p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            🤝
                        </div>

                        <h3 class="font-extrabold mt-5">
                            پیشنهاد و همکاری
                        </h3>

                        <p class="text-sm text-slate-500 leading-8 mt-3">
                            پیشنهادها و درخواست‌های همکاری خود را با ما در میان بگذارید.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- FAQ --}}
        <section class="py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="text-2xl sm:text-3xl font-black text-[#071b49]">
                        سؤالات متداول
                    </h2>

                    <p class="diar-line text-sm text-slate-500 mt-4">
                        پاسخ برخی از سؤالات رایج مشتریان دیار ابزار
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 gap-5">

                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چگونه سفارش خود را پیگیری کنم؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            برای اطلاع از وضعیت سفارش خود می‌توانید از طریق فرم تماس
                            با ما موضوع «پیگیری سفارش» را انتخاب کرده و درخواستتان را ارسال کنید.
                        </p>

                    </details>


                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چطور ابزار مناسب کارم را انتخاب کنم؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            نوع فعالیت، میزان استفاده و مشخصات فنی ابزار از عوامل مهم
                            در انتخاب هستند. می‌توانید برای دریافت راهنمایی با ما تماس بگیرید.
                        </p>

                    </details>


                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            آیا امکان دریافت اطلاعات فنی محصولات وجود دارد؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            بله، برای دریافت اطلاعات بیشتر درباره مشخصات و کاربرد محصولات
                            می‌توانید درخواست خود را از طریق فرم تماس ارسال کنید.
                        </p>

                    </details>


                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چگونه از شرایط ارسال سفارش مطلع شوم؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            شرایط و زمان ارسال با توجه به مقصد و روش ارسال متفاوت است.
                            برای اطلاع از جزئیات سفارش خود با فروشگاه در ارتباط باشید.
                        </p>

                    </details>


                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            آیا امکان ثبت پیشنهاد و انتقاد وجود دارد؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            بله، نظرات و پیشنهادهای شما برای بهبود خدمات دیار ابزار
                            ارزشمند است. می‌توانید از طریق فرم تماس آن‌ها را ارسال کنید.
                        </p>

                    </details>


                    <details class="group rounded-2xl border border-slate-200 p-6 open:border-red-200">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چطور درباره موجودی یک محصول سؤال کنم؟

                            <span class="text-red-500 text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm text-slate-500 leading-8 mt-4">
                            نام محصول موردنظر را در پیام خود بنویسید تا درخواست شما
                            برای بررسی و پاسخ‌گویی به فروشگاه ارسال شود.
                        </p>

                    </details>

                </div>

            </div>

        </section>


        {{-- CTA --}}
        <section class="pb-16 sm:pb-20">

            <div class="container-x">

                <div class="diar-cta rounded-[30px] p-8 sm:p-14 text-center relative overflow-hidden">

                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl"></div>

                    <div class="relative">

                        <div class="text-4xl mb-5">🔧</div>

                        <h2 class="text-2xl sm:text-3xl font-black text-white leading-relaxed">
                            برای انتخاب ابزار مناسب آماده‌اید؟
                        </h2>

                        <p class="mt-4 text-sm sm:text-base text-slate-300 leading-8 max-w-2xl mx-auto">
                            محصولات دیار ابزار را بررسی کنید و ابزار موردنیاز
                            پروژه و فعالیت خود را پیدا کنید.
                        </p>

                        <div class="mt-8 flex flex-wrap justify-center gap-3">

                            <a href="{{ url('/') }}"
                               class="px-8 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold transition">
                                مشاهده فروشگاه
                            </a>

                            <a href="#contact-form"
                               class="px-8 py-3.5 rounded-xl border border-white/25 text-white hover:bg-white/10 font-bold transition">
                                ارسال پیام
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection