<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HadiahModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_prize';
    const CREATED_AT = 'prize_create';
    const UPDATED_AT = 'prize_edit';
    protected $primaryKey  = 'prize_id';

    protected $fillable = [
        'acara_id', 'prize_name', 'prize_jenis', 'prize_status',  'prize_create', 'prize_by', 'prize_edit', 'prize_editby', 'prize_quota', 'prize_desc'
    ];
}
