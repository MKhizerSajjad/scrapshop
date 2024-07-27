<?php

namespace App\Http\Controllers;
use App\Models\Lorry;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = json_decode('{}');
        $data->lorry = Lorry::count();
        $data->purchase = Purchase::count();
        $data->sale = Sale::count();
        return view('home', compact('data'));
    }
}
