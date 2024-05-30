<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\User;
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
        $data = Data::count();
        $employees = User::where('user_type', 2)->count();
        return view('home', compact('data', 'employees'));
    }
}
