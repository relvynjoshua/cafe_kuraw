<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BorrowerController extends Controller
{
    public function index()
    {
        $borrowers = Borrower::all();
        return view('dashboard.borrower.index', compact('borrowers'));
    }

    public function create()
    {
        return view('dashboard.borrower.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('borrowers')->ignore($request->id)],
            'phone' => ['required'],
        ]);

        Borrower::create($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower created successfully!');
    }

    public function show(Borrower $borrower)
    {
        return view('dashboard.borrower.show', compact('borrower'));
    }

    public function edit(Borrower $borrower)
    {
        return view('dashboard.borrower.edit', compact('borrower'));
    }

    public function update(Request $request, Borrower $borrower)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('borrowers')->ignore($borrower->id)],
            'phone' => ['required'],
        ]);

        $borrower->update($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower updated successfully!');
    }

    public function destroy(Borrower $borrower)
    {
        $borrower->delete();
        return redirect()->route('borrowers.index')->with('success', 'Borrower deleted successfully!');
    }

}
