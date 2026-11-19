
const categories = document.querySelectorAll('.categories');

const minPrice = document.getElementById('minPrice');
const maxPrice = document.getElementById('maxPrice');

const hasDescount = document.getElementById('hasDescount');
const exists = document.getElementById('exists');

const sortBtn = document.querySelectorAll('.sort-btn');

const productsElement = document.getElementById('products');
const empty = document.getElementById('empty');
const productCount = document.getElementById('productCount');

const filterSection = document.getElementById('filterSection');
const filterBg = document.getElementById('filterBg');

const openFilters = document.getElementById('openFilters');
const closeFilters = document.getElementById('closeFilters');
const applyFilters = document.getElementById('applyFilters');

const resetFilters = document.getElementById('resetFilters');

const searchInp = document.getElementById('searchInp');
const title = document.getElementById('title');

let priceTimeouts = {
    min: null,
    max: null,
    search: null
};

window.filters = window.filters || {};


// --------------------------------------------------
// Mobile filters
// --------------------------------------------------

function openFilterPanel() {
    if (!filterSection || !filterBg) return;

    filterSection.classList.remove('translate-x-full', 'invisible');
    filterBg.classList.remove('invisible', 'opacity-0');

    document.body.style.overflow = 'hidden';
}

function closeFilterPanel() {
    if (!filterSection || !filterBg) return;

    filterSection.classList.add('translate-x-full');
    filterBg.classList.add('invisible', 'opacity-0');

    document.body.style.overflow = '';

    setTimeout(() => {
        filterSection.classList.add('invisible');
    }, 300);
}

if (openFilters) {
    openFilters.addEventListener('click', openFilterPanel);
}

if (closeFilters) {
    closeFilters.addEventListener('click', closeFilterPanel);
}

if (filterBg) {
    filterBg.addEventListener('click', closeFilterPanel);
}

if (applyFilters) {
    applyFilters.addEventListener('click', closeFilterPanel);
}

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeFilterPanel();
    }
});


// --------------------------------------------------
// Product card
// --------------------------------------------------

function createProductCard(product) {

    const link = document.createElement('a');

    link.href = url + 'product/show/' + product.id;

    link.className = `
        product-card group relative min-w-0 bg-white
        border border-[#E2E8F0] rounded-2xl p-3 md:p-4
        transition-all duration-300
        hover:border-[#0055AA]/40
        hover:shadow-[0_12px_35px_rgba(1,3,72,0.07)]
        hover:-translate-y-1
    `;

    let discountHTML = '';

    if (product.percent) {
        discountHTML = `
            <span class="absolute top-3 right-3 z-10 bg-[#E5232E]
                text-white rounded-lg text-[10px] font-bold
                px-2 py-1 in-fa">
                ${product.percent}٪ تخفیف
            </span>
        `;
    }

    let priceHTML = '';

    if (product.secondary_price) {

        priceHTML = `
            <div class="flex items-center justify-between gap-1 mb-1">
                <span class="text-[10px] text-slate-400">قیمت فروش</span>
                <span class="text-[10px] text-slate-400 line-through in-fa">
                    ${product.primary_price}
                </span>
            </div>

            <div class="flex items-end justify-between gap-1">
                <strong class="text-sm md:text-base font-black text-[#010348] in-fa">
                    ${product.secondary_price}
                </strong>
                <span class="text-[10px] text-slate-500">تومان</span>
            </div>
        `;

    } else {

        priceHTML = `
            <div class="flex items-center justify-between gap-1 mb-1">
                <span class="text-[10px] text-slate-400">قیمت محصول</span>
            </div>

            <div class="flex items-end justify-between gap-1">
                <strong class="text-sm md:text-base font-black text-[#010348] in-fa">
                    ${product.primary_price ?? 'تماس بگیرید'}
                </strong>
                <span class="text-[10px] text-slate-500">
                    ${product.primary_price ? 'تومان' : ''}
                </span>
            </div>
        `;
    }

    let stockHTML = '';

    if (product.count > 0) {

        stockHTML = `
            <span class="flex items-center gap-1.5 text-[10px]
                text-emerald-600 font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                موجود در انبار
            </span>
        `;

    } else {

        stockHTML = `
            <span class="flex items-center gap-1.5 text-[10px]
                text-red-500 font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                ناموجود
            </span>
        `;
    }

    link.innerHTML = `
        ${discountHTML}

        <div class="relative bg-[#F7F9FC] rounded-xl overflow-hidden mb-4">
            <img src=""
                alt=""
                loading="lazy"
                class="w-full aspect-square object-contain p-3
                    transition-transform duration-500 group-hover:scale-105">

            <div class="absolute bottom-2 left-2 w-7 h-7 rounded-lg
                bg-white/90 text-[#0055AA] flex items-center justify-center
                opacity-0 group-hover:opacity-100 transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path d="M7 17 17 7M7 7h10v10"/>
                </svg>
            </div>
        </div>

        <h3 class="product-title text-xs md:text-[13px] font-bold
            text-[#010348] leading-7 h-[54px] overflow-hidden
            line-clamp-2 group-hover:text-[#0055AA] transition">
        </h3>

        <div class="mt-4 pt-3 border-t border-dashed
            border-[#E2E8F0] min-h-[74px]">
            ${priceHTML}
        </div>

        <div class="flex items-center justify-between gap-2 mt-3
            pt-3 border-t border-[#E2E8F0]">
            ${stockHTML}

            <span class="text-[10px] text-[#0055AA] font-bold
                group-hover:translate-x-[-3px] transition">
                مشاهده <span class="text-sm">←</span>
            </span>
        </div>
    `;

    const image = link.querySelector('img');

    image.src = imgPath + product.image;
    image.alt = product.title || 'محصول دیارابزار';

    link.querySelector('.product-title').textContent = product.title || '';

    return link;
}


// --------------------------------------------------
// Get filtered products
// --------------------------------------------------

function getFilters() {
    

    productsElement.classList.add('opacity-50', 'pointer-events-none');

    $.ajax({

        url: api + 'getFilters',
        type: 'POST',
        dataType: 'json',

        data: {
            filters: window.filters
        },

        success: function (products) {

            productsElement.innerHTML = '';

            const hasProducts = Array.isArray(products) && products.length > 0;

            if (hasProducts) {

                empty.classList.add('hidden');

                products.forEach(product => {
                    productsElement.appendChild(createProductCard(product));
                });

            } else {

                empty.classList.remove('hidden');
            }

            if (productCount) {
                productCount.textContent = `${products.length} محصول`;
            }

        },

        error: function (xhr) {
            console.error('Filter error:', xhr.responseText);
        },

        complete: function () {
            productsElement.classList.remove('opacity-50', 'pointer-events-none');
        }

    });
}


// --------------------------------------------------
// Category filters
// --------------------------------------------------

categories.forEach(category => {

    category.addEventListener('change', function () {

        const categoryObj = {};

        let hasAny = false;

        categories.forEach((cat, index) => {

            if (cat.checked) {

                hasAny = true;

                categoryObj[index] = cat.dataset.filter;
            }

        });

        if (hasAny) {
            window.filters.category = categoryObj;
        } else {
            delete window.filters.category;
        }

        getFilters();

    });

});


// --------------------------------------------------
// Price filters
// --------------------------------------------------

if (minPrice) {

    minPrice.addEventListener('input', function () {

        clearTimeout(priceTimeouts.min);

        priceTimeouts.min = setTimeout(() => {

            window.filters.fromPrice = minPrice.value || 0;

            getFilters();

        }, 500);

    });

}

if (maxPrice) {

    maxPrice.addEventListener('input', function () {

        clearTimeout(priceTimeouts.max);

        priceTimeouts.max = setTimeout(() => {

            window.filters.toPrice = maxPrice.value || null;

            getFilters();

        }, 500);

    });

}


// --------------------------------------------------
// Search
// --------------------------------------------------

if (searchInp) {

    searchInp.addEventListener('input', function () {

        clearTimeout(priceTimeouts.search);

        priceTimeouts.search = setTimeout(() => {

            const keyword = searchInp.value.trim();

            window.filters.keyword = keyword || null;

            if (title) {
                title.textContent = keyword
                    ? `نتایج جستجو برای «${keyword}»`
                    : 'همه محصولات';
            }

            getFilters();

        }, 500);

    });

}


// --------------------------------------------------
// Discount filter
// --------------------------------------------------

if (hasDescount) {

    hasDescount.addEventListener('change', function () {

        if (hasDescount.checked) {
            window.filters.hasDescount = 1;
        } else {
            window.filters.hasDescount = 0;
        }

        getFilters();

    });

}


// --------------------------------------------------
// Available products
// --------------------------------------------------

if (exists) {

    exists.addEventListener('change', function () {

        if (exists.checked) {
            window.filters.exists = 1;
        } else {
            window.filters.exists = 0;
        }

        getFilters();

    });

}


// --------------------------------------------------
// Sorting
// --------------------------------------------------

sortBtn.forEach(btn => {

    btn.addEventListener('click', function () {

        sortBtn.forEach(button => {

            button.classList.remove('font-black', 'text-[#0055AA]', 'bg-[#EAF2FF]');
            button.classList.add('text-slate-500');

        });

        this.classList.remove('text-slate-500');

        this.classList.add(
            'font-black',
            'text-[#0055AA]',
            'bg-[#EAF2FF]'
        );

        window.filters.sortBy = this.dataset.sortBy;
        window.filters.sortType = this.dataset.sortType;

        getFilters();

    });

});


// --------------------------------------------------
// Reset filters
// --------------------------------------------------

if (resetFilters) {

    resetFilters.addEventListener('click', function () {

        window.filters = {
            keyword: null,
            writer: null,
            exists: 0,
            fromPrice: 0,
            toPrice: null,
            sortType: 'desc',
            sortBy: 'created_at',
            page: 1,
            category: null,
            hasDescount: 0
        };

        categories.forEach(category => {
            category.checked = false;
        });

        if (minPrice) minPrice.value = 0;
        if (maxPrice) maxPrice.value = '';

        if (hasDescount) hasDescount.checked = false;
        if (exists) exists.checked = false;

        if (searchInp) searchInp.value = '';

        if (title) title.textContent = 'همه محصولات';

        sortBtn.forEach((btn, index) => {

            btn.classList.remove('font-black', 'text-[#0055AA]', 'bg-[#EAF2FF]', 'text-slate-500');

            if (index === 0) {

                btn.classList.add(
                    'font-black',
                    'text-[#0055AA]',
                    'bg-[#EAF2FF]'
                );

            } else {

                btn.classList.add('text-slate-500');

            }

        });

        closeFilterPanel();

        getFilters();

    });

}
