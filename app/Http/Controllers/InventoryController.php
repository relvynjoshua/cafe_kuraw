<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public function index()
    {
        try {
            $inventories = Inventory::all();
            return view('dashboard.inventory.index', compact('inventories'));
        } catch (\Exception $e) {
            Log::error("Failed to retrieve inventories: " . $e->getMessage());
            return redirect()->back()->withErrors('Could not load inventories at this time.');
        }
    }

    public function create()
    {
        return view('dashboard.inventory.create');
    }

    public function store(Request $request)
    {
        $this->validateInventory($request);

        try {
            Inventory::create($request->all());
            return redirect()->route('dashboard.inventory.index')->with('success', 'Inventory item created successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to create inventory item: " . $e->getMessage());
            return redirect()->back()->withErrors('Failed to create inventory item.');
        }
    }

    public function show(Inventory $inventory)
    {
        return view('dashboard.inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('dashboard.inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $this->validateInventory($request);

        try {
            $inventory->update($request->all());
            return redirect()->route('dashboard.inventory.index')->with('success', 'Inventory item updated successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to update inventory item: " . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update inventory item.');
        }
    }

    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();
            return redirect()->route('dashboard.inventory.index')->with('success', 'Inventory item deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to delete inventory item: " . $e->getMessage());
            return redirect()->back()->withErrors('Failed to delete inventory item.');
        }
    }

    /**
     * Validate the inventory data
     */
    protected function validateInventory(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'expiry_date' => ['nullable', 'date'],
            'supplier' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255']
        ]);
    }
}
