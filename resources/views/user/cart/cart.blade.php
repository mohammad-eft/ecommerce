@extends('app.document')
@section('title', 'دیارابزار | سبد خرید')
@section('content')
        <!-- Header -->
        <header class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-lg font-bold text-gray-800">دیارابزار</a>
                
            </div>
        </header>

        <!-- Main -->
        <main class="max-w-5xl mx-auto px-4 py-4 lg:py-8">
            <h1 class="text-lg lg:text-2xl font-bold text-gray-800 mb-3 lg:mb-6">سبد خرید</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" >

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-3" id="cartItemsBlock">
                  
                </div>

                <!-- Summary -->
                
                <aside class="lg:col-span-1 hidden" id="totalBlock">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 lg:sticky lg:top-6">
                        <h2 class="font-bold text-gray-800 mb-4">خلاصه سفارش</h2>

                        <div class="space-y-2.5 text-sm discountBlock">
                           
                                <div class="justify-between text-emerald-600 hidden">
                                    <span>تخفیف</span>
                                    <span class="in-fa" id="discountEl">0</span>
                                </div>
                           
                        </div>

                        <div class="border-t border-dashed border-gray-200 my-4"></div>

                        <div class="flex justify-between items-center mb-5">
                            <span class="font-semibold text-gray-700">مبلغ قابل پرداخت</span>
                            <div class="text-left">
                                <p class="font-bold text-lg text-gray-900 in-fa" id="totalPriceEl">0</p>
                                <p class="text-xs text-gray-400">تومان</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout') }}"
                            class="w-full block text-center bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 rounded-xl transition">
                            تکمیل خرید
                        </a>
                       
                        <p class="text-xs text-gray-400 text-center mt-3">
                            ارسال رایگان برای خرید بالای ۵۰۰ هزار تومان
                        </p>
                    </div>
                </aside>
                {{-- @endif --}}

            </div>
        </main>
        <script>
            window.currentPage = 'cart'
        </script>
<script src="{{ asset('js/cartPage.js') }}"></script>
@endsection
