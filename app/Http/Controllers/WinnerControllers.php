<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WinnerModel;
use Illuminate\Support\Facades\Hash;

class WinnerControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('akses.admin');
    }

    public function index(Request $request, $user = null)
    {
        return view('winner', compact('user'));
    }

    public function getData(Request $request, $multi)
    {
        $data['data'] = WinnerModel::getwinnerMulti($multi);
        return json_encode($data);
    }
}
