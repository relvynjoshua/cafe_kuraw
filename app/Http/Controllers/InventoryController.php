<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    // Show the list of inventories
    public function index(Request $request)
    {
        try {
            // Get search query
            $search = $request->input('search');

            // Fetch inventories with categories and suppliers, and apply search filters
            $inventories = Inventory::with(['category', 'supplier'])
                ->when($search, function ($query, $search) {
                    $query->where('item_name', 'like', "%$search%")
                        ->orWhere('price', 'like', "%$search%")
                        ->orWhere('location', 'like', "%$search%")
                        ->orWhereHas('category', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('supplier', function ($q) use ($search) {
                            $q->where('company_name', 'like', "%$search%");
                        });
                })
                ->orderBy('id', 'DESC')
                ->paginate(10); // Adjust pagination size as needed

            return view('dashboard.inventory.index', compact('inventories'));
        } catch (\Exception $e) {
            Log::error("Failed to retrieve inventories: " . $e->getMessage());
            return redirect()->back()->withErrors('Could not load inventories at this time.');
        }
    }

    // Show the form to add a new inventory item
    public function create()
    {
        $categories = Category::all(); // Fetch categories for dropdown
        $suppliers = Supplier::all(); // Fetch suppliers for dropdown
        return view('dashboard.inventory.create', compact('categories', 'suppliers'));
    }

    // Store a new inventory item in the database
    public function store(Request $request)
{
    Log::info('Incoming request for inventory creation:', $request->all()); // Debug log

    $this->validateInventory($request);

    try {
        $inventory = Inventory::create($request->only([
            'item_name',
            'quantity',
            'unit',
            'price',
            'expiry_date',
            'supplier_id', // Ensure it matches the database field
            'description',
            'category_id', // Ensure it matches the database field
            'location',
        ]));

        Log::info('Inventory created successfully:', $inventory->toArray()); // Debug log

        return redirect()->route('dashboard.inventory.index')
            ->with('success', 'Inventory item created successfully.');
    } catch (\Exception $e) {
        Log::error("Error while creating inventory item: {$e->getMessage()}");
        return redirect()->back()->withErrors('Failed to create inventory item.');
    }
}

    // Show a single inventory item
    public function show($id)
    {
        $inventory = Inventory::with(['category', 'supplier'])->findOrFail($id);
        return view('dashboard.inventory.show', compact('inventory'));
    }

    // Show the form to edit an existing inventory item
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $categories = Category::all(); // Fetch categories for dropdown
        $suppliers = Supplier::all(); // Fetch suppliers for dropdown
        return view('dashboard.inventory.edit', compact('inventory', 'categories', 'suppliers'));
    }

    // Update an existing inventory item in the database
    public function update(Request $request, $id)
    {
        $this->validateInventory($request);

        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->update($request->only([
                'item_name',
                'quantity',
                'unit',
                'price',
                'expiry_date',
                'supplier_id', // Save supplier_id
                'description',
                'category_id', // Save category_id
                'location',
            ]));

            return redirect()->route('dashboard.inventory.index')
                ->with('success', 'Inventory item updated successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to update inventory item: ", ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Failed to update inventory item.');
        }
    }

    // Delete an inventory item from the database
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return redirect()->route('dashboard.inventory.index')
                ->with('success', 'Inventory item deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to delete inventory item: ", ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Failed to delete inventory item.');
        }
    }

    // Validation rules for inventory
    protected function validateInventory(Request $request)
{
    $request->validate([
        'item_name' => ['required', 'string', 'max:255'],
        'quantity' => ['required', 'integer', 'min:1'],
        'unit' => ['required', 'string', 'max:50'],
        'price' => ['required', 'numeric', 'min:0'],
        'expiry_date' => ['nullable', 'date'],
        'supplier_id' => ['required', 'exists:suppliers,id'], // Validate supplier_id
        'description' => ['nullable', 'string'],
        'category_id' => ['required', 'exists:categories,id'], // Validate category_id
        'location' => ['nullable', 'string', 'max:255'],
    ]);
}
}
