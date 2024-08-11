@extends('layouts.app')

@section('content')
    <style>
        @media print {
            /* Hide elements that should not be printed */
            .no-print, .page-title-box, .card-body form {
                display: none;
            }
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between no-print">
                        <h4 class="mb-sm-0 font-size-18">Purchase Report</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Purchase</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card no-print">
                <div class="card-body">
                    <h4 class="card-title">Search</h4>
                    <form method="GET" action="{{ route('purchase.report') }}">
                        <div class="row mb-2">
                            <div class="col-sm-5">
                                <label for="from_date">From Date <span class="text text-danger"> *</span></label>
                                <input id="from_date" name="from_date" type="date" class="form-control @error('from_date') is-invalid @enderror" placeholder="Date" value="{{ old('from_date', request()->get('from_date')) }}">
                                @error('from_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <label for="to_date">To Date <span class="text text-danger"> *</span></label>
                                <input id="to_date" name="to_date" type="date" class="form-control @error('to_date') is-invalid @enderror" placeholder="Date" value="{{ old('to_date', request()->get('to_date')) }}">
                                @error('to_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light w-10"> <i class="bx bx-filter-alt me-1"></i> Search</button>
                                <a href="{{ route('purchase.report') }}" class="waves-effect waves-light btn btn-secondary"><i class="bx bx-crosshair me-1"></i> Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                Purchase
                                @if (request()->get('from_date')) From {{request()->get('from_date')}} @endif
                                @if (request()->get('from_date')) To {{request()->get('to_date')}} @endif
                                Report
                            </h4>
                            @if ($data && count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Serial No</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th lass="text-center" width=100>Delivery</th>
                                                <th lass="text-center" width=100>Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPurchase = 0;
                                            @endphp
                                            @foreach ($data as $key => $purchase)
                                                @php
                                                    $totalPurchase += $purchase->price;
                                                @endphp
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $purchase->code }}</td>
                                                    <td>{{ $purchase->date }}</td>
                                                    <td>{{ $purchase->price }}</td>
                                                    <td>{!! getDelivery('status', $purchase->delivery, 'badge') !!}</td>
                                                    <td>{!! getPayment('status', $purchase->payment, 'badge') !!}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="5" class="text-end font-size-18">Total Amount</td>
                                                <td class="text-end font-size-18">{{ $totalPurchase }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}

                                    <div class="d-print-none">
                                        <div class="float-end">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Result Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
