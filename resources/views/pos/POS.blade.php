<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard & POS</title>
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

        .dashboard-card {
            background-color: #222;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #fff;
            margin: 0 0 20px;
        }

        .categories button {
            padding: 8px 15px;
            margin: 5px;
            border-radius: 5px;
            background-color: #f7f7f7;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .categories button:hover {
            background-color: #000;
            color: #fff;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        #bill-details-table th,
        #bill-details-table td {
            vertical-align: middle;
            text-align: center;
        }

        #bill-details-table img.bill-item-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-light {
            padding: 5px 10px;
        }

        .btn-danger {
            padding: 5px 10px;
        }

        #bill-details p {
            margin: 0;
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
            padding: 8px 12px;
        }

        .dashboard-container,
        .order-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard-container h5,
        .order-container h5 {
            font-weight: bold;
        }

        .table {
            margin-top: 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .latest-orders-table .table th,
        .latest-orders-table .table td,
        .popular-products-table .table th,
        .popular-products-table .table td {
            text-align: center;
            vertical-align: middle;
        }

        .latest-orders-table .table thead {
            background-color: #ffc107;
            color: #000;
        }

        .popular-products-table .table thead {
            background-color: #17a2b8;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
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
                <a href="{{ route('cashier.showPOS') }}" class="active">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashierHistory.index') }}">
                    <i class="fas fa-receipt me-2"></i>Order/Reservation History
                </a>
                <a href="{{ route('masteritem.index') }}">
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
                <!-- Dashboard Section -->
                <div class="dashboard-container">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="dashboard-card d-flex align-items-center">
                                <i class="fas fa-chart-line me-3 text-success" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Today's Gross Profit</h5>
                                    <h3>₱{{ number_format($grossProfit, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-card d-flex align-items-center">
                                <i class="fas fa-wallet me-3 text-primary" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Today's Net Profit</h5>
                                    <h3>₱{{ number_format($netProfit, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-card">
                                <h5 class="d-flex align-items-center">
                                    <i class="fas fa-receipt me-3 text-warning"></i> Latest Orders
                                </h5>
                                <div class="table-responsive latest-orders-table">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Customer Name</th>
                                                <th>Timestamp</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latestTransactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->transaction_id }}</td>
                                                    <td>{{ $transaction->customer_name }}</td>
                                                    <td>{{ $transaction->created_at->format('M d, Y - H:i') }}</td>
                                                    <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                                                    <td
                                                        class="{{ $transaction->status === 'completed' ? 'text-success' : 'text-danger' }}">
                                                        {{ ucfirst($transaction->status) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dashboard-card">
                                <h5 class="d-flex align-items-center">
                                    <i class="fas fa-cash-register me-3 text-info"></i> Popular Products
                                </h5>
                                <div class="table-responsive popular-products-table">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Total Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popularProducts as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->orders_count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Ordering System -->
                <div class="order-container">
                    <div class="row">
                        <!-- Menu Section -->
                        <div class="col-md-8">
                            <!-- Categories -->
                            <h5><strong>Categories</strong></h5>
                            <div class="categories mb-4">
                                <button class="btn btn-outline-dark me-2" onclick="filterProducts('all')">All
                                    Menu</button>
                                @foreach($categories as $category)
                                    <button class="btn btn-outline-dark me-2"
                                        onclick="filterProducts('{{ $category->id }}')">
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Product Cards -->
                            <h5><strong>Select Menu</strong></h5>
                            <div id="product-list" class="row">
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                                        <div class="product-card" data-category="{{ $product->category_id }}">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="product-image">
                                            <h5>{{ $product->name }}</h5>
                                            <p>{{ $product->description }}</p>

                                            <!-- Variations Dropdown -->
                                            @if (!empty($product->variations))
                                                <div class="mb-2">
                                                    <label for="variation-{{ $product->id }}">Select Variation:</label>
                                                    <select id="variation-{{ $product->id }}"
                                                        class="form-select variation-dropdown">
                                                        @foreach ($product->variations as $variation)
                                                            <option value="{{ $variation['type'] }}"
                                                                data-price="{{ $variation['price'] }}">
                                                                {{ $variation['type'] }} -
                                                                ₱{{ number_format($variation['price'], 2) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            <!-- Add to Cart Button -->
                                            <button
                                                onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ asset($product->image) }}')"
                                                class="btn btn-success w-100">Add to Cart</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="col-md-4 p-4">
                            <div class="card shadow-sm border-0 rounded">
                                <div class="card-header bg-dark text-white">
                                    <h6 class="mb-0 text-center"><strong>Order Details</strong></h6>
                                </div>
                                <div class="card-body">

                                    <!-- Customer Details -->
                                    <div class="mb-2">
                                        <label for="customer_name"><strong>Customer Name:</strong></label>
                                        <input type="text" id="customer_name" class="form-control"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="email"><strong>Email:</strong></label>
                                        <input type="email" id="email" class="form-control" placeholder="Enter email"
                                            required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="phone"><strong>Phone:</strong></label>
                                        <input type="text" id="phone" class="form-control"
                                            placeholder="Enter phone number" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="address"><strong>Address:</strong></label>
                                        <input type="text" id="address" class="form-control"
                                            placeholder="Enter address" required>
                                    </div>

                                    <!-- Delivery Method -->
                                    <div class="mb-2">
                                        <label for="delivery_method"><strong>Delivery Method:</strong></label>
                                        <select id="delivery_method" class="form-select" required>
                                            <option value="pickup">Dine In</option>
                                            <option value="pickup">Pickup</option>
                                            <option value="delivery">Delivery</option>
                                        </select>
                                    </div>

                                    <!-- Cart Details -->
                                    <table class="table table-bordered" id="bill-details-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bill-details">
                                            <!-- Cart items will be dynamically inserted here -->
                                        </tbody>
                                    </table>
                                    <hr>
                                    <!-- <p><strong>Total: ₱<span id="total-price">0.00</span></strong></p> -->

                                    <!-- Payment Method -->
                                    <div class="mb-3">
                                        <label for="payment_method"><strong>Payment Method:</strong></label>
                                        <select id="payment_method" class="form-select" required
                                            onchange="togglePaymentMethod(this.value)">
                                            <option value="" disabled selected>Select Payment Method</option>
                                            <option value="cash">Cash</option>
                                            <option value="gcash">GCash</option>
                                        </select>
                                    </div>

                                    <!-- Cash Payment Section -->
                                    <div id="cash-section" class="payment-section d-none">
                                        <div class="mb-3">
                                            <label for="cash-amount" class="form-label">Payment Amount</label>
                                            <input type="number" id="cash-amount" class="form-control"
                                                placeholder="Enter payment amount">
                                        </div>
                                        <p><strong>Total: ₱<span id="cash-total-amount">0.00</span></strong></p>
                                        <p><strong>Change: ₱<span id="cash-change">0.00</span></strong></p>
                                        <button class="btn btn-primary w-100" onclick="processCashPayment()">Confirm
                                            Payment</button>
                                    </div>

                                    <!-- GCash Payment Section -->
                                    <div id="gcash-section" class="payment-section d-none">
                                        <div class="mb-3">
                                            <label for="gcash_reference_number" class="form-label">GCash Reference
                                                Number</label>
                                            <input type="text" id="gcash_reference_number" class="form-control"
                                                placeholder="Enter reference number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gcash_proof" class="form-label">Proof of Payment</label>
                                            <input type="file" id="gcash_proof" class="form-control">
                                        </div>
                                        <p><strong>Total: ₱<span id="gcash-total-amount">0.00</span></strong></p>
                                        <button class="btn btn-primary w-100" onclick="processGCashPayment()">Confirm
                                            Payment</button>
                                    </div>

                                    <!-- Process Transaction Button -->
                                    <button class="btn btn-dark w-100 mt-4" onclick="processTransaction()">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            filterProducts('all'); // Show all products by default
        });

        function togglePaymentMethod(selectedMethod) {
            const cashSection = document.getElementById('cash-section');
            const gcashSection = document.getElementById('gcash-section');

            // Hide all sections initially
            cashSection.classList.add('d-none');
            gcashSection.classList.add('d-none');

            // Show the selected payment section
            if (selectedMethod === 'cash') {
                cashSection.classList.remove('d-none');
            } else if (selectedMethod === 'gcash') {
                gcashSection.classList.remove('d-none');
            }
        }

        function processCashPayment() {
            const cashAmount = parseFloat(document.getElementById('cash-amount').value);

            if (cashAmount && cashAmount >= totalAmount) {
                const change = cashAmount - totalAmount;

                // Add the payment method and amount paid to the table
                const billDetails = document.getElementById('bill-details');
                const paymentRow = `
            <tr>
                <td colspan="3"><strong>Payment Method: Cash</strong></td>
                <td colspan="2">Amount Paid: ₱${cashAmount.toFixed(2)}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">Change: ₱${change.toFixed(2)}</td>
            </tr>
        `;
                billDetails.innerHTML += paymentRow;

                // Update UI and reset the form
                document.getElementById('cash-section').classList.add('d-none');
                alert('Payment processed successfully!');
            } else {
                alert('Insufficient payment amount. Please enter a valid amount.');
            }
        }

        function processGCashPayment() {
            const referenceNumber = document.getElementById('gcash_reference_number').value;
            const proofOfPayment = document.getElementById('gcash_proof').files[0];

            if (referenceNumber && proofOfPayment) {
                // Update Bill Details
                const billDetails = document.getElementById('bill-details');
                const paymentRow = `
            <tr>
                <td colspan="3"><strong>Payment Method: GCash</strong></td>
                <td colspan="2">Reference No: ${referenceNumber}</td>
            </tr>
        `;
                billDetails.innerHTML += paymentRow;

                // Reset GCash Section
                document.getElementById('gcash-section').classList.add('d-none');
                alert('GCash Payment Confirmed!');
            } else {
                alert('Please provide a reference number and proof of payment.');
            }
        }

        function filterProducts(categoryId) {
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                if (categoryId === 'all' || card.getAttribute('data-category') === categoryId) {
                    card.parentElement.style.display = 'block'; // Show the parent element (column)
                } else {
                    card.parentElement.style.display = 'none'; // Hide the parent element (column)
                }
            });
        }

        let cart = []; // Array to store cart items
        let totalAmount = 0; // Variable to track the total price

        function addToCart(productId, productName, basePrice, productImage) {
            const variationDropdown = document.getElementById(`variation-${productId}`);
            let selectedVariation = null;
            let variationPrice = basePrice;

            if (variationDropdown) {
                selectedVariation = variationDropdown.value;
                variationPrice = parseFloat(variationDropdown.options[variationDropdown.selectedIndex].getAttribute('data-price'));
            }

            const existingProduct = cart.find(
                (item) => item.id === productId && item.variation === selectedVariation
            );

            if (existingProduct) {
                // If the product with the selected variation exists in the cart, increase the quantity
                existingProduct.quantity += 1;
                existingProduct.totalPrice = existingProduct.quantity * variationPrice;
            } else {
                // Add new product with the selected variation to the cart
                cart.push({
                    id: productId,
                    name: productName,
                    price: variationPrice,
                    image: productImage,
                    variation: selectedVariation,
                    quantity: 1,
                    totalPrice: variationPrice,
                });
            }

            updateBillDetails(); // Update the bill details display
        }

        function updateBillDetails() {
            const billDetails = document.getElementById('bill-details');
            billDetails.innerHTML = ''; // Clear existing content
            totalAmount = 0; // Reset total amount

            // Add all cart items to the table
            cart.forEach((item, index) => {
                const row = `
            <tr>
                <td><img src="${item.image}" alt="${item.name}" class="bill-item-image"></td>
                <td>${item.name}<br>
                    <small>${item.variation ? `Variation: ${item.variation}` : ''}</small>
                </td>
                <td>
                    <button class="btn btn-sm btn-light" onclick="updateQuantity(${index}, 'decrease')">-</button>
                    ${item.quantity}
                    <button class="btn btn-sm btn-light" onclick="updateQuantity(${index}, 'increase')">+</button>
                </td>
                <td>₱${item.totalPrice.toFixed(2)}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">Remove</button>
                </td>
            </tr>
            `;
                billDetails.innerHTML += row;
                totalAmount += item.totalPrice; // Accumulate the total amount
            });

            // Add the total row to the table
            const totalRow = `
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td colspan="2"><strong>₱${totalAmount.toFixed(2)}</strong></td>
        </tr>
        `;
            billDetails.innerHTML += totalRow;
        }

        function updateQuantity(index, action) {
            const item = cart[index];
            if (action === 'increase') {
                item.quantity += 1;
            } else if (action === 'decrease' && item.quantity > 1) {
                item.quantity -= 1;
            }
            item.totalPrice = item.quantity * item.price; // Update the total price for the item
            updateBillDetails(); // Refresh the table
        }

        function removeFromCart(index) {
            cart.splice(index, 1); // Remove the item at the given index
            updateBillDetails(); // Refresh the table
        }

        function saveOrder(paymentMethod = '', referenceNumber = null, proofOfPayment = null) {
            const customerName = document.getElementById('customer-name').value || 'Guest';
            const customerEmail = document.getElementById('customer-email').value || '';
            const customerPhone = document.getElementById('customer-phone').value || '';
            const deliveryMethod = document.getElementById('delivery_method').value || 'pickup';
            const paymentAmount = paymentMethod === 'cash' ? parseFloat(document.getElementById('cash-amount').value) : null;

            if (!paymentMethod) {
                alert('Please select a payment method and confirm payment!');
                return;
            }

            const orderData = new FormData(); // Use FormData for file uploads
            orderData.append('customer_name', customerName);
            orderData.append('email', customerEmail);
            orderData.append('phone', customerPhone);
            orderData.append('delivery_method', deliveryMethod);
            orderData.append('total_amount', totalAmount);
            orderData.append('payment_method', paymentMethod);
            if (referenceNumber) orderData.append('reference_number', referenceNumber);
            if (proofOfPayment) orderData.append('proof_of_payment', proofOfPayment);
            if (paymentAmount) orderData.append('amount_paid', paymentAmount); // Include payment amount
            orderData.append('status', 'completed');
            orderData.append('cart', JSON.stringify(cart)); // Include cart details as JSON string

            fetch('/save-order', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: orderData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update bill details to show payment method and amount paid
                        const billDetails = document.getElementById('bill-details');
                        const paymentRow = `
                <tr>
                    <td colspan="3"><strong>Payment Method:</strong> ${paymentMethod}</td>
                    <td colspan="2">${paymentAmount ? `Amount Paid: ₱${paymentAmount.toFixed(2)}` : ''}</td>
                </tr>`;
                        billDetails.innerHTML += paymentRow;

                        alert('Order saved successfully!');
                        // Clear the cart and reset the UI
                        cart = [];
                        updateBillDetails();
                        document.getElementById('cash-section').classList.add('d-none');
                        document.getElementById('gcash-section').classList.add('d-none');
                    } else {
                        alert('Failed to save order.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function processTransaction() {
            const paymentMethod = document.getElementById('payment_method').value;
            const customerName = document.getElementById('customer_name').value || 'Guest';
            const email = document.getElementById('email').value || '';
            const phone = document.getElementById('phone').value || '';
            const deliveryMethod = document.getElementById('delivery_method').value || 'pickup';
            const cashAmount = paymentMethod === 'cash' ? parseFloat(document.getElementById('cash-amount').value) : null;
            const referenceNumber = paymentMethod === 'gcash' ? document.getElementById('gcash_reference_number').value : null;
            const proofOfPayment = paymentMethod === 'gcash' ? document.getElementById('gcash_proof').files[0] : null;

            // Validation
            if (!paymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            if (paymentMethod === 'cash' && cashAmount < totalAmount) {
                alert('Insufficient payment amount for cash.');
                return;
            }

            if (paymentMethod === 'gcash' && (!referenceNumber || !proofOfPayment)) {
                alert('Please provide a GCash reference number and proof of payment.');
                return;
            }

            // Prepare the data for submission
            const orderData = new FormData();
            orderData.append('customer_name', customerName);
            orderData.append('email', email);
            orderData.append('phone', phone);
            orderData.append('delivery_method', deliveryMethod);
            orderData.append('total_amount', totalAmount);
            orderData.append('payment_method', paymentMethod);
            if (cashAmount) orderData.append('amount_paid', cashAmount);
            if (referenceNumber) orderData.append('reference_number', referenceNumber);
            if (proofOfPayment) orderData.append('proof_of_payment', proofOfPayment);
            orderData.append('status', 'pending');
            orderData.append('cart', JSON.stringify(cart)); // Cart items as JSON string

            // Send the request
            fetch('/save-order', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF Token
                },
                body: orderData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Order placed successfully!');
                        // Reset cart and UI
                        cart = [];
                        updateBillDetails();
                        document.getElementById('cash-section').classList.add('d-none');
                        document.getElementById('gcash-section').classList.add('d-none');
                    } else {
                        alert(`Failed to place order: ${data.message}`);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>