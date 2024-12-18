<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 150vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .categories span { cursor: pointer; padding: 5px 10px; border-radius: 5px; margin-right: 5px; color: #000; }
        .categories span.active { background-color: #000000; color: #fff; }
        .product-card { background-color: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px; width: 200px; }
        .product-image { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; }
        .btn-active { background-color: rgb(223, 212, 179) !important; color: #fff !important; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">KURAW</h4>
            <a href="{{ route('pos') }}">Dashboard</a>
            <a href="{{ route('cashier.index') }}" class="active">Cashier</a>
            <a href="{{ route('transactions.index') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}">Master Item</a>
            <a href="{{ route('cashierReservation.index') }}">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}">History</a>
            <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-6 p-4">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Search menu...">
                    <button class="btn btn-outline-secondary" type="button">Search</button>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-light me-3 position-relative">
                        🔔
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                    <span><strong>John Doe</strong></span>
                </div>
            </div>

            <!-- Categories -->
            <h5><strong>Categories</strong></h5>
            <div class="d-flex categories mb-3" id="categories">
                <span class="active" data-category="All">All Menu</span>
                <span data-category="Coffee">Coffee</span>
                <span data-category="Non-Coffee">Non-Coffee</span>
                <span data-category="Milktea">Milktea</span>
                <span data-category="Fruit Soda">Fruit Soda</span>
                <span data-category="Snacks">Snacks</span>
            </div>

            <!-- Product Cards -->
            <h5><strong>Select Menu</strong></h5>
            <div id="product-list" class="d-flex flex-wrap gap-3"></div>
        </div>

        <!-- Bill Details -->
        <div class="col-md-4 p-4">
            <h6><strong>Bill Details</strong></h6>
            <div class="mb-2">
                <label for="customer-name"><strong>Customer Name:</strong></label>
                <input type="text" id="customer-name" class="form-control" placeholder="Enter name">
            </div>
            <div id="bill-details" class="mb-3"></div>
            <hr>
            <p><strong>Total: ₱<span id="total-price">0</span></strong></p>
            <button class="btn btn-light w-100 mb-2">Pay with Cash</button>
            <button class="btn btn-light w-100 mb-2">Pay with Card</button>
            <button class="btn btn-dark w-100">Process Transaction</button>
        </div>
    </div>
</div>

<script>
    const productData = {
        "All": [
            { name: "Caramel Macchiato", price: 150, image: "{{ asset('assets/img/menu/icedcaramelm.jpg') }}", category: "Coffee" },
            { name: "Strawberry Latte", price: 159, image: "{{ asset('assets/img/menu/strawberrylatte.jpg') }}", category: "Non-Coffee" },
            { name: "Chocolate Milktea", price: 59, image: "{{ asset('assets/img/menu/chocomt.jpg') }}", category: "Milktea" },
            { name: "Green Apple", price: 99, image: "{{ asset('assets/img/menu/greenapple.jpg') }}", category: "Fruit Soda" },
            { name: "Toasted Garlic Bread", price: 100, image: "{{ asset('assets/img/menu/garlicbread.jpg') }}", category: "Snacks" }
        ]
    };

    const productList = document.getElementById('product-list');
    const categories = document.querySelectorAll('.categories span');
    const billDetails = document.getElementById('bill-details');
    const totalPriceElement = document.getElementById('total-price');
    const customerNameInput = document.getElementById('customer-name');

    let totalAmount = 0;

    function loadProducts(category) {
        productList.innerHTML = '';
        const products = category === "All" ? productData["All"] : productData["All"].filter(p => p.category === category);
        products.forEach(product => {
            productList.innerHTML += `
                <div class="product-card">
                    <img src="${product.image}" class="product-image" alt="${product.name}">
                    <h6><strong>${product.name}</strong></h6>
                    <p class="text-muted">₱${product.price}</p>

                    <p><strong>Cup Size</strong></p>
                    <button class="btn btn-light btn-sm cup-size" data-size="Regular">Regular</button>
                    <button class="btn btn-light btn-sm cup-size" data-size="Large">Large</button>

                    <p><strong>Temperature</strong></p>
                    <button class="btn btn-light btn-sm temp" data-temp="Hot">Hot</button>
                    <button class="btn btn-light btn-sm temp" data-temp="Iced">Iced</button>

                    <p><strong>Quantity</strong></p>
                    <button class="btn btn-light btn-sm decrease">-</button>
                    <span class="mx-2 quantity">1</span>
                    <button class="btn btn-light btn-sm increase">+</button>

                    <button class="btn btn-success w-100 mt-2 add-to-cart" 
                        data-name="${product.name}" data-price="${product.price}">Add To Cart</button>
                </div>
            `;
        });
        attachEventListeners();
    }

    function attachEventListeners() {
        // Handle cup size and temperature button clicks (toggle active state)
        document.querySelectorAll('.cup-size, .temp').forEach(button => {
            button.addEventListener('click', function () {
                // Toggle active state
                if (this.classList.contains('btn-active')) {
                    this.classList.remove('btn-active'); // Remove active state if already active
                } else {
                    this.parentElement.querySelectorAll('.btn').forEach(btn => btn.classList.remove('btn-active')); // Remove active from others
                    this.classList.add('btn-active'); // Add active to the clicked button
                }
            });
        });

        // Handle quantity increase, decrease, and add-to-cart actions
        document.querySelectorAll('.increase, .decrease, .add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const parent = this.parentElement;
                const quantityEl = parent.querySelector('.quantity');
                let quantity = parseInt(quantityEl.innerText);

                if (this.classList.contains('increase')) quantity += 1;
                if (this.classList.contains('decrease') && quantity > 1) quantity -= 1;

                quantityEl.innerText = quantity;

                // Handle adding the product to the bill
                if (this.classList.contains('add-to-cart')) {
                    const name = this.dataset.name;
                    const price = parseInt(this.dataset.price);
                    const size = parent.querySelector('.cup-size.btn-active')?.dataset.size || "Regular";
                    const temp = parent.querySelector('.temp.btn-active')?.dataset.temp || "Hot";

                    const total = price * quantity;
                    totalAmount += total;

                    billDetails.innerHTML += `
                        <p><strong>Customer: ${customerNameInput.value || "N/A"}</strong></p>
                        <p><strong>${name}</strong></p>
                        <p>Cup Size: ${size}</p>
                        <p>Temperature: ${temp}</p>
                        <p>Quantity: ${quantity}</p>
                        <p>Total: ₱${total}</p>
                    `;
                    totalPriceElement.innerText = totalAmount;
                }
            });
        });
    }

    categories.forEach(category => {
        category.addEventListener('click', function () {
            categories.forEach(cat => cat.classList.remove('active'));
            this.classList.add('active');
            loadProducts(this.dataset.category);
        });
    });

    loadProducts("All");
</script>
</body>
</html>
