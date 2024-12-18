<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .categories span { cursor: pointer; margin-right: 10px; padding: 5px 10px; border-radius: 5px; color: #000; }
        .categories span:hover { background-color: #444; color: #fff; }
        .categories .active { background-color: #000; color: #fff; }
        .product-card { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; text-align: center; transition: transform 0.2s; }
        .product-card:hover { transform: scale(1.05); }
        .product-image { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">KURAW</h4>
            <a href="{{ route('pos') }}">Dashboard</a>
            <a href="{{ route('cashier.index') }}">Cashier</a>
            <a href="{{ route('transactions.index') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}" class="active">Master Item</a>
            <a href="{{ route('cashierReservation.index') }}">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}">History</a>
            <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Master Items</h3>
            </div>

            <!-- Categories -->
            <h5><strong>Categories</strong></h5>
            <div class="categories mb-4" id="categories">
                <span class="active" data-category="All">All Menu</span>
                <span data-category="Coffee">Coffee</span>
                <span data-category="Non-Coffee">Non-Coffee</span>
                <span data-category="Milktea">Milktea</span>
                <span data-category="Fruit Soda">Fruit Soda</span>
                <span data-category="Snacks">Snacks</span>
            </div>

            <!-- Product Grid -->
            <div class="row" id="product-list">
                <!-- Products will load here dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const products = {
        "All": [
            { name: "Caramel Macchiato", price: 150, category: "Coffee", image: "{{ asset('assets/img/menu/icedcaramelm.jpg') }}" },
            { name: "Strawberry Latte", price: 159, category: "Non-Coffee", image: "{{ asset('assets/img/menu/strawberrylatte.jpg') }}" },
            { name: "Chocolate Milktea", price: 59, category: "Milktea", image: "{{ asset('assets/img/menu/chocomt.jpg') }}" },
            { name: "Green Apple", price: 99, category: "Fruit Soda", image: "{{ asset('assets/img/menu/greenapple.jpg') }}" },
            { name: "Toasted Garlic Bread", price: 100, category: "Snacks", image: "{{ asset('assets/img/menu/garlicbread.jpg') }}" }
        ],
        "Coffee": [
            { name: "Caramel Macchiato", price: 150, image: "{{ asset('assets/img/menu/icedcaramelm.jpg') }}" }
        ],
        "Non-Coffee": [
            { name: "Strawberry Latte", price: 159, image: "{{ asset('assets/img/menu/strawberrylatte.jpg') }}" }
        ],
        "Milktea": [
            { name: "Chocolate Milktea", price: 59, image: "{{ asset('assets/img/menu/chocomt.jpg') }}" }
        ],
        "Fruit Soda": [
            { name: "Green Apple", price: 99, image: "{{ asset('assets/img/menu/greenapple.jpg') }}" }
        ],
        "Snacks": [
            { name: "Toasted Garlic Bread", price: 100, image: "{{ asset('assets/img/menu/garlicbread.jpg') }}" }
        ]
    };

    const productList = document.getElementById('product-list');
    const categoryLinks = document.querySelectorAll('.categories span');

    // Function to load products dynamically
    function loadProducts(category) {
        productList.innerHTML = ''; // Clear previous products
        const selectedProducts = products[category] || [];
        selectedProducts.forEach(product => {
            productList.innerHTML += `
                <div class="col-md-3 mb-4">
                    <div class="product-card">
                        <img src="${product.image}" class="product-image" alt="${product.name}">
                        <h6 class="fw-bold">${product.name}</h6>
                        <p class="text-muted">₱${product.price}</p>
                    </div>
                </div>
            `;
        });
    }

    // Event listener for category clicks
    categoryLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Remove active class from all links
            categoryLinks.forEach(link => link.classList.remove('active'));
            // Add active class to the clicked link
            this.classList.add('active');
            // Load products based on category
            loadProducts(this.dataset.category);
        });
    });

    // Load All products by default
    loadProducts('All');
</script>
</body>
</html>
