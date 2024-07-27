<?php

namespace App\Http\Controllers;

use App\Models\Lorry;
use Illuminate\Http\Request;

class LorryController extends Controller
{
    public function index(Request $request)
    {
        $data = Lorry::orderBy('plate_number')->paginate(10);

        return view('lorry.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('lorry.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'phone' => 'required',
            'nric' => 'required',
            'plate_number' => 'required',
            'capacity' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'phone' => $request->phone,
            'nric' => $request->nric,
            'plate_number' => $request->plate_number,
            'capacity' => $request->capacity,
            'detail' => $request->detail,
        ];

        Lorry::create($data);

        return redirect()->route('lorry.index')->with('success','Record created successfully');
    }

    public function show(Lorry $lorry)
    {
        if (!empty($lorry)) {

            $data = [
                'lorry' => $lorry
            ];
            return view('lorry.show', $data);

        } else {
            return redirect()->route('lorry.index');
        }
    }

    public function edit(Lorry $lorry)
    {
        return view('lorry.edit', compact('lorry'));
    }

    public function update(Request $request, Lorry $lorry)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'phone' => 'required',
            'nric' => 'required',
            'plate_number' => 'required',
            'capacity' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'phone' => $request->phone,
            'nric' => $request->nric,
            'plate_number' => $request->plate_number,
            'capacity' => $request->capacity,
            'detail' => $request->detail,
        ];

        $updated = Lorry::find($lorry->id)->update($data);

        return redirect()->route('lorry.index')->with('success','Updated successfully');
    }

    public function destroy(Lorry $lorry)
    {
        Lorry::find($lorry->id)->delete();
        return redirect()->route('lorry.index')->with('success', 'Deleted successfully');
    }
}
