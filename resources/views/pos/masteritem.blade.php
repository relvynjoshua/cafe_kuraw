<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .container-fluid { height: 100%;}
        .sidebar { background-color: #222; color: #fff; min-height:100vh; height: 100%h; }
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
            <a href="{{ route('cashier.transactions') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}" class="active">Master Item</a>
            <a href="{{ route('cashierReservation.index') }}">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}">History</a>
            <a href="{{ route('cashierManage.index') }}">Manage Orders</a>
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
                <span class="active" data-category="all" onclick="filterProducts('all')">All Menu</span>
                @foreach($categories as $category)
                    <span data-category="{{ $category->id }}" onclick="filterProducts('{{ $category->id }}')">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>

            <!-- Product Grid -->
            <div class="row" id="product-list">
                @foreach($products as $product)
                    <div class="col-md-3 mb-4 product-item" data-category="{{ $product->category->id }}">
                        <div class="product-card">
                            <img src="{{ asset($product->image) }}" class="product-image" alt="{{ $product->name }}">
                            <h6 class="fw-bold">{{ $product->name }}</h6>
                            <p class="text-muted">₱{{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function filterProducts(categoryId) {
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(item => {
            if (categoryId === 'all' || item.getAttribute('data-category') === categoryId) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Highlight active category
        const categoryLinks = document.querySelectorAll('.categories span');
        categoryLinks.forEach(link => link.classList.remove('active'));
        document.querySelector(`[data-category="${categoryId}"]`).classList.add('active');
    }
</script>
</body>
</html>
