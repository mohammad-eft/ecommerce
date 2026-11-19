@extends('admin.app.dashboard')
@section('title', 'دیارابزار | همه محصولات')
@section('content')

<style>
    /* Diyar Abzar | SaaS Product Management */
    #diyar-products {
        --diyar-navy: #010348;
        --diyar-blue: #0055AA;
        --diyar-blue-2: #0878D8;
        --diyar-sky: #EAF2FF;
        --diyar-red: #E5232E;
        --diyar-text: #17233f;
        --diyar-muted: #718096;
        --diyar-border: #e7edf5;
        --diyar-surface: #ffffff;
        --diyar-bg: #f5f8fd;
        direction: rtl;
        width: 100%;
        color: var(--diyar-text);
        font-family: inherit;
    }
    #diyar-products * { box-sizing: border-box; }
    #diyar-products .diyar-page-card {
        position: relative;
        background: var(--diyar-surface);
        border: 1px solid var(--diyar-border);
        border-radius: 22px;
        box-shadow: 0 12px 38px rgba(1, 3, 72, .055);
        overflow: hidden;
    }
    #diyar-products .diyar-page-title {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        min-height: 86px;
        margin: 0;
        padding: 22px 28px !important;
        text-align: right !important;
        color: #fff !important;
        font-size: 1.12rem !important;
        font-weight: 800 !important;
        letter-spacing: -.25px;
        border: 0;
        background: radial-gradient(circle at 8% 10%, rgba(0,127,255,.28), transparent 30%), linear-gradient(115deg, #010348 0%, #052b78 58%, #0055AA 100%);
    }
    #diyar-products .diyar-page-title::after {
        content: 'مدیریت و ویرایش کالاهای فروشگاه';
        display: block;
        margin-right: auto;
        color: rgba(255,255,255,.72);
        font-size: 11px;
        font-weight: 500;
    }
    #diyar-products .diyar-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 22px 26px 18px;
        margin: 0 !important;
    }
    #diyar-products .diyar-toolbar > div:first-child {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: #f7f9fd;
        border: 1px solid var(--diyar-border);
        border-radius: 12px;
    }
    #diyar-products .diyar-toolbar label {
        color: #475569 !important;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    #diyar-products input[type="checkbox"] { accent-color: var(--diyar-blue); cursor: pointer; }
    #diyar-products .diyar-toolbar .diyar-action-delete {
        min-width: 42px;
        min-height: 40px;
        padding: 10px !important;
        border-radius: 11px !important;
        box-shadow: 0 5px 14px rgba(229,35,46,.15);
    }
    #diyar-products .diyar-table-wrap {
        width: calc(100% - 40px) !important;
        margin: 0 20px 22px;
        overflow: auto;
        border: 1px solid var(--diyar-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(15, 35, 75, .035);
        scrollbar-width: thin;
        scrollbar-color: #c7d5e8 transparent;
    }
    #diyar-products .diyar-table-scroll {
        width: 100%;
        min-width: 850px !important;
        height: auto !important;
        max-height: 650px !important;
        overflow: auto;
    }
    #diyar-products .diyar-table-head {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f0f5ff !important;
        border-color: #e0e9f8 !important;
        box-shadow: 0 1px 0 #e1eaf7;
    }
    #diyar-products .diyar-table-head > div {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 54px;
        padding: 13px 8px !important;
        color: var(--diyar-navy) !important;
        background: transparent !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        white-space: nowrap;
    }
    #diyar-products .diyar-product-row {
        min-height: 92px;
        border-color: #edf1f7 !important;
        transition: background .18s ease, box-shadow .18s ease;
    }
    #diyar-products .diyar-product-row:hover {
        background: #f8faff;
        box-shadow: inset -3px 0 0 var(--diyar-blue);
    }
    #diyar-products .diyar-product-row > div {
        color: #334155 !important;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }
    #diyar-products .diyar-product-row img {
        width: 58px;
        height: 58px;
        border: 1px solid #e2eaf5;
        border-radius: 12px;
        background: #f8fafc;
        padding: 3px;
        object-fit: cover;
        box-shadow: 0 3px 8px rgba(1,3,72,.06);
    }
    #diyar-products .diyar-category-text {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 8px;
        color: var(--diyar-blue) !important;
        background: #edf4ff;
        font-size: 11px;
        line-height: 1.9;
    }
    #diyar-products button, #diyar-products a, #diyar-products [onclick] { transition: all .2s ease; }
    #diyar-products .diyar-action-view,
    #diyar-products .diyar-action-edit,
    #diyar-products .diyar-action-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px !important;
        box-shadow: 0 3px 9px rgba(15,35,75,.10);
    }
    #diyar-products .diyar-action-view { background: var(--diyar-blue) !important; }
    #diyar-products .diyar-action-view:hover { background: #003f86 !important; transform: translateY(-2px); }
    #diyar-products .diyar-action-edit { background: var(--diyar-navy) !important; }
    #diyar-products .diyar-action-edit:hover { background: #151b78 !important; transform: translateY(-2px); }
    #diyar-products .diyar-action-delete { background: var(--diyar-red) !important; }
    #diyar-products .diyar-action-delete:hover { background: #c71925 !important; transform: translateY(-2px); }

    /* Modals */
    #confirmDeletePopup, #editFormPopup { z-index: 1000 !important; }
    #diyar-products .diyar-modal-panel {
        border: 1px solid #dce6f4 !important;
        border-radius: 22px !important;
        color: var(--diyar-text) !important;
        background: #fff !important;
        box-shadow: 0 28px 90px rgba(1, 3, 72, .24);
        scrollbar-width: thin;
        scrollbar-color: #c7d5e8 transparent;
    }
    #diyar-products .diyar-modal-panel > div:first-child { margin-bottom: 10px; }
    #diyar-products .diyar-modal-panel label { color: var(--diyar-navy); font-size: 12px; font-weight: 750; }
    #diyar-products .diyar-modal-panel input:not([type="checkbox"]):not([type="file"]),
    #diyar-products .diyar-modal-panel textarea,
    #diyar-products .diyar-modal-panel select,
    #diyar-products .diyar-modal-panel input[type="file"] {
        width: 100%;
        border: 1px solid #dfe7f2;
        background: #f8faff !important;
        color: #172554;
        border-radius: 11px !important;
        padding: 11px 14px !important;
        outline: none;
        font-size: 12px;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }
    #diyar-products .diyar-modal-panel input:focus,
    #diyar-products .diyar-modal-panel textarea:focus,
    #diyar-products .diyar-modal-panel select:focus {
        border-color: var(--diyar-blue) !important;
        background: #fff !important;
        box-shadow: 0 0 0 3px rgba(0,85,170,.10);
    }
    #diyar-products .diyar-modal-panel textarea { resize: vertical; line-height: 2; }
    #diyar-products .diyar-modal-panel input[type="file"] { padding: 8px !important; }
    #diyar-products .diyar-primary-btn,
    #diyar-products .diyar-add-attribute {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(110deg, var(--diyar-navy), var(--diyar-blue)) !important;
        color: #fff !important;
        border: 0 !important;
        border-radius: 11px !important;
        font-weight: 750;
        box-shadow: 0 6px 16px rgba(0,85,170,.18);
    }
    #diyar-products .diyar-primary-btn:hover,
    #diyar-products .diyar-add-attribute:hover { filter: brightness(1.12); transform: translateY(-1px); }
    #diyar-products .diyar-danger-btn { background: var(--diyar-red) !important; color: #fff !important; border-radius: 11px !important; }
    #diyar-products .diyar-danger-btn:hover { background: #c71925 !important; }
    #diyar-products .diyar-modal-close { z-index: 3; }
    #diyar-products .diyar-modal-close span { background: var(--diyar-navy) !important; }
    #diyar-products .diyar-toggle:checked + span { background: var(--diyar-blue) !important; }
    #diyar-products .diyar-count-btn { background: var(--diyar-blue) !important; }
    #diyar-products #confirmDeletePopup .diyar-modal-panel p { font-size: 14px; line-height: 2.2; }
    #diyar-products #confirmDeleteProName { color: var(--diyar-red); }
    #diyar-products .diyar-toast {
        z-index: 1100;
        border: 1px solid #dbeafe;
        background: #eff6ff !important;
        color: var(--diyar-navy) !important;
        border-radius: 13px !important;
        box-shadow: 0 12px 30px rgba(1,3,72,.12);
    }
    #diyar-products .modal:not(.diyar-toast) { z-index: 1100; }
    #diyar-products .diyar-modal-panel .border-slate-300 { border-color: #e1e9f4 !important; }

    /* Product list: clean SaaS row cards */
    #diyar-products .diyar-products-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 2px 24px 26px;
    }
    #diyar-products .diyar-product-card {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
        padding: 15px 17px;
        border: 1px solid #e8edf5;
        border-radius: 17px;
        background: linear-gradient(110deg, #fff 0%, #fcfdff 100%);
        box-shadow: 0 3px 12px rgba(15, 35, 75, .025);
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease, background .2s ease;
    }
    #diyar-products .diyar-product-card:hover {
        border-color: #c9dcf5;
        background: #fff;
        box-shadow: 0 10px 25px rgba(1, 3, 72, .07);
        transform: translateY(-2px);
    }
    #diyar-products .diyar-product-select {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex: 0 0 34px;
    }
    #diyar-products .diyar-product-select input { width: 16px; height: 16px; }
    #diyar-products .diyar-row-number { color: #94a3b8; font-size: 10px; font-weight: 700; }
    #diyar-products .diyar-product-main {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
        min-width: 0;
    }
    #diyar-products .diyar-product-image-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 76px;
        width: 76px;
        height: 76px;
        padding: 5px;
        border: 1px solid #e8eef7;
        border-radius: 15px;
        background: #f7f9fd;
    }
    #diyar-products .diyar-product-image {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 10px;
        padding: 0;
        object-fit: contain;
        box-shadow: none;
    }
    #diyar-products .diyar-product-info { flex: 1; min-width: 0; }
    #diyar-products .diyar-product-title-line { display: flex; align-items: center; flex-wrap: wrap; gap: 9px; margin-bottom: 5px; }
    #diyar-products .diyar-product-title {
        margin: 0;
        color: var(--diyar-navy);
        font-size: 13px;
        font-weight: 850;
        line-height: 1.9;
    }
    #diyar-products .diyar-product-id {
        padding: 2px 8px;
        border: 1px solid #e5edfa;
        border-radius: 20px;
        background: #f4f7fd;
        color: #8291a8;
        direction: ltr;
        font-size: 9px;
        font-weight: 700;
    }
    #diyar-products .diyar-product-summary {
        display: -webkit-box;
        max-width: 760px;
        margin: 0 0 8px;
        overflow: hidden;
        color: #7b8799;
        font-size: 11px;
        line-height: 1.9;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    #diyar-products .diyar-product-categories { display: flex; flex-wrap: wrap; align-items: center; gap: 6px; }
    #diyar-products .diyar-category-chip {
        display: inline-flex;
        align-items: center;
        padding: 3px 9px;
        border: 1px solid #dceaff;
        border-radius: 7px;
        background: #f0f6ff;
        color: #0754a2;
        font-size: 9px;
        font-weight: 750;
    }
    #diyar-products .diyar-no-category { color: #a0aaba; font-size: 10px; }
    #diyar-products .diyar-product-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
        padding-right: 15px;
        border-right: 1px solid #edf1f7;
    }
    #diyar-products .diyar-list-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 9px;
        border: 0;
        border-radius: 11px;
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
    }
    #diyar-products .diyar-list-action svg { width: 16px; height: 16px; }
    #diyar-products .diyar-list-action:hover { transform: translateY(-2px); box-shadow: 0 5px 12px rgba(15,35,75,.13); }
    #diyar-products .diyar-list-view { background: #eaf3ff; color: #0754a2; }
    #diyar-products .diyar-list-view:hover { background: #d9eaff; }
    #diyar-products .diyar-list-edit { background: #eef0ff; color: #171b78; }
    #diyar-products .diyar-list-edit:hover { background: #dfe3ff; }
    #diyar-products .diyar-list-delete { background: #fff0f0; color: #dc2633; }
    #diyar-products .diyar-list-delete:hover { background: #ffe0e1; }
    #diyar-products .diyar-empty-state { padding: 55px 20px; text-align: center; color: #718096; }
    #diyar-products .diyar-empty-icon { display: inline-flex; align-items: center; justify-content: center; width: 62px; height: 62px; margin-bottom: 12px; border-radius: 20px; background: #eff5ff; font-size: 27px; }
    #diyar-products .diyar-empty-state h3 { margin: 0 0 5px; color: var(--diyar-navy); font-size: 14px; font-weight: 850; }
    #diyar-products .diyar-empty-state p { margin: 0; font-size: 11px; }

    @media (max-width: 767px) {
        #diyar-products .diyar-page-card { border-radius: 16px; }
        #diyar-products .diyar-page-title { min-height: 74px; padding: 17px 16px !important; font-size: 1rem !important; }
        #diyar-products .diyar-page-title::after { font-size: 9px; }
        #diyar-products .diyar-toolbar { padding: 15px 13px; }
        #diyar-products .diyar-table-wrap { width: calc(100% - 20px) !important; margin: 0 10px 14px; }
        #diyar-products .diyar-table-scroll { min-width: 800px !important; max-height: 65vh !important; }
        #diyar-products .diyar-modal-panel { width: 94% !important; max-height: 88dvh; overflow-y: auto; padding: 18px !important; }
        #diyar-products #editFormPopup .diyar-modal-panel { width: 96% !important; }
        #diyar-products #editForm .flex.flex-col.md\:flex-row { flex-direction: column; }
        #diyar-products #editForm .w-full.md\:w-2\/3,
        #diyar-products #editForm .w-full.md\:w-1\/3 { width: 100% !important; }
        #diyar-products .diyar-products-list { gap: 9px; padding: 0 10px 16px; }
        #diyar-products .diyar-product-card { align-items: flex-start; gap: 9px; padding: 12px 10px; border-radius: 14px; }
        #diyar-products .diyar-product-select { flex-basis: 23px; padding-top: 7px; }
        #diyar-products .diyar-product-main { align-items: flex-start; gap: 10px; }
        #diyar-products .diyar-product-image-wrap { flex-basis: 58px; width: 58px; height: 58px; border-radius: 12px; }
        #diyar-products .diyar-product-title { font-size: 11px; }
        #diyar-products .diyar-product-summary { font-size: 10px; -webkit-line-clamp: 2; }
        #diyar-products .diyar-product-actions { flex-direction: column; gap: 5px; padding-right: 8px; }
        #diyar-products .diyar-list-action { width: 30px; height: 30px; padding: 7px; border-radius: 9px; }
        #diyar-products .diyar-list-action svg { width: 14px; height: 14px; }
        #diyar-products .diyar-category-chip { font-size: 8px; padding: 2px 7px; }
    }
</style>

<div id="diyar-products" class="w-full">
@if (session('message'))
<div
    class="diyar-toast modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
    <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
</div>
@endif
<div class="w-full flex flex-col pb-4">
    <div class="diyar-page-card bg-white rounded-lg">
        <h2 class="diyar-page-title text-lg font-bold text-gray-800 p-4 text-center">لیست محصولات</h2>
        {{-- <form class="flex flex-col gap-5" action="{{ route('product.deleteAll') }}" method="post"> --}}
        {{-- @csrf --}}
        <div class="diyar-toolbar w-full flex flex-row justify-between items-center mb-5">
            <div class="flex flex-row items-center gap-3">
                <input type="checkbox" id="all" onchange="checkAll()">
                <label for="all" class="text-gray-700 text-xs">انتخاب همه</label>
            </div>
            <div class="flex justify-center">
                <button
                    class="w-fit flex flex-row items-center justify-center diyar-action-delete bg-red-500 hover:bg-red-600 p-1 rounded-sm cursor-pointer"
                    title="حذف">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                        <path fill="white"
                            d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="diyar-products-list">
            @php $i = 1; @endphp
            @forelse ($products as $product)
                <article class="diyar-product-card">
                    <div class="diyar-product-select">
                        <input type="checkbox" class="check" name="products[]" value="{{ $product->id }}" aria-label="انتخاب {{ $product->title }}">
                        <span class="diyar-row-number">{{ $i }}</span>
                    </div>

                    <div class="diyar-product-main">
                        <div class="diyar-product-image-wrap">
                            <img
                                src="{{ asset('storage/' . $product['mainImg']) }}"
                                alt="{{ $product->title }}"
                                class="diyar-product-image"
                                loading="lazy"
                            >
                        </div>
                        <div class="diyar-product-info">
                            <div class="diyar-product-title-line">
                                <h3 class="diyar-product-title">{{ $product->title }}</h3>
                                <span class="diyar-product-id">#{{ $product->id }}</span>
                            </div>
                            <p class="diyar-product-summary">
                                {{ $product->summary ?: 'برای این محصول توضیح کوتاهی ثبت نشده است.' }}
                            </p>
                            <div class="diyar-product-categories">
                                @forelse ($product['categories'] as $category)
                                    <span class="diyar-category-chip">{{ $category['title'] }}</span>
                                @empty
                                    <span class="diyar-no-category">بدون دسته‌بندی</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="diyar-product-actions">
                        <a href="{{ route('product.show', $product->id) }}" class="diyar-list-action diyar-list-view" title="مشاهده محصول" aria-label="مشاهده محصول">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" aria-hidden="true"><path fill="currentColor" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.5 368.8 480 288 480s-145.5-36.5-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/></svg>
                        </a>
                        <button type="button" onclick="editForm('open', {{ $product['id'] }})" class="diyar-list-action diyar-list-edit" title="ویرایش محصول" aria-label="ویرایش محصول">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true"><path fill="currentColor" d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                        </button>
                        <button type="button" onclick="deleteProduct('open', {{ $product['id'] }}, @js($product['title']))" class="diyar-list-action diyar-list-delete" title="حذف محصول" aria-label="حذف محصول">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-hidden="true"><path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80z"/></svg>
                        </button>
                    </div>
                </article>
                @php $i++; @endphp
            @empty
                <div class="diyar-empty-state">
                    <div class="diyar-empty-icon">📦</div>
                    <h3>هنوز محصولی ثبت نشده</h3>
                    <p>پس از افزودن محصولات، فهرست آن‌ها در این بخش نمایش داده می‌شود.</p>
                </div>
            @endforelse
        </div>
        {{-- </form> --}}
    </div>
</div>
{{-- start confirmDelete popup --}}
<div id="confirmDeletePopup"
    class="w-full h-dvh fixed top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
    <div class="size-full relative">
        <div class="size-full bg-black/40 absolute top-0 left-0" onclick="deleteProduct('close')"></div>
        <div
            class="w-11/12 md:w-1/2 xl:w-1/3 2xl:container 2xl:w-1/3 mx-auto diyar-modal-panel border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
            <div class="relative">
                <button class="diyar-modal-close absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                    onclick="deleteProduct('close')">
                    <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                    <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                </button>
            </div>
            <div class="">
                <p>آیا از حذف محصول <span id="confirmDeleteProName" class="font-bold"> </span> اطمینان دارید؟ </p>
                <div class="flex items-center justify-center gap-5 mt-10">
                    <a id="yes" class="diyar-primary-btn py-2 px-4 bg-green-200 text-green-500 rounded-xl shadow-lg">بله</a>
                    <span class="diyar-danger-btn py-2 px-4 bg-red-200 text-red-500 rounded-xl shadow-lg cursor-pointer"
                        onclick="deleteProduct('close')">خیر</span>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end confirmDelete popup --}}
{{-- start editForm popup --}}
@error('title')
<div
    class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
    <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
</div>
@enderror
@error('category_ids')
<div
    class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-30 right-10 z-5 flex justify-center items-center transition-all duration-300">
    <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
</div>
@enderror
<div id="editFormPopup" class="w-full h-dvh fixed top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
    <div class="size-full relative">
        <div class="size-full bg-black/40 absolute top-0 left-0" onclick="editForm('close')"></div>
        <div
            class="w-9/12 2xl:container 2xl:w-9/12 max-h-[calc(100vh-100px)] overflow-auto mx-auto diyar-modal-panel border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
            <div class="relative">
                <button class="diyar-modal-close absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                    onclick="editForm('close')">
                    <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                    <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                </button>
            </div>
            <div id="popupContent">
                <form action="{{ route('product.update') }}" method="post" id="editForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                        <div class="w-full md:w-2/3 space-y-8">
                            <div class="w-full flex flex-col">
                                <label for="title" class="mb-2 flex flex-row items-center">
                                    <span>نام محصول:</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input type="text"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="title" id="title" placeholder="نام محصول را وارد کنید">
                                @error('title')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col mt-5">
                                <label for="description" class="mb-2">توضیحات محصول:</label>
                                <textarea name="description" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                    id="editor" placeholder="توضیحات محصول را وارد کنید"></textarea>
                                @error('description')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col mt-5">
                                <label for="summary" class="mb-2">خلاصه محصول:</label>
                                <textarea class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                    placeholder="خلاصه" name="summary" id="summary"></textarea>
                                @error('summary')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col gap-3 mt-5">
                                <label for="category_ids" class="mb-2 flex flex-row items-center">
                                    <span>دسته بندی :</span>
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select name="category_ids[]" id="category_ids"
                                    class="w-full bg-[#F9F9F9] py-3 pr-5 rounded-[10px]" multiple size="1">
                                </select>
                                @error('category_ids')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col gap-5 mt-5">
                                <div class="" id="attributesContainer">

                                </div>
                                <button type="button" onclick="addAttribute(this,'edit')"
                                    class="w-30 mx-auto p-2 text-sm rounded-md diyar-primary-btn bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                    افزودن ویژگی +
                                </button>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 space-y-8">
                            <div class="w-full flex flex-col gap-6 mt-5">
                                <div class="flex items-center gap-4">
                                    <label for="show_in_home">نمایش در خانه :</label>
                                    <label for="show_in_home"
                                        class="w-[50px] h-[28px] flex rounded-full cursor-pointer relative">
                                        <input type="checkbox" name="show_in_home" value="1" id="show_in_home"
                                            hidden class="peer diyar-toggle">
                                        <span
                                            class="size-full bg-gray-300 shadow-inner rounded-full peer-checked:bg-[#1B84FF] transition-all duration-300"></span>
                                        <span
                                            class="size-[20px] rounded-full bg-white absolute top-1 left-1 peer-checked:translate-x-[22px] transition-all duration-300 shadow-md"></span>
                                    </label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <label class="mb-2"> تعداد :</label>
                                    <div class="flex">
                                        <div
                                            class="bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4] flex flex-row items-center">
                                            <button type="button"
                                                class="inline-block size-7 rounded-lg diyar-count-btn bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                                onclick="calculate('+')">+</button>
                                            <input type="number" min="1"
                                                class="outline-none w-14 text-center text-xs" name="count"
                                                id="count" dir="ltr">
                                            <button type="button"
                                                class="inline-block size-7 rounded-lg diyar-count-btn bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                                onclick="calculate('-')">-</button>
                                        </div>
                                    </div>
                                    <div class="relative group">
                                        <span
                                            class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">?</span>
                                        <span
                                            class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                                            اگر تعداد موجودی محصول زیاد بود نیازی نیست + را بزنید روی همان نوشته عددی موجودی دوبار کلیک کرده و عدد مورد نظر را بنویسید.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 lg:mt-5 flex flex-col">
                                <label for="mainImage" class="mb-2">عکس اصلی:</label>
                                <input type="file"
                                    class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="mainImage" id="mainImage">
                                <div id="mainImgContainer" class="relative mt-2 p-2 "></div>
                            </div>
                            <div class="w-full mt-3 lg:mt-5 flex flex-col">
                                <label for="gallery" class="mb-2">گالری تصاویر :</label>
                                <input type="file"
                                    class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="gallery[]" id="gallery" multiple>
                                <span class="text-xs text-red-500">حجم کل فایل ها نباید بیشتر از 500 کیلوبایت
                                    باشد.</span>
                                <div id="galleryContainer" class=" mt-2 p-2 flex items-center gap-3 overflow-auto">
                                </div>
                            </div>
                            <div class="w-full flex flex-col gap-3 md:gap-5 mt-3 lg:mt-5">
                                <div class="w-full flex flex-col gap-3">
                                    <label for="primary_price" class="flex items-center gap-2">
                                        <span>قیمت اصلی :</span>
                                        <div class="relative group">
                                            <span
                                                class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">?</span>
                                            <span
                                                class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">در
                                                صورتی که مایلید برای استعلام قیمت تماس گرفته شود این فیلد را خالی
                                                بگذارید.</span>
                                        </div>
                                    </label>
                                    <input type="number"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        name="primary_price" id="primary_price">
                                </div>
                                <div class="w-full flex flex-col gap-3">
                                    <label for="secondary_price"> قیمت ویژه :</label>
                                    <input type="number"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        name="secondary_price" id="secondary_price">
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button type="submit"
                                    class="py-3 px-10 rounded-[10px] diyar-primary-btn bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end editForm popup --}}
<script src="{{ asset('js/product.js') }}"></script>
<script>
    function editForm(state, id) {
        let editFormPopup = document.getElementById('editFormPopup')
        if (state == 'open') {
            let product_id = document.getElementById('product_id')
            let title = document.getElementById('title')
            let editor = document.getElementById('editor')
            let summary = document.getElementById('summary')
            let show_in_home = document.getElementById('show_in_home')
            let count = document.getElementById('count')
            let mainImgContainer = document.getElementById('mainImgContainer')
            let galleryContainer = document.getElementById('galleryContainer')
            let primary_price = document.getElementById('primary_price')
            let secondary_price = document.getElementById('secondary_price')
            let category_ids = document.getElementById('category_ids')
            let attributesContainer = document.getElementById('attributesContainer')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            $.ajax({
                url: "{{ route('product.edit') }}",
                type: "POST",
                dataType: "json",
                data: {
                    'id': id,
                },
                success: function(data) {
                    product_id.value = data['product'].id
                    title.value = data['product'].title
                    editor.value = data['product'].description
                    summary.value = data['product'].summary
                    count.value = data['product'].count
                    primary_price.value = data['product'].primary_price
                    secondary_price.value = data['product'].secondary_price
                    mainImgContainer.innerHTML = ''
                    galleryContainer.innerHTML = ''
                    data['product'].media.forEach(media => {
                        if (media.is_main) {
                            let div = document.createElement('div')
                            div.innerHTML = `
                                    <img src="${media['media_path']}" class="w-35 h-20 rounded-lg">
                                    <span class="absolute top-0 left-5 cursor-pointer" onclick="removeImg(this, '${media['media_path']}', 'mainImg')">❌</span>
                                    `
                            mainImgContainer.appendChild(div)
                        } else {
                            let div = document.createElement('div')
                            div.classList = 'relative'
                            div.innerHTML = `
                                    <img src="${media['media_path']}" class="min-w-35 h-20 rounded-lg">
                                    <span class="absolute top-0 left-0 cursor-pointer" onclick="removeImg(this, '${media['media_path']}', 'gallery')">❌</span>
                                    `
                            galleryContainer.appendChild(div)
                        }
                    })
                    show_in_home.checked = Boolean(data.product.show_in_home)
                    category_ids.innerHTML = ''
                    data['cats'].forEach(category => {
                        let option = document.createElement('option')
                        option.value = category.id
                        option.innerText = category.title
                        if (data.catIds.includes(category.id)) {
                            option.setAttribute('selected', true)
                        }
                        category_ids.appendChild(option)
                    });
                    attributesContainer.innerHTML = ''
                    data['product'].attributes.forEach(attribute => {
                        let div = document.createElement('div');
                        div.classList =
                            'flex flex-row items-center justify-between gap-4 mt-4 border border-slate-300 rounded-xl p-2'
                        div.innerHTML = `
                                            <div class="w-full flex flex-col sm:flex-row items-center gap-4">
                                                <input type="text"
                                                    class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                                    placeholder="ویژگی" name="attributes[oldAttrs][attribute_key][${attribute.id}]" required value="${attribute.attribute_key}">
                                                <input type="text"
                                                    class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                                    placeholder="مقدار ویژگی" name="attributes[oldAttrs][attribute_value][${attribute.id}]" required value="${attribute.attribute_value}">
                                            </div>
                                            <button type="button"
                                                class="p-3 text-sm rounded-md diyar-danger-btn bg-rose-500 hover:bg-rose-600 text-white cursor-pointer"
                                                onclick="remove(this, ${attribute.id})">حذف</button>
                                            `
                        attributesContainer.appendChild(div)
                    })
                },
                error: function() {
                    alert('error')
                }
            })
            editFormPopup.classList.remove('invisible', 'opacity-0')
        }
        if (state == 'close') {
            editFormPopup.classList.add('invisible', 'opacity-0')
        }
    }

    function removeImg(el, file, type) {
        let editForm = document.getElementById('editForm')
        let index = file.indexOf('productImgs')
        let result = file.slice(index)
        if (type == 'mainImg') {
            let input = document.createElement('input')
            input.setAttribute("type", 'hidden')
            input.setAttribute("name", "removedImgs[mainImg]")
            input.setAttribute("value", result)
            editForm.appendChild(input)
        }
        if (type == 'gallery') {
            let input = document.createElement('input')
            input.setAttribute("type", 'hidden')
            input.setAttribute("name", "removedImgs[gallery][]")
            input.setAttribute("value", result)
            editForm.appendChild(input)
        }
        el.parentElement.remove()
    }

    function deleteProduct(state, id, proTitle) {
        let confirmDeletePopup = document.getElementById('confirmDeletePopup')
        if (state == 'open') {
            let yes = document.getElementById('yes')
            yes.setAttribute('href', `{{ url('product/delete') }}/${id}`)
            let confirmDeleteProName = document.getElementById('confirmDeleteProName')
            confirmDeleteProName.innerText = proTitle
            confirmDeletePopup.classList.remove('invisible', 'opacity-0')
        }
        if (state == 'close') {
            confirmDeletePopup.classList.add('invisible', 'opacity-0')
        }
    }

    function calculate(state) {
        let count = document.getElementById('count')
        if (state == "+") {
            count.value++
        }
        if (count.value > 1) {
            if (state == "-") {
                count.value--
            }
        }
    }
</script>
<script src="{{ url('assets/js/attribute.js') }}"></script>
<script src="{{ asset('assets/js/checkAll.js') }}"></script>
</div>
@endsection