<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaMobileModel;
use App\Models\PesertaModel;
use App\Models\MenangModel;

class UndianControllers extends Controller
{
    public function gp(Request $request)
    {
        $data = new PesertaModel();
        $dtnya = $data->getmotor();
        // dd($dtnya);
        return view('23', compact('dtnya'));
    }

    public function dp(Request $request, $no = null)
    {
        $data = new PesertaModel();
        if ($no == 0) {
            $jml = 1;
            $oke = $data->getultah();
            $jdl = "MOTOR LISTRIK";
        } else
        if ($no == 1) {
            $jml = 20;
            $oke = $data->getultah();
            $jdl = "BRIZZI";
        } else if ($no == 2) {
            $jml = 17;
            $oke = $data->getultah();
            $jdl = "TAPCASH";
        } else if ($no == 3) {
            $jml = 7;
            $oke = $data->getultah();
            $jdl = "E-MONEY";
        } else if ($no == 4) {
            $jml = 9;
            $oke = $data->getultah();
            $jdl = "SMART WATCH";
        } else if ($no == 5) {
            $jml = 3;
            $oke = $data->getultah();
            $jdl = "SPEAKERS JBL HORIZON 2, JBL SPEAKER CLIP & JBL WAVE EARBUD";
        } else if ($no == 6) {
            $jml = 2;
            $oke = $data->getultah();
            $jdl = "JAM TANGAN GARMIN";
        } else if ($no == 7) {
            $jml = 2;
            $oke = $data->getultah();
            $jdl = "APPLE AIRPODS";
        } else if ($no == 8) {
            $jml = 2;
            $oke = $data->getultah();
            $jdl = "TIKET PESAWAT PP & HOTEL BINTANG 5 BELITUNG ISLAND";
        } else if ($no == 9) {
            $jml = 1;
            $oke = $data->getultah();
            $jdl = "SMART TV 43 INCH";
        }

        return view('doorprize', compact('oke', 'no', 'jml', 'jdl'));
    }

    public function dp100(Request $request, $no = null)
    {
        $data = new PesertaModel();
        if ($no == 1) {
            $jml = 13;
        } else if ($no == 1) {
            $jml = 12;
        }
        $dtnya = $data->getWinnerMulti($jml);
        return view('doorprize100', compact('dtnya', 'no'));
    }

    public function setWinnerMobil(Request $request)
    {
        $data = PesertaMobileModel::find($request->id);

        $data->winner = 'ionic';
        $data->save();
    }

    public function setMenang(Request $request)
    {
        $data = new PesertaModel();

        for ($i = 0; $i < sizeof($request->peserta_id); $i++) {
            // $data[] = array(
            //     'peserta_id'   => $request->peserta_id[$i],
            //     'full_name'    => $request->full_name[$i],
            //     'phone'        => $request->phone[$i],
            //     'hadiah'       => $request->hadiah[$i],
            // );
            $data->menangUltah($request->email[$i], $request->hadiah[$i]);
        }
        // //$data =new MenangModel();

        // MenangModel::insert($data);
    }
}
