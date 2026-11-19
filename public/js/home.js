
let addToCartBtns = document.querySelectorAll('.addToCartBtns')

localProducts = JSON.parse(localStorage.getItem('products'))
localPacks = JSON.parse(localStorage.getItem('packs'))
orderBasket = document.getElementById('orderBasket')

let totalCartQuantity = 0

addToCartBtns.forEach(product => {

    if (localProducts) {
        localProducts.find(cartPro => {

            if (cartPro.id == (product.closest('.products') && product.closest('.products').dataset.productId)) {

                product.innerHTML = `
                <div class="w-full p-2 h-full transition-all duration-300 bg-[#e8edff] flex gap-2 justify-center items-center rounded-xl">

                    <button onclick="setCount(this)"
                        class="w-1/3 h-9 rounded-lg transition-all duration-200 bg-white text-[#07145c] hover:bg-[#0877d1] hover:text-white flex justify-center items-center text-lg font-bold ${cartPro.count == cartPro.quantity ? 'cursor-no-drop opacity-40' : 'cursor-pointer'}"
                        ${cartPro.count == cartPro.quantity ? 'disabled' : ''}
                        data-state="+">+</button>

                    <input type="number"
                        class="w-1/3 h-9 rounded-lg bg-transparent text-[#07145c] text-sm text-center outline-none in-fa font-bold"
                        readonly value="${cartPro.quantity}">

                    <button onclick="setCount(this)"
                        class="w-1/3 h-9 rounded-lg transition-all duration-200 bg-white text-[#07145c] hover:bg-[#0877d1] hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer"
                        data-state="-">-</button>

                </div>`

                if (cartPro.count == 0) {
                    product.innerHTML = `
                    <button class="w-full px-4 h-full bg-[#e50914] flex gap-2 justify-center items-center rounded-xl relative after:absolute after:w-full after:h-full after:content-[''] after:top-0 after:right-0 after:bg-white/30 after:rounded-xl transition-all duration-300 hover:bg-[#c90812] cursor-no-drop group">
                        <span class="lg:text-sm text-[10px] text-white font-bold transition-all duration-300">عدم موجودی</span>
                    </button>`
                }
            }
        })
    }

    if (localPacks) {
        localPacks.forEach(cartPro => {

            if (cartPro.id == (product.closest('.products') && product.closest('.products').dataset.productId)) {

                product.innerHTML = `
                <div class="w-full p-2 h-full transition-all duration-300 bg-[#e8edff] flex gap-2 justify-center items-center rounded-xl">

                    <button onclick="setPackCount(this)"
                        class="w-1/3 h-9 rounded-lg transition-all duration-200 bg-white text-[#07145c] hover:bg-[#0877d1] hover:text-white flex justify-center items-center text-lg font-bold ${cartPro.count == cartPro.quantity ? 'cursor-no-drop opacity-40' : 'cursor-pointer'}"
                        ${cartPro.count == cartPro.quantity ? 'disabled' : ''}
                        data-state="+">+</button>

                    <input type="number"
                        class="w-1/3 h-9 rounded-lg bg-transparent text-[#07145c] text-sm text-center outline-none in-fa font-bold"
                        readonly value="${cartPro.quantity}">

                    <button onclick="setPackCount(this)"
                        class="w-1/3 h-9 rounded-lg transition-all duration-200 bg-white text-[#07145c] hover:bg-[#0877d1] hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer"
                        data-state="-">-</button>

                </div>`
            }
        })
    }
})

if (localProducts) {
    localProducts.forEach(item => {
        totalCartQuantity += item.quantity
    })

    cartLink.classList.remove('hidden')
}

if (localPacks) {
    localPacks.forEach(item => {
        totalCartQuantity += item.quantity
    })

    cartLink.classList.remove('hidden')
}

if (orderBasket && orderBasket.children[1]) {
    orderBasket.children[1].innerText = totalCartQuantity
}
