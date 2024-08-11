<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;

class ReportingController extends Controller
{

    public function purchase(Request $request)
    {
       $this->validate($request, [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $data = Purchase::with('materials')->orderByDesc('code');

        if ($fromDate) {
            $data = $data->whereDate('date', '>=', $fromDate);
        }

        if ($toDate) {
            $data = $data->whereDate('date', '<=', $toDate);
        }

        $data = $data->paginate(50);

        return view('purchase.report',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function sale(Request $request)
    {

       $this->validate($request, [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $data = Sale::with('materials')->orderByDesc('code');

        if ($fromDate) {
            $data = $data->whereDate('date', '>=', $fromDate);
        }

        if ($toDate) {
            $data = $data->whereDate('date', '<=', $toDate);
        }

        $data = $data->paginate(50);

        return view('sale.report',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
