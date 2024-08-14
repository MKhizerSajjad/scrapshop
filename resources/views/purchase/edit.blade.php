@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Purchase</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Purchase</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Update Purchase</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Purchase</h4>
                            <form method="POST" action="{{ route('purchase.update', $purchase->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="number">Searial Number <span class="text text-danger"> *</span></label>
                                            <input id="number" name="number" type="text" class="form-control @error('number') is-invalid @enderror" placeholder="Serial Number" value="#{{ $purchase->code }}" readonly>
                                            @error('number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="date">Date <span class="text text-danger"> *</span></label>
                                            <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" placeholder="Date" value="{{ $purchase->date }}">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="delivery">Delivery Status <span class="text text-danger"> *</span></label>
                                            <select id="delivery_status" name="delivery" class="form-control">
                                                <option value="">Select Delivery Status </option>
                                                @foreach (getDelivery('status') as $key => $status)
                                                    <option value="{{ ++$key }}" @if($key == $purchase->payment) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="payment">Payment Status <span class="text text-danger"> *</span></label>
                                            <select id="payment_status" name="payment" class="form-control">
                                                <option value="">Select Payment Status </option>
                                                @foreach (getPayment('status') as $key => $status)
                                                    <option value="{{ ++$key }}" @if($key == $purchase->delivery) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="detail">Detail </label>
                                            <textarea id="detail" name="detail" rows="2" class="form-control" placeholder="Detail">{{ $purchase->detail }}</textarea>
                                        </div>
                                    </div>

                                    @php
                                        $totalQty = 0;
                                        $totalShipedQty = 0;
                                    @endphp


                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div>
                                                    <h4 class="card-title mb-4">Materials</h4>
                                                    <div data-repeater-list="group-a">
                                                        <!-- Initial template for a single row -->
                                                        <div class="row">
                                                            <div class="mb-3 col-lg-5">
                                                                <label for="material">Material</label>
                                                            </div>
                                                            <div class="mb-3 col-lg-2">
                                                                <label for="quantity">Quantity</label>
                                                            </div>
                                                            <div class="mb-3 col-lg-2">
                                                                <label for="unit_price">Unit Price</label>
                                                            </div>
                                                            <div class="mb-3 col-lg-2">
                                                                <label for="price">Price</label>
                                                            </div>
                                                            <div class="mb-3 col-lg-1">
                                                            </div>
                                                        </div>
                                                        @foreach ($purchase->materials as $materialIndex => $material)
                                                            @php $totalQty += $material->qty; @endphp
                                                            <div data-repeater-item class="row materialTemplateRow">
                                                                <div class="mb-3 col-lg-5">
                                                                    <select id="material" name="material[]" class="form-control" required>
                                                                        <option value="">Select Material </option>
                                                                        @foreach (getMaterials('general') as $key => $status)
                                                                            <option value="{{ ++$key }}"  @if($key == $material->material_id) selected @endif>{{ $status }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-lg-2">
                                                                    <input type="number" name="quantity[]" class="form-control quantity" value="{{$material->qty}}" placeholder="Enter Quantity" required/>
                                                                </div>
                                                                <div class="mb-3 col-lg-2">
                                                                    <input type="number" name="unit_price[]" step="any" class="form-control unit_price" value="{{$material->unit_price}}" placeholder="Enter Unit Price" required/>
                                                                </div>
                                                                <div class="mb-3 col-lg-2">
                                                                    <input type="number" name="price[]" class="form-control price" value="{{$material->qty * $material->unit_price}}" placeholder="Enter Price" readonly/>
                                                                </div>
                                                                <div class="col-lg-1" id="removeMatrial">
                                                                    @if ($materialIndex != 0)
                                                                        <button type="button" class="btn btn-danger remove-btn">-</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- Button to add new rows -->
                                                    <div class="row">
                                                        <div class="col-lg-1 offset-lg-11">
                                                            <button type="button" class="btn btn-success add-btn text-bold">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="row">
                                                            <div class="col-lg-3 offset-lg-6">
                                                                <label>Total Quantity:</label>
                                                                <input type="number" name="total_material" class="form-control price" id="totalMaterial"  value="{{ $totalQty }}"  readonly/>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Total Price:</label>
                                                                <input type="number" name="total_price" class="form-control price" id="totalPrice" value="{{ $purchase->price }}" readonly/>
                                                            </div>
                                                            <div class="col-lg-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-title mb-4">Lorries</h4>
                                                    <div data-repeater-list="group-b">
                                                        <!-- Initial template for a single row -->
                                                        <div class="row">
                                                            <div class="mb-3 col-lg-11">
                                                                <label for="lorry">Lorry</label>
                                                            </div>
                                                            {{-- <div class="mb-3 col-lg-4">
                                                                <label for="quantity">Ship Quantity</label>
                                                            </div> --}}
                                                        </div>
                                                        @foreach ($purchase->deliveries as $delIndex => $delivery)
                                                            @php $totalShipedQty += $delivery->qty; @endphp
                                                            <div data-repeater-item class="row lorryTemplateRow">
                                                                <div class="mb-3 col-lg-11">
                                                                    <select id="lorry" name="lorry[]" class="form-control" required>
                                                                        <option value="">Select Lorry </option>
                                                                        @foreach ($lorries as $key => $lorry)
                                                                            <option value="{{ $lorry->id }}" @if($lorry->id == $delivery->lorry_id) selected @endif >{{ $lorry->plate_number }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                {{-- <div class="mb-3 col-lg-4">
                                                                    <input type="number" name="ship_quantity[]" class="form-control ship_quantity" placeholder="Enter Quantity" value="{{$delivery->qty}}" required/>
                                                                </div> --}}
                                                                <div class="col-lg-1" id="removeLorry">
                                                                    @if ($delIndex != 0)
                                                                        <button type="button" class="btn btn-danger remove-lorry-btn">
                                                                            <i class="bx bx-minus-circle me-1"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- Button to add new rows -->
                                                    <div class="row">
                                                        <div class="col-lg-1 offset-lg-11">
                                                            <button type="button" class="btn btn-success add-lorry-btn text-bold">
                                                                <i class="bx bx-plus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="mt-3">
                                                        <div class="row">
                                                            <div class="col-lg-3 offset-lg-9">
                                                                <label>Total Ship Quantity:</label>
                                                                <input type="number" name="total_ship_quantity" class="form-control price" id="totoalShipQuantity" value="{{$totalShipedQty}}" readonly/>
                                                            </div>
                                                            <div class="col-lg-1"></div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('purchase.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Material
        // Function to duplicate a row
        function duplicateRow() {
            var template = $('.materialTemplateRow').first().clone();
            template.find('input[type="number"]').val(''); // Clear input values
            template.appendTo('[data-repeater-list="group-a"]');
             // Add a remove button to the new row
            template.find('#removeMatrial').html('<button type="button" class="btn btn-danger remove-btn"><i class="bx bx-minus-circle me-1"></i></button>');

            bindMaterialRowEvents(template); // Bind events to new row
            calculateTotalPrice();
        }

        // Function to bind events to a row
        function bindMaterialRowEvents(row) {
            row.find('.quantity, .unit_price').on('input', function() {
                calculatePrice(row);
                calculateTotalMaterial();
            });

            row.find('.remove-btn').on('click', function() {
                removeMaterial(row);
            });
        }

        // Function to remove a specific row
        function removeMaterial(row) {
            row.remove();
            calculateTotalPrice();
            calculateTotalMaterial();
        }

        // Function to calculate price based on quantity and unit price
        function calculatePrice(row) {
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
            var price = quantity * unitPrice;
            row.find('.price').val(price.toFixed(2));
            calculateTotalPrice();
            calculateTotalMaterial();
        }

        // Function to calculate total price
        function calculateTotalPrice() {
            var totalPrice = 0;
            $('[name="price[]"]').each(function() {
                totalPrice += parseFloat($(this).val()) || 0;
            });
            $('#totalPrice').val(totalPrice.toFixed(2));
        }

        // Function to calculate total material
        function calculateTotalMaterial() {
            var totalMaterial = 0;
            $('[name="quantity[]"]').each(function() {
                totalMaterial += parseFloat($(this).val()) || 0;
            });
            $('#totalMaterial').val(totalMaterial.toFixed(2));
        }

        // Event listener for adding new row
        $('.add-btn').on('click', function() {
            duplicateRow();
        });

        // Initial event binding for the first row
        bindMaterialRowEvents($('.materialTemplateRow'));


        // Lorry
        // Function to duplicate a row
        function duplicateLorryRow() {
            var template = $('.lorryTemplateRow').first().clone();
            template.find('input[type="number"]').val(''); // Clear input values
            template.appendTo('[data-repeater-list="group-b"]');
            // Add a remove button to the new row
            template.find('#removeLorry').html('<button type="button" class="btn btn-danger remove-lorry-btn"><i class="bx bx-minus-circle me-1"></i></button>');

            bindLorryRowEvents(template); // Bind events to new row
            calculateShipQty();
        }

        // Function to bind events to a row
        function bindLorryRowEvents(row) {
            row.find('.ship_quantity').on('input', function() {
                calculateShipQty(row);
                // calculateTotalMaterial();
            });

            row.find('.remove-lorry-btn').on('click', function() {
                removeMaterial(row);
            });
        }

        // Function to remove a specific row
        function removeMaterial(row) {
            row.remove();
            calculateShipQty();
            // calculateTotalMaterial();
        }

        // Function to calculate total ship_quantity
        function calculateShipQty() {
            var totalPrice = 0;
            $('[name="ship_quantity[]"]').each(function() {
                totalPrice += parseFloat($(this).val()) || 0;
            });
            $('#totoalShipQuantity').val(totalPrice.toFixed(2));
        }

        // Event listener for adding new row
        $('.add-lorry-btn').on('click', function() {
            duplicateLorryRow();
        });

        // Initial event binding for the first row
        bindLorryRowEvents($('.lorryTemplateRow'));

    });
</script>

