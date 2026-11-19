
localProducts = JSON.parse(localStorage.getItem('products'))
addToCartBtns = document.querySelectorAll('.addToCartBtns')
if(localStorage.getItem('products') && localProducts.length){
    addToCartBtns.forEach(btn => {
        localProducts.forEach(cartItem => {
            if (cartItem.id == productId) {
                btn.innerHTML = `
                <div class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-product-id="${productId}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${cartItem.quantity}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
                
            }
        })
    })
}
addToCartBtns.forEach(btn=>{
    if (btn.dataset.count == 0) {
        btn.innerHTML = `
            <button class="w-full px-4 h-full bg-(--pastel-pink) flex gap-2 justify-center items-center rounded-xl relative after:absolute after:w-full after:h-full after:content-[''] after:top-0 after:right-0 after:bg-white/30 after:rounded-xl transition-all duration-300 hover:bg-(--discount-color) cursor-no-drop group">
                <span class="lg:text-sm text-[10px] text-white font-bold transition-all duration-300">عدم موجودی</span>
            </button>`
    }
})



document.addEventListener('DOMContentLoaded', function () {
    const mainImages = document.querySelectorAll('.gallery_pack_single_primary_img');
    const galleryItems = document.querySelectorAll('.gallery_pack_single');

    if (!mainImages.length || !galleryItems.length) return;

    // ساخت لایت‌باکس
    const lightbox = document.createElement('div');

    lightbox.className = `
        fixed inset-0 z-[99999] bg-[#010348]/95
        flex items-center justify-center p-4
        opacity-0 invisible transition-all duration-300
    `;

    lightbox.innerHTML = `
        <button type="button"
            class="absolute top-5 left-5 size-11 rounded-full bg-white/10
            text-white flex items-center justify-center hover:bg-white/20 transition"
            aria-label="بستن تصویر">
            <svg class="size-6" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="m18 6-12 12M6 6l12 12"/>
            </svg>
        </button>

        <img src="" alt="تصویر محصول"
            class="max-w-full max-h-[85vh] object-contain rounded-xl
            scale-95 transition-transform duration-300">
    `;

    document.body.appendChild(lightbox);

    const lightboxImage = lightbox.querySelector('img');
    const closeButton = lightbox.querySelector('button');

    // تغییر تصویر اصلی با کلیک روی تصاویر گالری
    galleryItems.forEach(item => {
        item.addEventListener('click', function () {
            const image = this.querySelector('img');

            if (!image) return;

            mainImages.forEach(mainImage => {
                mainImage.src = image.src;
            });
        });
    });

    // باز کردن تصویر بزرگ
    mainImages.forEach(image => {
        image.style.cursor = 'zoom-in';

        image.addEventListener('click', function () {
            lightboxImage.src = this.src;

            lightbox.classList.remove('invisible', 'opacity-0');
            lightbox.classList.add('opacity-100');

            lightboxImage.classList.remove('scale-95');
            lightboxImage.classList.add('scale-100');

            document.body.style.overflow = 'hidden';
        });
    });

    // بستن لایت‌باکس
    function closeLightbox() {
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0');

        lightboxImage.classList.remove('scale-100');
        lightboxImage.classList.add('scale-95');

        setTimeout(() => {
            lightbox.classList.add('invisible');
            document.body.style.overflow = '';
        }, 300);
    }

    closeButton.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });
});
