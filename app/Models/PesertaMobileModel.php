<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $peserta_id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 */
class PesertaMobileModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'peserta_mobil';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'peserta_id';

    /**
     * @var array
     */
    protected $fillable = ['full_name', 'email', 'phone','voucher', 'winner'];

    public $timestamps = false;

    public function getmobil()
    {
        $winner = DB::table('peserta_mobil_temp')
            ->select('*')
            ->whereNotNull('full_name')
            ->limit(100)
            ->inRandomOrder()
            ->get();

        return $winner;
    }
}
