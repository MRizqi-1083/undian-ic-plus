<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PesertaModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_peserta';
    protected $primaryKey  = 'peserta_id';
    public $timestamps = false;

    public function getwinner()
    {
        $winner = DB::table($this->table)
            ->join("tbl_fd_user", "tbl_fd_peserta.person_id", "=", "tbl_fd_user.person_id")
            ->select('tbl_fd_peserta.*', 'tbl_fd_user.person_phone')
            ->where("acara_id", 3)
            ->whereNull('undian')
            ->whereNotNull('peserta_hadir')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getwinnerMulti($no)
    {

        $winner = DB::table($this->table)
            ->join("tbl_fd_user", "tbl_fd_peserta.person_id", "=", "tbl_fd_user.person_id")
            ->select('tbl_fd_peserta.*', 'tbl_fd_user.person_phone')
            ->where("acara_id", 3)
            ->whereNull('undian')
            ->whereNotNull('peserta_hadir')
            ->limit($no)
            ->inRandomOrder()
            ->get();

        return $winner;
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

    public function getmotor()
    {
        $winner = DB::table('peserta_motor')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getsepeda()
    {
        $winner = DB::table('peserta_sepeda')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function gettv()
    {
        $winner = DB::table('peserta_tv')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getac()
    {
        $winner = DB::table('peserta_ac')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getoven()
    {
        $winner = DB::table('peserta_oven')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getmicrowive()
    {
        $winner = DB::table('peserta_oven')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getkorsel()
    {
        $winner = DB::table('peserta_korsel')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getbali()
    {
        $winner = DB::table('peserta_bali')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getlombok()
    {
        $winner = DB::table('peserta_lombok')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getumrah()
    {
        $winner = DB::table('peserta_umrah')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getkompor()
    {
        $winner = DB::table('peserta_kompor')
            ->select('*')->distinct()
            ->whereNotNull('full_name')
            ->where("email", 'not like', '%@example.com')
            ->limit(500)
            ->inRandomOrder()
            ->get();

        return $winner;
    }

    public function getultah()
    {
        $winner = DB::table('ic_presensi')
            ->select('*')->distinct()
            ->whereNotNull('nama')
            ->whereNull('hadiah')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }
    public function menangUltah($email, $hadiah)
    {
        $winner = DB::table('ic_presensi')->select('*')->where('email', $email)->update(['hadiah' => $hadiah]);

        return $winner;
    }
}
