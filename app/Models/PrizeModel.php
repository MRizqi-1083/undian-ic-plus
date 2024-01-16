<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $prize_id
 * @property string $prize_nama
 * @property integer $prize_jml
 * @property string $prize_status
 */
class PrizeModel extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prize';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'prize_id';

    /**
     * @var array
     */
    protected $fillable = ['prize_nama', 'prize_jml', 'prize_status'];
}
