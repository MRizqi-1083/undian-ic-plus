<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_acara';
    protected $primaryKey = 'acara_id';

    public function getstatistik($acaraId)
    {
        $results = collect(DB::select("select xy.acara_id,xy.total_kuota,yz.total_peserta,yz.peserta_checkin from (select acara_id,count(1) as total_kuota from tbl_fd_undangan where acara_id=? group by acara_id) as xy join
(select acara_id,count(1) as total_peserta, sum(case when peserta_hadir is not null then 1 else 0 end) as peserta_checkin from tbl_fd_peserta where acara_id=? group by acara_id) as yz on yz.acara_id=xy.acara_id", [$acaraId, $acaraId]))->first();
        return $results;
    }

    public function getChart($acaraId)
    {
        $results = DB::select("select to_char(peserta_hadir,'HH') as waktu, count(1) as jml from tbl_fd_peserta where acara_id=? and peserta_hadir is not null
group by to_char(peserta_hadir,'HH') order by waktu asc", [$acaraId]);
        return $results;
    }
}
