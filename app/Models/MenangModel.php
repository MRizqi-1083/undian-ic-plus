<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $peserta_id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $hadiah
 */
class MenangModel extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'peserta_winner';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'peserta_id';

    /**
     * @var array
     */
    protected $fillable = ['full_name', 'email', 'phone', 'hadiah'];
}
