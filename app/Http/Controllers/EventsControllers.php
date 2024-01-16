<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventsModel;
use App\Models\AgendaModel;
use App\Models\HadiahModel;
use App\Models\RefferalModel;
use Illuminate\Routing\UrlGenerator;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportKodeRefferal;
use App\Exports\ExportKodeRefferal;
use Rap2hpoutre\FastExcel\FastExcel;

class EventsControllers extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->middleware('akses.admin');
        $this->url = $url;
    }

    public function index(Request $request, $tipe = null)
    {
        //var_dump($tipe);
        //$data = EventsModel::paginate(4);
        if ($tipe == "cs") {
            $data = EventsModel::whereDate('acara_mulai', '>', Carbon::today()->toDateString())->whereDate('acara_selesai', '>', Carbon::today()->toDateString())->paginate(4);
        } else if ($tipe == "end") {
            $data = EventsModel::whereDate('acara_mulai', '<', Carbon::today()->toDateString())->whereDate('acara_selesai', '<', Carbon::today()->toDateString())->paginate(4);
        } else {
            $data = EventsModel::whereDate('acara_mulai', '<=', Carbon::today()->toDateString())->whereDate('acara_selesai', '>=', Carbon::today()->toDateString())->paginate(4);
        }
        $tipe = $tipe;
        return view('events', compact('data', 'tipe'));
    }

    public function manageEvents(Request $request, $id, $tipe = null, $user = null)
    {
        if ($tipe == "agenda") {
            $data = AgendaModel::where('acara_id', $id)->paginate(10);
            return view('agenda', compact('id', 'tipe', 'data'));
        }
        if ($tipe == "hadiah") {
            $data = HadiahModel::where('acara_id', $id)->paginate(10);
            return view('hadiah', compact('id', 'tipe', 'data'));
        } else {
            $acara = EventsModel::where("acara_id", $id)->first();
            if ($user != "") {
                $data = RefferalModel::where('acara_id', $id)->where(function ($query) use ($user) {
                    $query->where('und_user', 'ilike', "%" . $user . "%")->orWhere('und_nama', 'ilike', "%" . $user . "%");
                })->orderBy('und_nama', 'asc')->orderBy('und_kuota_no', 'asc')->paginate(10);
            } else {
                $data = RefferalModel::where('acara_id', $id)->orderBy('und_nama', 'asc')->orderBy('und_kuota_no', 'asc')->paginate(10);
            }


            return view('manage', compact('id', 'tipe', 'data', 'acara', 'user'));
        }
    }

    public function create(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $data = array(
            'acara_nama'                    => $request->nama_acara,
            'acara_mulai'                   => $request->tgl_mulai_acara,
            'acara_selesai'                 => $request->tgl_selesai_acara,
            'acara_mulai_checkin'           => $request->waktu_mulai_presensi,
            'acara_selesai_checkin'         => $request->waktu_selesai_presensi,
            'acara_lokasi'                  => $request->lokasi_acara,
            'acara_koordinat'               => $request->titik_koordinat,
            'acara_deskripsi'               => $request->deskripsi_acara,
            'acara_max_kuota_per_peserta'   => $request->maks_peserta,
            'acara_status'                  => "aktif",
            'acara_create_by'               => $session_id,
            'acara_alamat_lokasi'           => $request->alamat_lokasi,
            'acara_pic'                     => $request->nama_pic,
            'acara_whatsapp_pic'            => $request->telp_pic
        );

        $link = null;


        for ($i = 1; $i < 6; $i++) {
            if ($request->file('banner_' . $i)) {
                $fileName = time() . '_' . $request->file('banner_' . $i)->getClientOriginalName();
                $path = $request->file('banner_' . $i)->storeAs('files', $fileName, 'public');
                if ($i > 1 && $i < 6) {
                    $link .= ";";
                }
                $link .= asset('storage/files/' . $fileName);
            }
        }


        $data['acara_banner'] = $link;

        try {
            EventsModel::create($data);
            flash()->addSuccess('Proses simpan data acara berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses simpan data acara gagal!');
            return back();
        }
    }

    public function update(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $datanya = EventsModel::find($request->acara_id);

        $datanya->acara_nama                    = $request->nama_acara;
        $datanya->acara_mulai                   = $request->tgl_mulai_acara;
        $datanya->acara_selesai                 = $request->tgl_selesai_acara;
        $datanya->acara_mulai_checkin           = $request->waktu_mulai_presensi;
        $datanya->acara_selesai_checkin         = $request->waktu_selesai_presensi;
        $datanya->acara_lokasi                  = $request->lokasi_acara;
        $datanya->acara_koordinat               = $request->titik_koordinat;
        $datanya->acara_deskripsi               = $request->deskripsi_acara;
        $datanya->acara_max_kuota_per_peserta   = $request->maks_peserta;
        $datanya->acara_status                  = "aktif";
        $datanya->acara_edit_by                 = $session_id;
        $datanya->acara_alamat_lokasi           = $request->alamat_lokasi;
        $datanya->acara_pic                     = $request->nama_pic;
        $datanya->acara_whatsapp_pic            = $request->telp_pic;
        $datanya->acara_edit_date               = date('Y-m-d H:i:s');

        $link = null;


        for ($i = 1; $i < 6; $i++) {
            if ($request->file('banner_' . $i)) {

                $fileName = time() . '_' . $request->file('banner_' . $i)->getClientOriginalName();
                $path = $request->file('banner_' . $i)->storeAs('files', $fileName, 'public');
                if ($i > 1 && $i < 6) {
                    $link .= ";";
                }
                $link .= asset('storage/files/' . $fileName);
            } else {
                if ($request->input('banner_' . $i . '_link')) {
                    if ($i > 1 && $i < 6) {
                        $link .= ";";
                    }
                    $link .= $request->input('banner_' . $i . '_link');
                }
            }
        }


        $datanya->acara_banner = $link;

        try {
            $datanya->save();
            flash()->addSuccess('Proses ubah data acara berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Proses ubah data acara gagal!');
            return back();
        }
    }

    public function generateRefInd(Request $request)
    {

        $session_id = $request->session()->get('sesi')[0]->person_id;
        if ($request->email) {
            if (str_contains($request->email, '@')) {
                $u = explode("@", $request->email);
                $f = substr($u[0], 0, 1);
                $f .= substr($u[0], -1);
            }
        } else {
            $f = substr($request->user, -2);
        }

        for ($i = 0; $i < $request->kuota; $i++) {
            $data[] = array(
                'und_kode' => strtoupper($f) . strtoupper(substr(md5($i . microtime(true)), 0, 7)) . $i,
                'und_exp' => date('Y-m-d', strtotime("+1 week")),
                'und_status' => "aktif",
                'acara_id' => $request->acara_id,
                'und_user' => $request->user,
                'und_create_by' => $session_id,
                'und_email' => $request->email,
                'und_nama' => $request->nama,
                'und_kuota_no' => $i + 1
            );
        }

        try {
            RefferalModel::insert($data);
            flash()->addSuccess('Generate kode refferal berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Generate kode refferal gagal!');
            return back();
        }
    }

    private function rand_uniqid($in, $to_num = false, $pad_up = false, $passKey = null)
    {
        $index = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
        if ($passKey !== null) {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID

            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $passhash = hash('sha256', $passKey);
            $passhash = (strlen($passhash) < strlen($index))
                ? hash('sha512', $passKey)
                : $passhash;

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] =  substr($passhash, $n, 1);
            }

            array_multisort($p,  SORT_DESC, $i);
            $index = implode($i);
        }

        $base  = strlen($index);

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $in  = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a   = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in  = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }

        return $out;
    }

    public function notifikasi()
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $header = [
            'authorization:key=AAAAmEw1fJ4:APA91bE3pnpEiltbyno5Q254V0iSVI0K2Men0lVzSwh6VFPlWnh-Zr39j96q31HWPAXqaNDIU1A5Gw8JsauLHzahUrsWxmx29YilmMFJ-obxoAcP6X8QM5gsa_mqbjSgdc3916FCHTn-',
            'content-type: application/json'
        ];

        $notification = [
            'title' => "Pemenang undian Family Day PLN 2022",
            'body' => "Selamat kepada Alvin,  Mendapatkan Rusah All New",
            'mutable_content' => true,
            'sound' => "Tri-tone",
        ];

        $extraNotificationData = [
            "url" => "none",
            "dl" => "none"
        ];

        $fcmNotification = [
            'to'            => "cVdmIX7YRf-m6jfJ53SQHo:APA91bEomVK1Ax8uSqKAv67PlXR5kVH4mwm9EMd7wOM6M_KZJlyq1k7Dd6SN1oTAlTO3MJFcfgxakup15D7cweypPYJygu0_kdY0P7jUO7Mk_Z57EkR12adyUn5EjfSNJrI7fbUVFtGc",
            'notification'  => $notification,
            'data'          => $extraNotificationData
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function import_excel(Request $request)
    {
        $session_id = $request->session()->get('sesi')[0]->person_id;

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {

            $file = $request->file('file');

            $nama_file = rand() . $file->getClientOriginalName();

            $file->move('file_peserta', $nama_file);

            $collection = (new FastExcel)->import(public_path('/file_peserta/' . $nama_file), function ($line) {
                $f = substr($line['Phone'], -2);
                for ($i = 0; $i < $line['Kuota']; $i++) {
                    RefferalModel::create(
                        [
                            'und_email' => $line['Email'],
                            'und_user' => $line['Phone'],
                            'und_nama' => $line['Nama'],
                            'und_kode' => strtoupper($f) . strtoupper(substr(md5($i . microtime(true)), 0, 7)) . $i,
                            'und_exp' => date('Y-m-d', strtotime("+1 week")),
                            'und_status' => 'aktif',
                            'acara_id' => 3,
                            'und_create_by' => 1,
                            'und_kuota_no' => $i + 1
                        ]
                    );
                };
            });



            //Excel::import(new ImportKodeRefferal($session_id, $request->acara_id), public_path('/file_peserta/' . $nama_file));
            flash()->addSuccess('Generate kode refferal berhasil!');
            return back();
        } catch (Exceptions $e) {
            flash()->addError('Generate kode refferal gagal!');
            return back();
        }
    }

    public function export_excel()
    {
        return Excel::download(new ExportKodeRefferal, 'Invitation Kode.xlsx');
    }
}
