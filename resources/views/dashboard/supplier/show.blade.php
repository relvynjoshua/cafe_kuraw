@extends('layouts.dashboard')

@section('content')
<h1>Supplier Details</h1>
<table class="table">
    @foreach (['ID' => $supplier->id, 
               'Company Name' => $supplier->company_name, 
               'Contact Person' => $supplier->contact_person, 
               'Phone' => $supplier->phone_number, 
               'Email' => $supplier->email, 
               'Address' => $supplier->address] as $field => $value)
        <tr>
            <th>{{ $field }}</th>
            <td>{{ $value ?? 'N/A' }}</td>
        </tr>
    @endforeach
</table>
<a href="{{ route('dashboard.supplier.index') }}" class="btn btn-secondary">Back to Suppliers</a>
@endsection
