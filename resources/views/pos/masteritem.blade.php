<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #E8E4D9;
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            height: 100%;
        }

        .sidebar {
            background-color: #222;
            color: #fff;
            min-height: 100vh;
            height: 100%h;
            padding: 10px;
            transition: all 0.3s ease;
            overflow-x: hidden;
            word-wrap: break-word;
        }

        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #fff;
            word-wrap: break-word;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            word-wrap: break-word;
        }

        .sidebar a:hover,
        .active {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            transform: translateX(5px);
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .categories span {
            cursor: pointer;
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            color: #000;
        }

        .categories span:hover {
            background-color: #444;
            color: #fff;
        }

        .categories .active {
            background-color: #000;
            color: #fff;
        }

        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .header-container {
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header-container h3 {
            margin: 0;
            margin-top: 15px;
            line-height: 1;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: absolute;
                z-index: 10;
            }

            .sidebar a {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .sidebar h4 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
            }

            .sidebar a {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .sidebar h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="text-center"><i class="fas fa-coffee"></i> KURAW CAFE</h4>
                <a href="{{ route('cashier.showPOS') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashierHistory.index') }}">
                    <i class="fas fa-receipt me-2"></i>Order/Reservation History
                </a>
                <a href="{{ route('masteritem.index') }}" class="active">
                    <i class="fas fa-box-open me-2"></i>Products List
                </a>
                <a href="{{route(name: 'cashierManage.index')}}">
                    <i class="fas fa-calendar-check me-2"></i>Manage Order/Reservation
                </a>
                <a href="{{ route('cashierProfile.index') }}">
                    <i class="fas fa-cogs me-2"></i>Settings
                </a>
                <form action="{{ route('cashier.logoutCashier') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger mt-5">
                        <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Page Header -->
                <div class="header-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3><i class="fas fa-box-open me-2"></i> Products List</h3>
                    </div>
                    <hr>
                    <!-- Categories -->
                    <h4><strong>Categories</strong></h4>
                    <div class="categories mb-4" id="categories">
                        <span class="active" data-category="all" onclick="filterProducts('all')">All Menu</span>
                        @foreach($categories as $category)
                            <span data-category="{{ $category->id }}" onclick="filterProducts('{{ $category->id }}')">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="row" id="product-list">
                    @foreach($products as $product)
                        <div class="col-md-3 mb-4 product-item" data-category="{{ $product->category->id }}">
                            <div class="product-card">
                                <img src="{{ asset($product->image) }}" class="product-image" alt="{{ $product->name }}">
                                <h6 class="fw-bold">{{ $product->name }}</h6>
                                <hr>
                                @if($product->variations && $product->variations->isNotEmpty())
                                    <ul class="list-unstyled">
                                        @foreach($product->variations as $variation)
                                            <li>
                                                <span class="text-muted">{{ $variation->type }} | {{ $variation->value }}</span>
                                                - <strong>₱{{ number_format($variation->price, 2) }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No Variation</p>
                                @endif
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