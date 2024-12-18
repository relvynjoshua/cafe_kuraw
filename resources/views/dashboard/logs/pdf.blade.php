<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #000000;
            color: white;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            max-height: 50px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            flex: 1;
            text-align: center;
        }

        .container {
            padding: 20px;
            max-width: 800px; /* Add a max width */
            margin: 0 auto; /* Center the container */
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: white;
            font-size: 12px; /* Reduced font size for the table */
        }

        th, td {
            padding: 8px; /* Adjusted padding for smaller font */
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #000000;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ asset('assets/img/kuraw/logo.jpg') }}" alt="Kuraw Coffee Shop Logo">
        <h1>Kuraw Coffee Shop</h1>
    </div>

    <!-- Container -->
    <div class="container">
        <h2>{{ $title }}</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Inventory Item</th>
                    <th>Change Type</th>
                    <th>Quantity Changed</th>
                    <th>Remaining Quantity</th>
                    <th>Updated By</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->inventory ? $log->inventory->item_name : 'N/A' }}</td>
                        <td>{{ ucfirst($log->change_type) }}</td>
                        <td>{{ $log->quantity_changed }}</td>
                        <td>{{ $log->remaining_quantity }}</td>
                        <td>{{ $log->user ? $log->user->firstname : 'N/A' }}</td>
                        <td>{{ $log->updated_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
