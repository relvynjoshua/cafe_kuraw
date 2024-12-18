<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Log as InventoryLog;

class InventoryController extends Controller
{
    // Show the list of inventories
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');

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
                ->paginate(10);

            return view('dashboard.inventory.index', compact('inventories'));
        } catch (\Exception $e) {
            Log::error("Failed to retrieve inventories: " . $e->getMessage());
            return redirect()->back()->withErrors('Could not load inventories at this time.');
        }
    }

    // Show the form to add a new inventory item
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.inventory.create', compact('categories', 'suppliers'));
    }

    // Store a new inventory item in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'unit' => 'required|string|max:50',
            'price' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'supplier_id' => 'required|exists:suppliers,id', // Ensure the supplier exists
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'description' => 'nullable|string|max:500', // Added description field
            'location' => 'nullable|string|max:255',
        ]);

        // Create a new inventory item
        Inventory::create($validated);

        return redirect()->route('dashboard.inventory.index')
            ->with(['success' => 'Inventory item added successfully', 'alert' => 'alert-success']);
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
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.inventory.edit', compact('inventory', 'categories', 'suppliers'));
    }

    // Update an existing inventory item in the database
    public function update(Request $request, $id)
    {
        $this->validateInventory($request);

        try {
            $inventory = Inventory::findOrFail($id);

            // Update the inventory item
            $inventory->update($request->only([
                'item_name',
                'quantity',
                'unit',
                'price',
                'expiry_date',
                'supplier_id',
                'description', // Include description here
                'category_id',
                'location',
            ]));

            return redirect()->route('dashboard.inventory.index')
                ->with(['success' => 'Inventory item updated successfully.', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            Log::error("Failed to update inventory item: ", ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Failed to update inventory item.');
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'quantity' => 'required|integer',
            'change_type' => 'required|in:add,subtract',
        ]);

        // Find the inventory item
        $inventory = Inventory::findOrFail($id);

        // Calculate the new quantity
        if ($request->change_type === 'add') {
            $inventory->quantity += $request->quantity;
        } elseif ($request->change_type === 'subtract') {
            // Ensure the quantity doesn't go below zero
            if ($inventory->quantity - $request->quantity < 0) {
                return redirect()->back()->with('error', 'Cannot subtract more than the available quantity.');
            }
            $inventory->quantity -= $request->quantity;
        }

        // Save the updated quantity
        $inventory->save();

        // Log the change (optional)
        InventoryLog::create([
            'inventory_id' => $inventory->id,
            'change_type' => $request->change_type === 'add' ? 'added' : 'subtracted',
            'quantity_changed' => $request->quantity,
            'remaining_quantity' => $inventory->quantity,
            'updated_by' => auth()->id(),
        ]);

        // Return success message
        return redirect()->back()->with('success', 'Quantity updated successfully!');
    }


    // Delete an inventory item from the database
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return redirect()->route('dashboard.inventory.index')
                ->with(['success' => 'Inventory item deleted successfully.', 'alert' => 'alert-danger']);
        } catch (\Exception $e) {
            Log::error("Failed to delete inventory item: ", ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Failed to delete inventory item.');
        }
    }

    public function restore($id)
    {
        try {
            $inventory = Inventory::withTrashed()->findOrFail($id);
            $inventory->restore();

            return redirect()->route('dashboard.inventory.index')
                ->with(['success' => 'Inventory item restored successfully.', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            Log::error("Failed to restore inventory item: ", ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Failed to restore inventory item.');
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
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'description' => ['nullable', 'string', 'max:500'], // Added description validation
            'category_id' => ['required', 'exists:categories,id'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
