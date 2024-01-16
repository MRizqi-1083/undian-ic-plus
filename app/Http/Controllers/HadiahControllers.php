<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HadiahModel;

class HadiahControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('akses.admin');
    }

    public function create(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;



        $data = array(
            'acara_id'              => $request->acara_id,
            'prize_name'            => $request->prize_name,
            'prize_jenis'           => $request->prize_jenis,
            'prize_quota'           => $request->prize_quota,
            'prize_desc'            => $request->prize_desc,
            'prize_by'              => $session_id,
            'prize_status'          => $request->prize_status
        );

        try {
            HadiahModel::create($data);
            flash()->addSuccess('Proses simpan data hadiah berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses simpan data hadiah gagal!');
            return back();
        }
    }

    public function update(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $datanya = HadiahModel::find($request->prize_id);

        $datanya->prize_name            = $request->prize_name;
        $datanya->prize_desc            = $request->prize_desc;
        $datanya->prize_jenis           = $request->prize_jenis;
        $datanya->prize_status          = $request->prize_status;
        $datanya->prize_quota           = $request->prize_quota;
        $datanya->prize_editby          = $session_id;
        $datanya->prize_edit            = date('Y-m-d H:i:s');

        try {
            $datanya->save();
            flash()->addSuccess('Proses ubah data hadiah berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses ubah data hadiah gagal!');
            return back();
        }
    }
}
