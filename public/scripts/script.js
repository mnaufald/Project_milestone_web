// let cart = [];

// const products = [
//     { name: "LENOVO Monitor WLED 27 Inch L27i-30", price: 2399000 },
//     { name: "DELL 22 inch Monitor E2222HS", price: 3000000 },
//     { name: "SAMSUNG 34\" Odyssey G5 Curved Gaming Monitor (165Hz) LC34G55TWWCXXK", price: 7199900 },
//     { name: "LOGITECH K650 Wireless Keyboard", price: 852000 },
//     { name: "TARGUS Wireless Combo KM001 AKM001AP", price: 318000 },
//     { name: "DELL Keyboard & Mouse Combo KM7321W", price: 1699900 },
//     { name: "LOGITECH MX Master 3s", price: 1757000 },
//     { name: "Olike Silent Multi Button Wireless Mouse M301", price: 67000 },
//     { name: "APPLE Magic Mouse", price: 1799000 }
// ];

// function addToCart(productName) {
//     let product = products.find(item => item.name === productName);
//     if (!product) return;
    
//     let existingProduct = cart.find(item => item.name === product.name);
//     if (existingProduct) {
//         existingProduct.quantity += 1;
//     } else {
//         cart.push({ ...product, quantity: 1 });
//     }
    
//     updateCartDisplay();
// }

// function updateCartDisplay() {
//     let cartContainer = document.getElementById("cart-container");
//     cartContainer.innerHTML = "";
    
//     cart.forEach(item => {
//         let itemElement = document.createElement("p");
//         itemElement.innerText = `${item.name} - Rp${item.price.toLocaleString()} x ${item.quantity}`;
//         cartContainer.appendChild(itemElement);
//     });
// }

// document.querySelectorAll(".add-to-cart-btn").forEach(button => {
//     button.addEventListener("click", () => addToCart(button.dataset.productName));
// });



// 








// document.addEventListener("DOMContentLoaded", function () {
//     let cart = JSON.parse(localStorage.getItem("cart")) || [];

//     function updateCartUI() {
//         let cartCount = document.getElementById("cart-count");
//         let cartTotal = document.getElementById("cart-total");
//         let cartItems = document.getElementById("cart-items");

//         cartCount.innerText = cart.length;

//         let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
//         cartTotal.innerText = `Rp${total.toLocaleString()}`;

//         cartItems.innerHTML = "";
//         cart.forEach((item, index) => {
//             let itemElement = document.createElement("div");
//             itemElement.innerHTML = `
//                 <p>${item.name} - ${item.quantity} x Rp${item.price.toLocaleString()}</p>
//                 <button onclick="removeFromCart(${index})">Hapus</button>
//             `;
//             cartItems.appendChild(itemElement);
//         });
//     }

//     window.addToCart = function (name, price) {
//         let existingItem = cart.find(item => item.name === name);
//         if (existingItem) {
//             existingItem.quantity += 1;
//         } else {
//             cart.push({ name, price, quantity: 1 });
//         }
//         localStorage.setItem("cart", JSON.stringify(cart));
//         updateCartUI();
//     };

//     window.removeFromCart = function (index) {
//         cart.splice(index, 1);
//         localStorage.setItem("cart", JSON.stringify(cart));
//         updateCartUI();
//     };

//     updateCartUI();
// });
