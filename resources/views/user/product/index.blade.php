
@extends('app.document')

@section('title', 'دیارابزار | همه محصولات')

@section('content')

    <main class="max-w-[1440px] mx-auto px-4 md:px-6 lg:px-8 py-8 md:py-12">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-xs text-slate-400 mb-7">
            <a href="/" class="hover:text-[#0055AA] transition">خانه</a>
            <span>/</span>
            <span class="text-[#010348] font-semibold">محصولات</span>
        </div>

        {{-- Page heading --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-7 h-[3px] rounded-full bg-[#0055AA]"></span>
                    <span class="text-[11px] font-bold tracking-wide text-[#0055AA]">DIAARABZAR CATALOG</span>
                </div>

                <h1 id="title" class="text-2xl md:text-3xl font-black text-[#010348]">
                    همه محصولات
                </h1>

                <p class="text-xs md:text-sm text-slate-500 mt-3 leading-7">
                    تجهیزات و ابزارهای مورد نیاز کسب‌وکار و صنعت را بررسی و انتخاب کنید.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-500 bg-white border border-[#E2E8F0] rounded-xl px-4 py-3">
                <span class="w-2 h-2 rounded-full bg-[#0055AA]"></span>
                <span id="productCount">{{ count($products) }} محصول</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-[250px_minmax(0,1fr)] lg:grid-cols-[270px_minmax(0,1fr)] gap-5 lg:gap-7">

            {{-- Mobile filter overlay --}}
            <div id="filterBg"
                 class="fixed inset-0 bg-[#010348]/45 backdrop-blur-[2px] z-[60] opacity-0 invisible transition-all duration-300 md:hidden">
            </div>

            {{-- Filters --}}
            <aside id="filterSection"
                   class="fixed top-0 right-0 bottom-0 z-[70] w-[min(88vw,360px)]
                          bg-white shadow-2xl overflow-y-auto
                          translate-x-full invisible transition-all duration-300
                          md:visible md:translate-x-0 md:shadow-none md:overflow-visible
                          md:static md:z-auto md:w-auto md:block md:rounded-2xl">

                {{-- Filter heading --}}
                <div class="sticky top-0 z-10 bg-white flex items-center justify-between px-5 py-5 border-b border-[#E2E8F0] md:rounded-t-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-[#EAF2FF] text-[#0055AA] flex items-center justify-center">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 7h16M7 12h10m-7 5h4"/>
                                <circle cx="8" cy="7" r="1.5" fill="white"/>
                                <circle cx="15" cy="12" r="1.5" fill="white"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-black text-[#010348]">فیلتر محصولات</h2>
                            <p class="text-[10px] text-slate-400 mt-1">انتخاب دقیق‌تر محصول</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="resetFilters"
                                type="button"
                                class="text-[11px] font-bold text-[#0055AA] hover:text-[#010348] transition">
                            پاک کردن
                        </button>

                        <button id="closeFilters"
                                type="button"
                                class="md:hidden w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m18 6-12 12M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Categories --}}
                <section class="px-5 py-5 border-b border-[#E2E8F0]">
                    <h3 class="text-xs font-black text-[#010348] mb-4">دسته‌بندی محصولات</h3>

                    <div class="space-y-3">
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input
                                    class="categories w-[17px] h-[17px] rounded accent-[#0055AA] cursor-pointer"
                                    type="checkbox"
                                    data-filter="{{ $category->id }}">

                                <span class="text-xs text-slate-600 group-hover:text-[#0055AA] transition">
                                    {{ $category->title }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </section>

                {{-- Price --}}
                <section class="px-5 py-5 border-b border-[#E2E8F0]">
                    <h3 class="text-xs font-black text-[#010348] mb-4">محدوده قیمت</h3>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="minPrice" class="block text-[10px] text-slate-400 mb-2">از قیمت</label>
                            <input id="minPrice"
                                   type="number"
                                   min="0"
                                   placeholder="حداقل"
                                   value="0"
                                   class="w-full min-w-0 bg-slate-50 border border-[#E2E8F0] rounded-xl px-3 py-3 text-xs text-[#010348] outline-none focus:border-[#0055AA] focus:ring-2 focus:ring-[#0055AA]/10 transition">
                        </div>

                        <div>
                            <label for="maxPrice" class="block text-[10px] text-slate-400 mb-2">تا قیمت</label>
                            <input id="maxPrice"
                                   type="number"
                                   min="0"
                                   placeholder="حداکثر"
                                   class="w-full min-w-0 bg-slate-50 border border-[#E2E8F0] rounded-xl px-3 py-3 text-xs text-[#010348] outline-none focus:border-[#0055AA] focus:ring-2 focus:ring-[#0055AA]/10 transition">
                        </div>
                    </div>

                    <p class="text-[10px] text-slate-400 mt-3">مبالغ بر اساس تومان محاسبه می‌شوند.</p>
                </section>

                {{-- Other filters --}}
                <section class="px-5 py-5 space-y-5">
                    <label class="flex items-center justify-between gap-3 cursor-pointer group">
                        <div>
                            <span class="block text-xs font-bold text-[#010348]">محصولات تخفیف‌دار</span>
                            <span class="block text-[10px] text-slate-400 mt-1">نمایش کالاهای دارای تخفیف</span>
                        </div>

                        <input id="hasDescount"
                               class="w-4 h-4 accent-[#0055AA] cursor-pointer"
                               type="checkbox">
                    </label>

                    <div class="h-px bg-[#E2E8F0]"></div>

                    <label class="flex items-center justify-between gap-3 cursor-pointer group">
                        <div>
                            <span class="block text-xs font-bold text-[#010348]">فقط کالاهای موجود</span>
                            <span class="block text-[10px] text-slate-400 mt-1">محصولات آماده ارسال</span>
                        </div>

                        <input id="exists"
                               class="w-4 h-4 accent-[#0055AA] cursor-pointer"
                               type="checkbox">
                    </label>
                </section>

                <div class="px-5 pb-5 md:hidden">
                    <button id="applyFilters"
                            type="button"
                            class="w-full bg-[#010348] hover:bg-[#0055AA] text-white rounded-xl py-3 text-xs font-bold transition">
                        نمایش محصولات
                    </button>
                </div>

            </aside>

            {{-- Products area --}}
            <section class="min-w-0">

                {{-- Toolbar --}}
                <div class="bg-white border border-[#E2E8F0] rounded-2xl p-3 md:px-5 mb-5">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-[#EAF2FF] text-[#0055AA] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M4 6h16M7 12h10m-7 6h4"/>
                                </svg>
                            </div>

                            <span class="text-xs font-bold text-[#010348]">مرتب‌سازی بر اساس</span>
                        </div>

                        <div class="flex items-center gap-1 overflow-x-auto max-w-full">
                            <button type="button"
                                    class="sort-btn whitespace-nowrap text-[11px] font-black text-[#0055AA] bg-[#EAF2FF] px-3 py-2 rounded-lg transition"
                                    data-sort-by="created_at"
                                    data-sort-type="desc">
                                جدیدترین
                            </button>

                            <button type="button"
                                    class="sort-btn whitespace-nowrap text-[11px] text-slate-500 hover:bg-slate-50 px-3 py-2 rounded-lg transition"
                                    data-sort-by="primary_price"
                                    data-sort-type="asc">
                                ارزان‌ترین
                            </button>

                            <button type="button"
                                    class="sort-btn whitespace-nowrap text-[11px] text-slate-500 hover:bg-slate-50 px-3 py-2 rounded-lg transition"
                                    data-sort-by="primary_price"
                                    data-sort-type="desc">
                                گران‌ترین
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Mobile filter button --}}
                <div id="chips" class="mb-4 md:hidden">
                    <button id="openFilters"
                            type="button"
                            class="flex items-center justify-center gap-2 w-full bg-white border border-[#E2E8F0] rounded-xl px-4 py-3 text-xs font-bold text-[#010348] hover:border-[#0055AA] transition">
                        <svg class="w-4 h-4 text-[#0055AA]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 7h16M7 12h10m-7 5h4"/>
                        </svg>
                        فیلتر و محدود کردن نتایج
                    </button>
                </div>

                {{-- Products --}}
                <div id="products"
                     class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">

                    @foreach ($products as $product)

                        <a href="{{ route('product.show', [$product->id]) }}"
                           class="product-card group relative min-w-0 bg-white border border-[#E2E8F0] rounded-2xl p-3 md:p-4 transition-all duration-300 hover:border-[#0055AA]/40 hover:shadow-[0_12px_35px_rgba(1,3,72,0.07)] hover:-translate-y-1">

                            {{-- Discount --}}
                            @if ($product->percent)
                                <span class="absolute top-3 right-3 z-10 bg-[#E5232E] text-white rounded-lg text-[10px] font-bold px-2 py-1 in-fa">
                                    {{ $product->percent }}٪ تخفیف
                                </span>
                            @endif

                            {{-- Image --}}
                            <div class="relative bg-[#F7F9FC] rounded-xl overflow-hidden mb-4">
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     alt="{{ $product->title }}"
                                     loading="lazy"
                                     class="w-full aspect-square object-contain p-3 transition-transform duration-500 group-hover:scale-105">

                                <div class="absolute bottom-2 left-2 w-7 h-7 rounded-lg bg-white/90 text-[#0055AA] flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M7 17 17 7M7 7h10v10"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Product title --}}
                            <h3 class="text-xs md:text-[13px] font-bold text-[#010348] leading-7 h-[54px] overflow-hidden line-clamp-2 group-hover:text-[#0055AA] transition">
                                {{ $product->title }}
                            </h3>

                            {{-- Price --}}
                            <div class="mt-4 pt-3 border-t border-dashed border-[#E2E8F0] min-h-[74px]">

                                @if ($product->secondary_price)
                                    <div class="flex items-center justify-between gap-1 mb-1">
                                        <span class="text-[10px] text-slate-400">قیمت فروش</span>
                                        <span class="text-[10px] text-slate-400 line-through in-fa">
                                            {{ $product->primary_price }}
                                        </span>
                                    </div>

                                    <div class="flex items-end justify-between gap-1">
                                        <strong class="text-sm md:text-base font-black text-[#010348] in-fa">
                                            {{ $product->secondary_price }}
                                        </strong>
                                        <span class="text-[10px] text-slate-500">تومان</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between gap-1 mb-1">
                                        <span class="text-[10px] text-slate-400">قیمت محصول</span>
                                    </div>

                                    <div class="flex items-end justify-between gap-1">
                                        <strong class="text-sm md:text-base font-black text-[#010348] in-fa">
                                            {{ $product->primary_price }}
                                        </strong>
                                        <span class="text-[10px] text-slate-500">تومان</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Stock --}}
                            <div class="flex items-center justify-between gap-2 mt-3 pt-3 border-t border-[#E2E8F0]">
                                @if ($product->count > 0)
                                    <span class="flex items-center gap-1.5 text-[10px] text-emerald-600 font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        موجود در انبار
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-[10px] text-red-500 font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        ناموجود
                                    </span>
                                @endif

                                <span class="text-[10px] text-[#0055AA] font-bold group-hover:translate-x-[-3px] transition">
                                    مشاهده
                                    <span class="text-sm">←</span>
                                </span>
                            </div>

                        </a>

                    @endforeach

                </div>

                {{-- Empty state --}}
                <div id="empty"
                     class="hidden bg-white border border-[#E2E8F0] rounded-2xl text-center px-5 py-16 md:py-24">

                    <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-[#EAF2FF] text-[#0055AA] flex items-center justify-center">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="10.5" cy="10.5" r="6.5"/>
                            <path d="m16 16 5 5M8 10.5h5"/>
                        </svg>
                    </div>

                    <h2 class="text-base font-black text-[#010348]">محصولی پیدا نشد</h2>

                    <p class="text-xs text-slate-400 mt-3 leading-7">
                        با این شرایط محصولی پیدا نکردیم. فیلترها را تغییر دهید و دوباره امتحان کنید.
                    </p>

                    <button type="button"
                            onclick="document.getElementById('resetFilters').click()"
                            class="mt-5 bg-[#010348] hover:bg-[#0055AA] text-white text-xs font-bold rounded-xl px-6 py-3 transition">
                        حذف فیلترها
                    </button>
                </div>

            </section>
        </div>
    </main>

    <script src="{{ asset('js/filters.js') }}"></script>
    <script src="{{ asset('js/filterStore.js') }}"></script>

@endsection
