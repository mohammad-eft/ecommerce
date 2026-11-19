@extends('admin.app.dashboard')
@section('title', 'دیارابزار | ایجاد محصول')
@section('content')

<style>
    #diyar-create {
        --navy: #010348;
        --blue: #0055AA;
        --blue-light: #EAF2FF;
        --blue-soft: #F5F8FF;
        --red: #E5232E;
        --muted: #64748b;
        --border: #E5EAF2;
        color: #172554;
    }

    #diyar-create .create-heading {
        background: linear-gradient(115deg, #010348 0%, #003D86 58%, #0876D1 100%);
        border-radius: 22px;
        padding: 25px 28px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 14px 34px rgba(1, 3, 72, .15);
    }
    #diyar-create .create-heading::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border: 34px solid rgba(255,255,255,.07);
        border-radius: 50%;
        left: -65px;
        top: -125px;
        pointer-events: none;
    }
    #diyar-create .create-heading h2 {
        color: #fff;
        font-size: 1.35rem;
        font-weight: 800;
        margin: 0;
    }
    #diyar-create .create-heading p {
        color: rgba(255,255,255,.75);
        font-size: .82rem;
        margin-top: 7px;
    }
    #diyar-create .create-form-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 26px;
        box-shadow: 0 10px 32px rgba(1, 3, 72, .055);
    }
    #diyar-create .form-section {
        background: #fff;
        border: 1px solid #E9EEF6;
        border-radius: 17px;
        padding: 20px;
        min-width: 0;
    }
    #diyar-create .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--navy);
        font-size: .95rem;
        font-weight: 800;
        margin-bottom: 20px;
        padding-bottom: 13px;
        border-bottom: 1px solid #EEF2F8;
    }
    #diyar-create .section-title::before {
        content: "";
        width: 4px;
        height: 19px;
        border-radius: 8px;
        background: linear-gradient(180deg, var(--blue), #38A1F5);
    }
    #diyar-create label {
        color: #26365B;
        font-size: .84rem;
        font-weight: 700;
    }
    #diyar-create input:not([type="checkbox"]):not([type="file"]),
    #diyar-create textarea,
    #diyar-create select {
        width: 100%;
        border: 1px solid #DFE7F2 !important;
        background: #F8FAFE !important;
        color: #172554;
        border-radius: 11px !important;
        padding: 12px 14px !important;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        font-size: .86rem;
    }
    #diyar-create input:not([type="checkbox"]):not([type="file"]):focus,
    #diyar-create textarea:focus,
    #diyar-create select:focus {
        border-color: var(--blue) !important;
        background: #fff !important;
        box-shadow: 0 0 0 3px rgba(0,85,170,.10);
    }
    #diyar-create textarea { resize: vertical; min-height: 105px; line-height: 1.9; }
    #diyar-create input[type="file"] {
        width: 100%;
        border: 1px dashed #B8CBE5;
        background: #F7FAFF;
        border-radius: 12px;
        padding: 12px;
        color: #52627D;
        font-size: .78rem;
    }
    #diyar-create input[type="file"]::file-selector-button {
        border: 0;
        border-radius: 8px;
        padding: 8px 12px;
        margin-left: 10px;
        background: var(--blue-light);
        color: var(--navy);
        font-weight: 700;
        cursor: pointer;
    }
    #diyar-create .field-group { display: flex; flex-direction: column; gap: 9px; margin-top: 19px; }
    #diyar-create .field-group:first-child { margin-top: 0; }
    #diyar-create .field-hint { color: var(--muted); font-size: .72rem; line-height: 1.8; }
    #diyar-create .error-text { color: var(--red); font-size: .74rem; margin-top: 3px; }
    #diyar-create .diyar-primary-btn {
        border: 0;
        border-radius: 11px;
        background: linear-gradient(110deg, var(--navy), var(--blue));
        color: #fff;
        font-weight: 800;
        padding: 12px 22px;
        box-shadow: 0 7px 18px rgba(0,85,170,.19);
        transition: transform .2s, filter .2s, box-shadow .2s;
        cursor: pointer;
    }
    #diyar-create .diyar-primary-btn:hover {
        filter: brightness(1.12);
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(0,85,170,.24);
    }
    #diyar-create .diyar-secondary-btn {
        border: 1px solid #C9DDF5;
        border-radius: 10px;
        color: var(--blue);
        background: var(--blue-light);
        font-weight: 700;
        padding: 9px 15px;
        cursor: pointer;
        transition: .2s;
    }
    #diyar-create .diyar-secondary-btn:hover { background: #DCEBFF; }
    #diyar-create .quantity-control {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F4F7FC;
        border: 1px solid #E3EAF4;
        border-radius: 12px;
        padding: 5px;
    }
    #diyar-create .quantity-control input {
        width: 65px !important;
        border: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        text-align: center;
        padding: 7px !important;
        font-weight: 800;
    }
    #diyar-create .quantity-control button {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: var(--blue);
        color: #fff;
        font-weight: 800;
        cursor: pointer;
    }
    #diyar-create .switch-track { background: #CBD5E1; }
    #diyar-create input.peer:checked + .switch-track { background: var(--blue); }
    #diyar-create .modal {
        z-index: 100;
        border: 1px solid #D9E7F8;
        background: #F1F7FF;
        color: var(--navy);
    }
    #diyar-create #attributesContainer,
    #diyar-create .attributes-container { display: flex; flex-direction: column; gap: 12px; }
    #diyar-create .attributes-container:empty { display: none; }
    @media (max-width: 767px) {
        #diyar-create .create-heading { padding: 20px; border-radius: 17px; }
        #diyar-create .create-form-card { padding: 13px; border-radius: 17px; }
        #diyar-create .form-section { padding: 15px; }
        #diyar-create .create-heading h2 { font-size: 1.1rem; }
    }
</style>

<div id="diyar-create" class="w-full pb-10">
    @if (session('message'))
        <div class="modal py-4 px-6 rounded-xl shadow-lg fixed top-10 right-10 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <div class="create-heading mb-6">
        <div class="relative z-10">
            <h2>ایجاد محصول جدید</h2>
            <p>اطلاعات محصول، تصاویر، ویژگی‌ها و قیمت‌گذاری را در این بخش ثبت کنید.</p>
        </div>
    </div>

    <div class="create-form-card">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col lg:flex-row gap-5">
                <div class="w-full lg:w-2/3">
                    <section class="form-section h-full">
                        <h3 class="section-title">اطلاعات اصلی محصول</h3>

                        <div class="field-group">
                            <label for="title">نام محصول <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" placeholder="مثلاً دریل شارژی ۲۰ ولت"
                                value="{{ old('title') }}">
                            @error('title') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <label for="summary">خلاصه محصول</label>
                            <textarea name="summary" id="summary" rows="3" placeholder="یک معرفی کوتاه و کاربردی از محصول بنویسید">{{ old('summary') }}</textarea>
                            @error('summary') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <label for="editor">توضیحات محصول</label>
                            <textarea name="description" id="editor" rows="5" placeholder="توضیحات کامل محصول را وارد کنید">{!! old('description') !!}</textarea>
                            @error('description') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <label for="category_ids">دسته‌بندی‌ها </label>
                            <select name="category_ids[]" id="category_ids" multiple size="1">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (in_array($category->id, old('category_ids', []))) selected @endif>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="field-hint">برای انتخاب چند دسته‌بندی، کلید Ctrl (در ویندوز) را نگه دارید.</span>
                            @error('category_ids') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <div id="attributesContainer" class="attributes-container"></div>
                            <button type="button" onclick="addAttribute(this, 'create')" class="diyar-secondary-btn w-fit mx-auto">
                                افزودن ویژگی محصول <span class="mr-1">＋</span>
                            </button>
                        </div>
                    </section>
                </div>

                <div class="w-full lg:w-1/3 flex flex-col gap-5">
                    <section class="form-section">
                        <h3 class="section-title">تنظیمات موجودی و نمایش</h3>

                        <div class="flex items-center justify-between gap-3">
                            <label for="show_in_home">نمایش در صفحه اصلی</label>
                            <label for="show_in_home" class="w-[50px] h-[28px] flex rounded-full cursor-pointer relative">
                                <input type="checkbox" name="show_in_home" value="1" id="show_in_home" hidden
                                    class="peer" @if (old('show_in_home')) checked @endif>
                                <span class="switch-track size-full shadow-inner rounded-full transition-all duration-300"></span>
                                <span class="size-[20px] rounded-full bg-white absolute top-1 left-1 peer-checked:translate-x-[22px] transition-all duration-300 shadow-md"></span>
                            </label>
                        </div>

                        <div class="field-group">
                            <label for="count">تعداد موجودی</label>
                            <div class="quantity-control w-fit">
                                <button type="button" onclick="calculate('+')" aria-label="افزایش تعداد">+</button>
                                <input type="number" min="1" value="{{ old('count', 1) }}" name="count" id="count" dir="ltr">
                                <button type="button" onclick="calculate('-')" aria-label="کاهش تعداد">−</button>
                            </div>
                            <span class="field-hint">برای وارد کردن تعداد دلخواه، عدد داخل کادر را مستقیم ویرایش کنید.</span>
                        </div>
                    </section>

                    <section class="form-section">
                        <h3 class="section-title">تصاویر محصول</h3>
                        <div class="field-group">
                            <label for="mainImage">تصویر اصلی</label>
                            <input type="file" name="mainImage" id="mainImage" accept="image/*">
                            @error('mainImage') <span class="error-text">{{ $message }}</span> @enderror
                        </div>
                        <div class="field-group">
                            <label for="gallery">گالری تصاویر</label>
                            <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                            <span class="field-hint">حجم کل فایل‌ها نباید بیشتر از ۵۰۰ کیلوبایت باشد.</span>
                            @error('gallery') <span class="error-text">{{ $message }}</span> @enderror
                        </div>
                    </section>

                    <section class="form-section">
                        <h3 class="section-title">قیمت‌گذاری</h3>
                        <div class="field-group">
                            <label for="primary_price">قیمت اصلی</label>
                            <input type="number" name="primary_price" id="primary_price" min="0"
                                value="{{ old('primary_price') }}" placeholder="قیمت به تومان">
                            <span class="field-hint">برای محصولاتی که نیاز به استعلام قیمت دارند، این فیلد را خالی بگذارید.</span>
                        </div>
                        <div class="field-group">
                            <label for="secondary_price">قیمت ویژه</label>
                            <input type="number" name="secondary_price" id="secondary_price" min="0"
                                value="{{ old('secondary_price') }}" placeholder="در صورت داشتن تخفیف">
                        </div>
                    </section>

                    <button type="submit" class="diyar-primary-btn w-full py-4">
                        ثبت محصول و ذخیره اطلاعات
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ url('js/attribute.js') }}"></script>
<script src="{{ url('js/product.js') }}"></script>
@endsection
