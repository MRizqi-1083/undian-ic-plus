<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\EventsModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Carbon\Carbon;

class AuthControllers extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('sesi')) {
            //$data = EventsModel::whereDate('acara_mulai', '<=', Carbon::today()->toDateString())->whereDate('acara_selesai', '>=', Carbon::today()->toDateString())->get();
            $data = EventsModel::where('acara_status', 'aktif')->get();
            return view('dashboard', compact('data'));
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|min:5|email|max:100',
                'password' => 'required|string|min:4',
            ],
            [
                'required'  => ':attribute harus diisi',
                'min'       => ':attribute minimal :min karakter',
            ]
        );

        if ($validator->fails()) {
            return redirect('/')->withFail($validator->errors()->first());
        }

        $user = UsersModel::where('person_email', $request->email)->where('person_role', 'admin')->first();
        if ($user) {
            if (Hash::check($request->password, $user->person_password)) {
                $time = date('Y-m-d H:i:s');
                $request->session()->push("sesi", $user);
                return redirect('/');
            } else {
                return redirect('/')->withFail("Password tidak sesuai!");
            }
        } else {
            return redirect('/')->withFail("Akun email tidak ditemukan!");
        }
    }

    public function actionlogout(Request $request)
    {
        $this->middleware('akses.admin');
        $request->session()->flush();
        return redirect('/');
    }
}
