<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('dashboard.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('dashboard.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        Supplier::create($request->all());
        return redirect()->route('suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        return view('dashboard.supplier.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('dashboard.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $supplier->update($request->all());
        return redirect()->route('suppliers.index');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index');
    }

}
