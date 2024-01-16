<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefferalModel;
use App\Models\LdapModel;

class AmazingControllers extends Controller
{
    public function index(Request $request)
    {

        return view('amazing');
    }

    public function generateRefInd(Request $request)
    {
        if ($request->ajax()) {
            $ldap = new LdapModel();
            $ldapdata = $ldap->ldapMode($request->email, $request->password);

            // var_dump(sizeof($ldap));

            if (!$ldapdata) {
                $resp = [
                    'response' => [
                        'data' => "Email / Password tidak valid!",
                        'success'    => false
                    ]
                ];
                return response()->json($resp, 200);
            }


            $dt = RefferalModel::where("acara_id", 3)->where("und_email", $request->email . "@iconpln.co.id")->first();

            if ($dt) {
                if ($dt->und_user != $request->phone) {
                    $resp = [
                        'response' => [
                            'data' => "Email sudah generate Kode Tiket<br>dengan NO HP berbeda",
                            'success'    => false
                        ]
                    ];
                    return response()->json($resp, 200);
                }
                $resp = [
                    'response' => [
                        'data' => $dt,
                        'success'    => true
                    ]
                ];
                return response()->json($resp, 200);
            }

            $f = substr($request->phone, -2);


            $data = array(
                'und_kode' => strtoupper($f) . strtoupper(substr(md5("1" . microtime(true)), 0, 7)) . "3",
                'und_exp' => date('Y-m-d', strtotime("+1 week")),
                'und_status' => "aktif",
                'acara_id' => 3,
                'und_user' => $request->phone,
                'und_create_by' => 1,
                'und_email' => $ldapdata['icp_email'],
                'und_nama' => $ldapdata['icp_nama'],
                'und_kuota_no' => 1
            );


            try {
                $reff = new RefferalModel();
                $dtn = $reff->insert($data);
                $resp = [
                    'response' => [
                        'data' => $data,
                        'success'    => true
                    ]
                ];
                return response()->json($resp, 200);
            } catch (Exceptions $e) {
                $resp = [
                    'response' => [
                        'data' => "Generate Kode Undangan Gagal",
                        'success'    => false
                    ]
                ];
                return response()->json($resp, 200);
            }
        }
    }

    private function cekuser($user, $pass)
    {
    }
}
