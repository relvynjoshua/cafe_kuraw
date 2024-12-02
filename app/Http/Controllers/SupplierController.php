<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // Show the list of suppliers
    public function index(Request $request)
    {
        // Get search query
        $search = $request->input('search');

        // Fetch suppliers with optional search filters
        $suppliers = Supplier::when($search, function ($query, $search) {
            $query->where('company_name', 'like', "%$search%")
                ->orWhere('contact_person', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->orderBy('id', 'DESC')
        ->paginate(10); // Adjust pagination size as needed

        return view('dashboard.supplier.index', compact('suppliers'));
    }

    // Show the form to add a new supplier
    public function create()
    {
        return view('dashboard.supplier.create');
    }

    // Store a new supplier in the database
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:suppliers,email',
            'address' => 'required|string|max:500',
        ]);

        Supplier::create([
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('dashboard.supplier.index')->with([
            'message' => 'Supplier added successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Show the form to edit an existing supplier
    public function edit(Supplier $supplier)
    {
        return view('dashboard.supplier.edit', compact('supplier'));
    }

    // Update an existing supplier in the database
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'address' => 'required|string|max:500',
        ]);

        $supplier->update($request->all());

        return redirect()->route('dashboard.supplier.index')->with([
            'message' => 'Supplier updated successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Delete a supplier from the database
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('dashboard.supplier.index')->with([
            'message' => 'Supplier deleted successfully!',
            'alert' => 'alert-danger',
        ]);
    }
}
