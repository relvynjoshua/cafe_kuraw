@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add Product</h2>

    <hr class="solid">

    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label fw-bold">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disabled selected>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label fw-bold">Base Price</label>
            <input type="text" name="price" class="form-control" id="price" pattern="\d+(\.\d{1,2})?"
                title="Only numbers and up to two decimal places are allowed" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label fw-bold">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <hr class="solid">

        <div id="variations-container">
            <h4 class="mt-4">Product Variations</h4>
            <div class="variation-row row mb-3">
                <div class="col-md-4">
                    <select name="variations[0][type]" class="form-control variation-type-select" data-index="0"
                        required>
                        <option value="" disabled selected>Select or Enter Product Type</option>
                        <option value="Hot">Hot</option>
                        <option value="Iced">Iced</option>
                        <option value="Serving">Serving</option>
                        <option value="Flavor">Flavor</option>
                        <option value="Spice Level">Spice Level</option>
                        <option value="Manual">Manual Input</option>
                    </select>
                    <input type="text" name="variations[0][type_manual]" class="form-control mt-2 variation-type-manual"
                        placeholder="Enter Type" style="display: none;">
                </div>
                <div class="col-md-4">
                    <select name="variations[0][value]" class="form-control variation-value-select" data-index="0"
                        required>
                        <option value="" disabled selected>Select or Enter Product Size/Flavor</option>
                        <option value="Regular">Regular</option>
                        <option value="Large">Large</option>
                        <option value="16oz">16oz</option>
                        <option value="Mild">Mild</option>
                        <option value="Spicy">Spicy</option>
                        <option value="Custom">Custom Size</option>
                    </select>
                    <input type="text" name="variations[0][value_manual]"
                        class="form-control mt-2 variation-value-manual" placeholder="Enter Size"
                        style="display: none;">
                </div>
                <div class="col-md-4">
                    <input type="text" name="variations[0][price]" class="form-control"
                        placeholder="Additional Price (e.g., 100.00 for Regular, 120.00 for Large)"
                        pattern="\d+(\.\d{1,2})?" title="Only numbers and up to two decimal places are allowed"
                        required>
                </div>
            </div>
        </div>

        <hr class="solid">

        <button type="button" class="btn btn-secondary" id="add-variation-btn">Add Variation</button>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<script>
    let variationIndex = 1;

    document.getElementById('add-variation-btn').addEventListener('click', function () {
        const container = document.getElementById('variations-container');
        const row = document.createElement('div');
        row.classList.add('variation-row', 'row', 'mb-3');

        row.innerHTML = `
            <div class="col-md-4">
                <select name="variations[${variationIndex}][type]" class="form-control variation-type-select" data-index="${variationIndex}" required>
                    <option value="" disabled selected>Select or Enter Product Type</option>
                    <option value="Hot">Hot</option>
                    <option value="Iced">Iced</option>
                    <option value="Serving">Serving</option>
                    <option value="Flavor">Flavor</option>
                    <option value="Spice Level">Spice Level</option>
                    <option value="Manual">Manual Input</option>
                </select>
                <input type="text" name="variations[${variationIndex}][type_manual]" class="form-control mt-2 variation-type-manual" placeholder="Enter Type" style="display: none;">
            </div>
            <div class="col-md-4">
                <select name="variations[${variationIndex}][value]" class="form-control variation-value-select" data-index="${variationIndex}" required>
                    <option value="" disabled selected>Select or Enter Product Size/Flavor</option>
                    <option value="Regular">Regular</option>
                    <option value="Large">Large</option>
                    <option value="16oz">16oz</option>
                    <option value="Mild">Mild</option>
                    <option value="Spicy">Spicy</option>
                    <option value="Custom">Custom Size</option>
                </select>
                <input type="text" name="variations[${variationIndex}][value_manual]" class="form-control mt-2 variation-value-manual" placeholder="Enter Size" style="display: none;">
            </div>
            <div class="col-md-4">
                <input type="text" name="variations[${variationIndex}][price]" class="form-control" placeholder="Additional Price (e.g., 100.00 for Regular, 120.00 for Large)" pattern="\d+(\.\d{1,2})?" title="Only numbers and up to two decimal places are allowed" required>
            </div>
        `;
        container.appendChild(row);
        variationIndex++;
        addTypeSelectListeners();
        addValueSelectListeners();
    });

    function addValueSelectListeners() {
        document.querySelectorAll('.variation-value-select').forEach(select => {
            select.addEventListener('change', function () {
                const index = this.dataset.index;
                const manualInput = document.querySelector(`input[name="variations[${index}][value_manual]"]`);
                if (this.value === 'Custom') {
                    manualInput.style.display = 'block';
                    manualInput.required = true;

                    // Ensure manual input is used instead of the select field
                    this.name = ""; // Clear the name of the dropdown to prevent it from being submitted
                    manualInput.name = `variations[${index}][value]`; // Assign the correct name to manual input
                } else {
                    manualInput.style.display = 'none';
                    manualInput.required = false;

                    // Restore the dropdown's name
                    this.name = `variations[${index}][value]`;
                    manualInput.name = ""; // Clear the manual input's name
                }
            });
        });
    }

    function addTypeSelectListeners() {
        document.querySelectorAll('.variation-type-select').forEach(select => {
            select.addEventListener('change', function () {
                const index = this.dataset.index;
                const manualInput = document.querySelector(`input[name="variations[${index}][type_manual]"]`);
                if (this.value === 'Manual') {
                    manualInput.style.display = 'block';
                    manualInput.required = true;

                    // Ensure manual input is used instead of the select field
                    this.name = ""; // Clear the name of the dropdown to prevent it from being submitted
                    manualInput.name = `variations[${index}][type]`; // Assign the correct name to manual input
                } else {
                    manualInput.style.display = 'none';
                    manualInput.required = false;

                    // Restore the dropdown's name
                    this.name = `variations[${index}][type]`;
                    manualInput.name = ""; // Clear the manual input's name
                }
            });
        });
    }

    addTypeSelectListeners();
    addValueSelectListeners();

</script>

@endsection