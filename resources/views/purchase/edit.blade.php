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
                                                @foreach (getPayment('status') as $key => $status)
                                                    <option value="{{ ++$key }}" @if($key == $purchase->delivery) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="payment">Payment Status <span class="text text-danger"> *</span></label>
                                            <select id="payment_status" name="payment" class="form-control">
                                                <option value="">Select Payment Status </option>
                                                @foreach (getDelivery('status') as $key => $status)
                                                    <option value="{{ ++$key }}" @if($key == $purchase->payment) selected @endif>{{ $status }}</option>
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


                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Materials</h4>
                                                    {{-- <form id="materialForm" class="repeater" enctype="multipart/form-data"> --}}
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
                                                            @foreach ($purchase->materials as $material)
                                                                <div data-repeater-item class="row templateRow">
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
                                                                        <input type="number" name="unit_price[]" class="form-control unit_price" value="{{$material->unit_price}}" placeholder="Enter Unit Price" required/>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-2">
                                                                        <input type="number" name="price[]" class="form-control price" value="{{$material->qty * $material->unit_price}}" placeholder="Enter Price" readonly/>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <button type="button" class="btn btn-danger remove-btn">-</button>
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
                                                                <div class="col-lg-3 offset-lg-9">
                                                                    <label>Total Price:</label>
                                                                    <input type="number" name="total_price" class="form-control price" value="{{ $purchase->price }}" id="totalPrice" readonly/>
                                                                </div>
                                                                <div class="col-lg-1"></div>
                                                            </div>
                                                        </div>
                                                    {{-- </form> --}}
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
        // Function to duplicate a row
        function duplicateRow() {
            var template = $('.templateRow').first().clone();
            template.find('input[type="number"]').val(''); // Clear input values
            template.appendTo('[data-repeater-list="group-a"]');
            bindRowEvents(template); // Bind events to new row
            calculateTotalPrice();
        }

        // Function to bind events to a row
        function bindRowEvents(row) {
            row.find('.quantity, .unit_price').on('input', function() {
                calculatePrice(row);
            });

            row.find('.remove-btn').on('click', function() {
                removeMaterial(row);
            });
        }

        // Function to remove a specific row
        function removeMaterial(row) {
            row.remove();
            calculateTotalPrice();
        }

        // Function to calculate price based on quantity and unit price
        function calculatePrice(row) {
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
            var price = quantity * unitPrice;
            row.find('.price').val(price.toFixed(2));
            calculateTotalPrice();
        }

        // Function to calculate total price
        function calculateTotalPrice() {
            var totalPrice = 0;
            $('[name="price[]"]').each(function() {
                totalPrice += parseFloat($(this).val()) || 0;
            });
            $('#totalPrice').val(totalPrice.toFixed(2));
        }

        // Event listener for adding new row
        $('.add-btn').on('click', function() {
            duplicateRow();
        });

        // Initial event binding for the first row
        bindRowEvents($('.templateRow'));

    });
</script>
