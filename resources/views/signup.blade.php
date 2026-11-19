<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('icon/faveicon.png') }}">
    <title>ثبت نام | دیارابزار</title>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <style>
        :root {
            --brand-navy: #010348;
            --brand-blue: #0055aa;
            --brand-light-blue: #007fff;
            --brand-red: #ff0000;
            --brand-soft: #eef3ff;
        }

        body {
            background: #f5f7fc;
            color: #172033;
        }

        input {
            transition: all .25s ease;
            color: #172033 !important;
        }

        input::placeholder {
            color: #94a3b8 !important;
            opacity: 1;
        }

        input:focus {
            border-color: var(--brand-light-blue) !important;
            box-shadow: 0 0 0 3px rgba(0, 127, 255, .12) !important;
            outline: none !important;
        }

        input:focus::placeholder { color: #94a3b8 !important; }

        input:focus + span svg,
        .group:focus-within span svg { color: var(--brand-blue) !important; }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-background-clip: text;
            -webkit-text-fill-color: #172033 !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 20px 20px #f8faff !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn { animation: fadeIn .8s ease-out; }

        .bg-brand-gradient {
            background:
                radial-gradient(circle at 18% 18%, rgba(0,127,255,.32), transparent 30%),
                radial-gradient(circle at 82% 82%, rgba(255,0,0,.20), transparent 28%),
                linear-gradient(135deg, #010348 0%, #07145c 48%, #0055aa 100%);
        }

        .btn-brand {
            background: linear-gradient(110deg, #010348 0%, #0055aa 58%, #007fff 100%);
            transition: all .25s ease;
        }

        .btn-brand:hover {
            background: linear-gradient(110deg, #010348 0%, #00458f 58%, #006de0 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 22px -7px rgba(0, 85, 170, .32);
        }

        .btn-brand:disabled {
            background: #94a3b8 !important;
            transform: none;
            box-shadow: none;
            cursor: not-allowed;
        }

        .footer-brand {
            background: linear-gradient(90deg, #010348, #0055aa, #010348);
        }

        .closeButtonXmark:hover svg path { fill: var(--brand-red) !important; }

        #rules > div {
            max-width: calc(100% - 24px);
        }

        #signupButton { border: 0; }

        @media (max-width: 767px) {
            body { min-height: 100dvh; }
            #rules > div {
                width: calc(100% - 24px);
                height: calc(100dvh - 40px);
                margin-top: 20px;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#eef3ff] to-white">
    <div class="absolute -top-5 invisible opacity-0 right-1/2 translate-x-1/2 w-2/3 z-999999 transition-all duration-500 ease-in-out" id="message"></div>
    <div class="w-full min-h-dvh flex flex-col justify-start items-center md:flex-row-reverse">
        <!-- بخش راست با تم بنفش -->
                <div class="flex justify-center max-sm:h-30 max-md:h-35 md:h-dvh bg-brand-gradient relative overflow-hidden w-full lg:w-1/2">
            <!-- المان‌های تزئینی -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-60 h-60 bg-[#007fff]/30 rounded-full blur-3xl"></div>
            </div>
            <div class="flex flex-col my-12 items-center justify-center relative z-10 w-full">
                <div class="w-full flex flex-row justify-center items-center animate-fadeIn">
                    <div class="text-center">
                        <h2 class="text-center font-bold text-white text-5xl mb-2 drop-shadow-lg">دیارابزار</h2>
                        <div class="w-20 h-1 bg-gradient-to-l from-[#ff0000] via-white to-[#007fff] mx-auto rounded-full"></div>
                        <p class="text-white/80 text-sm">فروشگاه تخصصی ابزار</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- بخش فرم ثبت نام -->
        <div class="w-full min-h-dvh bg-white flex justify-center items-center px-4 py-8 md:px-5 lg:w-1/2">
            <div class="flex flex-col items-center justify-center w-full animate-fadeIn">
        
                <h1 class="md:text-2xl font-bold text-gray-800 text-base">ثبت نام  </h1>
                <p class="text-gray-500 text-sm mb-4">برای ایجاد حساب اطلاعات زیر را وارد کنید</p>
                
                <div class="w-10/12 md:w-1/2 mx-auto flex flex-col">
                    <form action="{{ route('user.store') }}"
                        class="w-full flex flex-col items-center my-2 gap-3 md:gap-4" method="post" id="signupForm">
                        @csrf
                        <!-- فیلد شماره تلفن -->
                        <div class="relative w-full group @error('phoneNumber') mb-5 @enderror">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#07145c] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </span>
                            <input type="number" min="0"
                                class="w-full pr-10 pl-4 py-3 rounded-xl border-2 @error('phoneNumber') border-red-500 @enderror border-gray-200 focus:border-[#007fff] focus:ring-0 focus:outline-none transition-all duration-300 hover:border-[#c7d7f5] bg-gray-50/50"
                                name="phoneNumber" 
                                id="phoneNumber"
                                placeholder="شماره تلفن" value="{{ old('phoneNumber') }}" required>
                            @error('phoneNumber')
                              <span class="text-red-500 text-sm absolute bg-white right-3 -bottom-6">{{ $message }}</span>  
                            @enderror
                        </div>
                        <!-- فیلد کلمه عبور -->
                        <div class="relative w-full group @error('password') mb-5 @enderror">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#07145c] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </span>
                            <input type="password"
                                class="w-full pr-10 pl-4 py-3 rounded-xl border-2 @error('password') border-red-500 @enderror border-gray-200 focus:border-[#007fff] focus:ring-0 focus:outline-none transition-all duration-300 hover:border-[#c7d7f5] bg-gray-50/50"
                                name="password" id="password" placeholder="کلمه عبور" required value="{{ old('password') }}">
                            @error('password')
                              <span class="text-red-500 text-sm absolute bg-white right-3 -bottom-6">{{ $message }}</span>  
                            @enderror
                        </div>
                        <div class="relative w-full group @error('password') mb-5 @enderror flex gap-3">
                            <div class="w-3/4">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#07145c] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </span>
                                <input type="number"
                                    class="w-full pr-10 pl-4 py-3 rounded-xl border-2 @error('code') border-red-500 @enderror border-gray-200 focus:border-[#007fff] focus:ring-0 focus:outline-none transition-all duration-300 hover:border-[#c7d7f5] bg-gray-50/50"
                                    name="code" id="code" placeholder="کد ارسال شده" required value="{{ old('code') }}">
                                @error('code')
                                  <span class="text-red-500 text-sm absolute bg-white right-3 -bottom-6">{{ $message }}</span>  
                                @enderror
                            </div>
                            <button type="button" id="countDown" class="w-1/4 text-sm rounded-xl bg-(--brand-red) text-white cursor-pointer" onclick="sendCode(this)">ارسال کد</button>
                        </div>
                        
                        <!-- چک‌باکس قوانین -->
                        <div class="w-full flex gap-3 items-center mt-2 p-3 bg-[#eef3ff] rounded-xl border border-[#c7d7f5]">
                            <input type="checkbox" name="rules" value="1" class="w-5 h-5 rounded border-gray-300 text-[#07145c] focus:ring-[#007fff]/20"
                                onchange="checkRule()" id="rule">
                            <label for="rule" class="text-sm text-gray-600 cursor-pointer">
                                <span>قوانین و مقررات را </span>
                                <span class="text-[#07145c] font-semibold hover:text-[#0055aa] cursor-pointer transition-colors" onclick="rules('open')">مطالعه</span>
                                <span> کردم و می‌پذیرم</span>
                            </label>
                        </div>
                        
                        <!-- modal قوانین -->
                        <div class="fixed w-full h-dvh bg-black/50 top-0 right-0 opacity-0 invisible transition-all duration-500 backdrop-blur-xs z-50"
                            id="rules">
                            <div
                                class="w-2/3 h-5/6 lg:h-2/3 bg-white mx-auto mt-10 lg:mt-20 rounded-2xl transition-all duration-300 delay-200 opacity-0 scale-75 relative shadow-2xl border-2 border-[#c7d7f5]">
                                <div
                                    class="w-full py-4 text-center text-lg font-bold sticky top-0 right-0 bg-gradient-to-l from-[#010348] to-[#0055aa] text-white rounded-t-2xl">
                                    قوانین و مقررات
                                </div>
                                <div class="h-5/6 overflow-y-auto px-5 py-3"
                                    style="scrollbar-width: thin; scrollbar-color: #07145c #e8edff;">
                                    <p class="p-5 text-justify text-xs leading-loose lg:text-base text-gray-700">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود
                                        ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده،
                                        شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                                        طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد،
                                        در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط
                                        سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی
                                        سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                    </p>
                                </div>
                                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                                    <span
                                        class="px-6 py-2 bg-[#0055aa] hover:bg-[#010348] text-white rounded-xl cursor-pointer transition-all duration-300 shadow-lg shadow-[#07145c]/15 text-sm font-medium"
                                        onclick="rules('close')">متوجه شدم</span>
                                </div>
                                <span
                                    class="absolute p-2 border border-gray-200 rounded-full bg-white text-gray-400 hover:text-[#07145c] cursor-pointer top-3 left-3 transition-all duration-300 hover:border-[#007fff] shadow-md closeButtonXmark"
                                    onclick="rules('close')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 384 512">
                                        <path fill="currentColor"
                                            d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <!-- rules end -->
                        
                        <!-- دکمه ثبت نام -->
                        <button type="submit"
                            class="btn-brand w-full text-center text-white p-3.5 rounded-xl font-medium text-lg mt-4 cursor-pointer shadow-lg shadow-[#07145c]/15 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="signupButton" disabled onclick="checkAuth(event)">
                            ثبت نام
                        </button>
                        
                        <!-- لینک ورود -->
                        <div class="w-full text-center mt-2">
                            <span class="text-sm text-gray-600">
                                قبلاً ثبت نام کرده‌اید؟
                                <a href="{{ route('login') }}" class="text-[#07145c] font-semibold hover:text-[#0055aa] transition-colors mr-1">
                                    وارد شوید
                                </a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed w-full h-dvh top-0 right-0 bg-black/50 transition-all duration-300 flex justify-center items-center invisible opacity-0"
        id="loader">
        <div class="w-11/12 lg:w-1/3 p-5 rounded-xl bg-white flex flex-col items-center justify-center gap-4 lg:gap-8">
            <div class="size-16 rounded-full border-4 border-[#07145c] border-t-4 border-t-white animate-spin"></div>
            <span class="lg:text-lg font-bold text-[#07145c]">لطفا شکیبا باشید ...</span>
        </div>
    </div>

    <!-- فوتر موبایل -->
    <footer class="md:hidden">
        <div class="footer-brand w-full h-12 absolute bottom-0 flex flex-row gap-4 justify-center items-center text-white shadow-lg">
            <div class="flex items-center gap-2">
                <span class="text-sm">دیارابزار</span>
            </div>
            <a href="tel:09142302912" class="text-sm hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <b>09142302912</b>
            </a>
        </div>
    </footer>

    <!-- فوتر دسکتاپ -->
    <div class="hidden md:block fixed bottom-4 left-4">
        <a href="tel:09142302912" class="flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-lg hover:shadow-xl transition-shadow border border-[#dbe6f8]">
            <div class="w-8 h-8 bg-[#eef3ff] rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-[#07145c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </div>
            <span class="text-gray-700 font-medium">09142302912</span>
        </a>
    </div>

    <script>
        let link = "{{ url('/') }}/"
        let message = document.getElementById('message')
        let phoneNumber = document.getElementById('phoneNumber')
        let password = document.getElementById('password')
        let signupForm = document.getElementById('signupForm')
        let code = document.getElementById('code')
        let countDown = document.getElementById('countDown')
        function loader(status) {
            if (status === 'open') {
                document.getElementById('loader').classList.remove('invisible', 'opacity-0')
            }
            if (status === 'close') {
                document.getElementById('loader').classList.add('invisible', 'opacity-0')
            }
        }
        function checkAuth(e) {
            e.preventDefault()
            if(phoneNumber.value == '' || password.value == '' || code.value == ''){
                openMessage('پر کردن همه فیلد ها الزامی است')
                setTimeout(function(){
                    closeMessage()
                }, 2000)
            } else {
                loader('open')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                $.ajax({
                    url: "{{ route('checkAuth') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phoneNumber': phoneNumber.value,
                        // 'code': code.value
                    },
                    success: function(data){
                        loader('close')
                        if(data.flag){
                            // openMessage('کد وارد شده نامعتبر')
                            openMessage('کد وارد شده نامعتبر')
                            setTimeout(function(){
                                closeMessage()
                            }, 2000)
                        } else {
                            if (data.user) {
                                openMessage('شما قبلا با این شماره ثبت نام کرده اید')
                                setTimeout(function(){
                                    closeMessage()
                                }, 2000)
                                location.assign("{{ route('login') }}")
                            } else {
                                signupForm.submit()
                            }
                        }
                    },
                    error: function(){
                        openMessage('خطا در دریافت اطلاعات')
                        setTimeout(function(){
                            closeMessage()
                        }, 2000)
                    }
                })
            }
        }
        function sendCode(el){
            el.innerHTML = "<div class='size-8 mx-auto border-2 border-white border-t-[#ff0000]/0 rounded-full animate-spin'></div>"
            if(phoneNumber.value == '' || password.value == ''){
                openMessage('پر کردن همه فیلد ها الزامی است')
                setTimeout(function(){
                    closeMessage()
                }, 2000)
                el.innerHTML = 'ارسال کد'
            } else {
                
                $.ajax({
                    url: link+"api/sendCode",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phoneNumber': phoneNumber.value
                    },
                    success: function(response){
                        el.innerHTML = 'ارسال کد'
                        console.log('response')
                        console.log(response)
                        console.log(el)
                        if(!response){
                            openMessage('شما قبلا با این شماره ثبت نام کرده اید')
                            setTimeout(function(){
                                closeMessage()
                            }, 2000)
                        } else {
                            counter()
                        }
                    },
                    error: function(){
                        openMessage('خطا در دریافت اطلاعات')
                        setTimeout(function(){
                            closeMessage()
                        }, 2000)
                    }
                })
            }
        }
        function counter() {
            let phoneNumber = document.getElementById('phoneNumber')
            countDown.classList.add('cursor-no-drop')
            countDown.classList.remove('cursor-pointer')
            countDown.classList.remove('hover:bg-[#eef3ff]0')
            countDown.classList.add('hover:bg-[#eef3ff]0/50')
            countDown.classList.remove('bg-[#eef3ff]0')
            countDown.classList.add('bg-[#eef3ff]0/50')
            countDown.setAttribute('disabled', true)
            countDown.setAttribute('dir', 'ltr')
            let count = 120
            let result = setInterval(() => {
                let minute = Math.floor(count / 60)
                let seconds = count % 60
                count -= 1
                if (count < 0) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    })
                    $.ajax({
                        url: link+'api/removeActivationCode',
                        type: "POST",
                        dataType: "json",
                        data: {
                            'phoneNumber': phoneNumber.value
                        },
                        success: function(data) {
                            console.log(data)
                            countDown.classList.remove('cursor-no-drop')
                            countDown.classList.add('bg-[#eef3ff]0')
                            countDown.classList.remove('bg-[#eef3ff]0/50')
                            countDown.classList.add('cursor-pointer')
                            countDown.classList.add('hover:bg-[#eef3ff]0')
                            countDown.classList.remove('hover:bg-[#eef3ff]0/50')
                            countDown.removeAttribute('disabled')
                            countDown.removeAttribute('dir')
                            countDown.innerText = "ارسال مجدد"
                        },
                        error: function() {
                            openMessage('خطا در دریافت اطلاعات')
                            setTimeout(function(){
                                closeMessage()
                            }, 2000)
                        }
                    })
                    clearInterval(result)
                }
                countDown.innerText = minute.toString().padStart(2, "0") + " : " + seconds.toString().padStart(2,
                    "0");
            }, 1000)
        }
        function openMessage(content){
            message.innerHTML = ''
            let element = document.createElement('div')
            element.classList = 'bg-white rounded-md flex items-center justify-center shadow-md'
            element.innerHTML = `
            <div class="p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-gray-800 cursor-pointer" onclick="closeMessage()" viewBox="0 0 384 512">
                    <path d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
                </svg>
            </div>
            <span class="text-sm text-red-500 py-3 pl-3 pr-0 inline-block">${content}</span>`
            message.appendChild(element)
            message.classList.remove('-top-5')
            message.classList.remove('invisible')
            message.classList.remove('opacity-0')
            message.classList.add('top-10')
        }
        function closeMessage(){
            message.classList.remove('top-10')
            message.classList.add('-top-5')
            message.classList.add('invisible')
            message.classList.add('opacity-0')
        }
    </script>
    <script src="{{ asset('js/rules.js') }}"></script>
</body>

</html>