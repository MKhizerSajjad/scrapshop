<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Lorry;
use App\Models\SaleMaterial;
use App\Models\SaleDelivery;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $data = Sale::with('materials')->orderByDesc('code')->paginate(10);

        return view('sale.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $code = $this->generateInvoiceCode();
        $lorries =  Lorry::orderBy('plate_number')->where('status', 1)->get();
        return view('sale.create', compact('code', 'lorries'));
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

        $sale = Sale::create($data);

        $saleId = $sale->id;

        if(isset($request->lorry)) {
            for($i=0; $i<count($request->material); $i++) {
                if(isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                    $data = [
                        'sale_id' => $saleId,
                        'material_id' => $request->material[$i],
                        'qty' => $request->quantity[$i],
                        'unit_price' => $request->unit_price[$i],
                    ];
                    SaleMaterial::create($data);
                }
            }
        }

        for($i=0; $i<count($request->lorry); $i++) {
            if(isset($request->lorry[$i])) { // && isset($request->ship_quantity[$i])
                $data = [
                    'status' => 1,
                    'sale_id' => $saleId,
                    'lorry_id' => $request->lorry[$i],
                    'qty' => 0, //$request->ship_quantity[$i]
                ];
                SaleDelivery::create($data);
            }
        }

        return redirect()->route('sale.index')->with('success','Record created successfully');
    }

    public function show(Sale $sale)
    {
        if (!empty($sale)) {

            $data = [
                'sale' => $sale
            ];
            return view('sale.show', $data);

        } else {
            return redirect()->route('sale.index');
        }
    }

    public function edit(Sale $sale)
    {
        $lorries = Lorry::orderBy('plate_number')->where('status', 1)->get();
        return view('sale.edit', compact('sale', 'lorries'));
    }

    public function update(Request $request, Sale $sale)
    {
        $this->validate($request, [
            'date' => 'required',
        ]);

        $saleId = $sale->id;
        $data = [
            'delivery' => $request->delivery ?? 1,
            'payment' => $request->payment ?? 1,
            'date' => $request->date,
            'price' => $request->total_price,
            'detail' => $request->detail,
        ];

        Sale::find($saleId)->update($data);

        SaleMaterial::where('sale_id', $saleId)->delete();
        for ($i = 0; $i < count($request->material); $i++) {
            if (isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                SaleMaterial::updateOrCreate(
                    [
                        'sale_id' => $saleId,
                        'material_id' => $request->material[$i],
                    ],
                    [
                        'qty' => $request->quantity[$i],
                        'unit_price' => $request->unit_price[$i],
                    ]
                );
            }
        }

        SaleDelivery::where('sale_id', $saleId)->delete();

        if(isset($request->lorry)) {
            for($i=0; $i<count($request->lorry); $i++) {
                if(isset($request->lorry[$i])) { // && isset($request->ship_quantity[$i])
                    $data = [
                        'status' => 1,
                        'sale_id' => $saleId,
                        'lorry_id' => $request->lorry[$i],
                        'qty' => 0, //$request->ship_quantity[$i],
                    ];
                    SaleDelivery::create($data);
                }
            }
        }

        return redirect()->route('sale.index')->with('success','Updated successfully');
    }

    public function destroy(Sale $sale)
    {
        Sale::find($sale->id)->delete();
        return redirect()->route('sale.index')->with('success', 'Deleted successfully');
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = Sale::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
