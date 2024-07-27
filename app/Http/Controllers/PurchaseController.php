<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lorry;
use App\Models\Purchase;
use App\Models\PurchaseMaterial;
use App\Models\PurchaseDelivery;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $data = Purchase::with('materials')->orderBy('code')->paginate(10);

        return view('purchase.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $code = $this->generateInvoiceCode();
        $lorries = Lorry::orderBy('number')->where('status', 1)->get();
        return view('purchase.create', compact('code', 'lorries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
        ]);

        $code = $this->generateInvoiceCode();

        $data = [
            'delivery' => $request->delivery ?? 1,
            'payment' => $request->payment ?? 1,
            'date' => $request->date,
            'code' => $code,
            'price' => $request->total_price,
            'detail' => $request->detail,
        ];

        $purchase = Purchase::create($data);

        $purchaseId = $purchase->id;

        for($i=0; $i<count($request->material); $i++) {
            if(isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                $data = [
                    'purchase_id' => $purchaseId,
                    'material_id' => $request->material[$i],
                    'qty' => $request->quantity[$i],
                    'unit_price' => $request->unit_price[$i],
                ];
                PurchaseMaterial::create($data);
            }
        }

        for($i=0; $i<count($request->lorry); $i++) {
            if(isset($request->lorry[$i]) && isset($request->ship_quantity[$i])) {
                $data = [
                    'status' => 1,
                    'purchase_id' => $purchaseId,
                    'lorry_id' => $request->lorry[$i],
                    'qty' => $request->ship_quantity[$i],
                ];
                PurchaseDelivery::create($data);
            }
        }

        return redirect()->route('purchase.index')->with('success','Record created successfully');
    }

    public function show(Purchase $purchase)
    {
        if (!empty($purchase)) {

            $data = [
                'purchase' => $purchase
            ];
            return view('purchase.show', $data);

        } else {
            return redirect()->route('purchase.index');
        }
    }

    public function edit(Purchase $purchase)
    {
        $lorries = Lorry::orderBy('number')->where('status', 1)->get();
        return view('purchase.edit', compact('purchase', 'lorries'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'date' => 'required',
        ]);

        $purchaseId = $purchase->id;
        $data = [
            'delivery' => $request->delivery ?? 1,
            'payment' => $request->payment ?? 1,
            'date' => $request->date,
            'price' => $request->total_price,
            'detail' => $request->detail,
        ];

        Purchase::find($purchaseId)->update($data);

        PurchaseMaterial::where('purchase_id', $purchaseId)->delete();
        for ($i = 0; $i < count($request->material); $i++) {
            if (isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                PurchaseMaterial::updateOrCreate(
                    [
                        'purchase_id' => $purchaseId,
                        'material_id' => $request->material[$i],
                    ],
                    [
                        'qty' => $request->quantity[$i],
                        'unit_price' => $request->unit_price[$i],
                    ]
                );
            }
        }

        PurchaseDelivery::where('purchase_id', $purchaseId)->delete();
        for($i=0; $i<count($request->lorry); $i++) {
            if(isset($request->lorry[$i]) && isset($request->ship_quantity[$i])) {
                $data = [
                    'status' => 1,
                    'purchase_id' => $purchaseId,
                    'lorry_id' => $request->lorry[$i],
                    'qty' => $request->ship_quantity[$i],
                ];
                PurchaseDelivery::create($data);
            }
        }

        return redirect()->route('purchase.index')->with('success','Updated successfully');
    }

    public function destroy(Purchase $purchase)
    {
        Purchase::find($purchase->id)->delete();
        return redirect()->route('purchase.index')->with('success', 'Deleted successfully');
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = Purchase::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
