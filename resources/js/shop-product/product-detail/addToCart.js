const initializeAddToCart = () => {
    let selectedStock = null;
    let selectedSize = null;
    let quantity = 1;

    const sizeButtons = document.querySelectorAll(".size-btn");
    const quantityValue = document.getElementById("quantityValue");
    const increaseBtn = document.getElementById("increaseQty");
    const decreaseBtn = document.getElementById("decreaseQty");
    const stockInfo = document.getElementById("stockInfo");
    const errorMsg = document.getElementById("errorMsg");
    const addToCartBtn = document.querySelector(".add-to-cart-btn");
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    // Handle size selection
    sizeButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // Remove active style
            sizeButtons.forEach((b) => b.classList.remove("selected-size"));
            // Add active style
            btn.classList.add("selected-size");

            const stock = parseInt(btn.dataset.stock);
            selectedSize = btn.dataset.size;

            selectedStock = stock;
            quantity = 1;

            quantityValue.textContent = quantity;
            stockInfo.textContent = `Stock available for size ${btn.dataset.size}: ${stock}`;
            stockInfo.classList.add("text-green-500", "font-medium");
            stockInfo.setAttribute('data-stock-id', btn.dataset.stockId);
            errorMsg.classList.add("hidden");

            updateButtons();
        });
    });

    // Update +/− button states
    function updateButtons() {
        decreaseBtn.disabled = quantity <= 1;
        increaseBtn.disabled = !selectedStock || quantity >= selectedStock;
    }

    increaseBtn.addEventListener("click", () => {
        if (!selectedStock) {
            errorMsg.classList.remove("hidden");
            return;
        }

        if (quantity < selectedStock) {
            quantity++;
            quantityValue.textContent = quantity;
            updateButtons();
        }
    });

    decreaseBtn.addEventListener("click", () => {
        if (!selectedStock) {
            errorMsg.classList.remove("hidden");
            return;
        }

        if (quantity > 1) {
            quantity--;
            quantityValue.textContent = quantity;
            updateButtons();
        }
    });

    updateButtons(); // Initialize

    addToCartBtn.addEventListener("click", () => {
        if (!selectedStock && quantity > selectedStock) {
            errorMsg.classList.remove("hidden");
            return;
        }

        const product = JSON.parse(addToCartBtn.getAttribute("data-product"));

        const key = "cartItems";
        const cart = JSON.parse(localStorage.getItem(key)) || {
            items: [],
            subtotal: 0,
            tax: 0,
            netTotal: 0,
            stock_id:null
        };

        const cartPrice =
            product.discount_percentage > 0
                ? product.display_price
                : product.sale_price;

        const existingIndex = cart.items?.findIndex(
            (item) =>
                item.product.id === product.id && item.size === selectedSize
        );

        if (existingIndex != -1) {
            let updateQuantity;
            let newCost;

            const totalQuantity = cart.items[existingIndex].quantity + quantity;

            if (totalQuantity <= selectedStock) {
                updateQuantity = totalQuantity;
                newCost = updateQuantity * cartPrice;
            } else {
                updateQuantity = selectedStock;
                newCost = updateQuantity * cartPrice;
            }

            cart.items[existingIndex].quantity = updateQuantity;
            cart.items[existingIndex].cost = newCost;
        } else {
            // Add new
            cart.items.push({
                id: Date.now(),
                product: product,
                quantity: quantity,
                size: selectedSize,
                cost: cartPrice * quantity,
                stock_id:stockInfo.getAttribute('data-stock-id')
            });
        }

        localStorage.setItem(key, JSON.stringify(cart));
        totalCartItems.textContent = cart.items.length;
        if (cartItems.classList.contains("hidden")) {
            cartItems.classList.remove("hidden");
        }
        // console.log(JSON.parse(localStorage.getItem("cartItems")));

        // window.location.href = "/cart";
    });
};

document.addEventListener("DOMContentLoaded", initializeAddToCart);
export default initializeAddToCart;
