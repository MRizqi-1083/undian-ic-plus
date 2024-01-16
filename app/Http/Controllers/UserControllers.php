<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;

class UserControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('akses.admin');
    }

    public function index(Request $request,$user = null)
    {
         if ($user != "") {
      $data = UsersModel::where('person_name','ilike', "%" . $user . "%")->orWhere('person_email','ilike', "%" . $user . "%")->orWhere('person_phone','ilike', "%" . $user . "%")->orderBy('person_name', 'asc')->paginate(10);
         }else{
      $data = UsersModel::paginate(10);
         }
           return view('users', compact('data', 'user'));
    }

    public function create(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $pwd = Hash::make($request->password);

        $data = array(
            'person_name'            => $request->nama_user,
            'person_password'        => $pwd,
            'person_email'           => $request->email,
            'person_phone'           => $request->phone,
            'person_register_by'     => $session_id,
            'person_role'            => $request->role,
            'person_status'           => "aktif"
        );

        try {
            UsersModel::create($data);
            flash()->addSuccess('Proses simpan data user berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses simpan data user gagal!');
            return back();
        }
    }

    public function change(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $datanya = UsersModel::find($request->person_id);
        $pwd = Hash::make($request->password);

        $datanya->person_password       = $pwd;
        $datanya->person_edit_by        = $session_id;
        $datanya->person_edit_date      = date('Y-m-d H:i:s');

        try {
            $datanya->save();
            flash()->addSuccess('Proses ubah password user berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses ubah password user gagal!');
            return back();
        }
    }

    public function update(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $datanya = UsersModel::find($request->person_id);

        $datanya->person_name           = $request->nama_user;
        $datanya->person_email          = $request->email;
        $datanya->person_phone          = $request->phone;
        $datanya->person_role           = $request->role;
        $datanya->person_status         = $request->status;
        $datanya->person_edit_by        = $session_id;
        $datanya->person_edit_date      = date('Y-m-d H:i:s');

        try {
            $datanya->save();
            flash()->addSuccess('Proses ubah data user berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses ubah data user gagal!');
            return back();
        }
    }
}
