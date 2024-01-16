<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaModel;

class AgendaControllers extends Controller
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
            'itenary_name'          => $request->itenary_name,
            'itenary_mulai'         => $request->itenary_mulai,
            'itenary_selesai'       => $request->itenary_selesai,
            'itenary_by'            => $session_id,
            'person_status'         => $request->itenary_status
        );

        try {
            AgendaModel::create($data);
            flash()->addSuccess('Proses simpan agenda berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses simpan agenda gagal!');
            return back();
        }
    }

    public function update(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $datanya = AgendaModel::find($request->itenary_id);

        $datanya->itenary_name          = $request->itenary_name;
        $datanya->itenary_mulai         = $request->itenary_mulai;
        $datanya->itenary_selesai       = $request->itenary_selesai;
        $datanya->itenary_status        = $request->itenary_status;
        $datanya->itenary_editby        = $session_id;
        $datanya->itenary_edit          = date('Y-m-d H:i:s');

        try {
            $datanya->save();
            flash()->addSuccess('Proses ubah agenda berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses ubah agenda gagal!');
            return back();
        }
    }
}
