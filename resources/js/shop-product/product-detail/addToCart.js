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

        const product = addToCartBtn.getAttribute("data-product");

        const key = "cartItems";
        const cart = JSON.parse(localStorage.getItem(key)) || [];

        const existingIndex = cart.findIndex(
            (item) =>
                item.id === product.id && item.size === selectedSize
        );

        console.log(JSON.parse(localStorage.getItem("cartItems")));
        console.log(existingIndex);

        if (existingIndex != -1) {
            console.log("exist");
            addToCartBtn.disabled = true;
            addToCartBtn.classList.add("bg-pear-bush-600");
            addToCartBtn.textContent = "Added to Cart ";
        } else {
            // Add new
            cart.push({
                id: product.id,
                product: JSON.parse(product),
                quantity: quantity,
                size: selectedSize,
                total: 0,
                tax: 0,
                netTotal: 0,
            });
        }

        localStorage.setItem(key, JSON.stringify(cart));

        // window.location.href = "/cart";
    });
};

document.addEventListener("DOMContentLoaded", initializeAddToCart);
export default initializeAddToCart;
