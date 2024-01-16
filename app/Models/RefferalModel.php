<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferalModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_undangan';
    const CREATED_AT = 'und_create';
    const UPDATED_AT = 'und_edit';
    protected $primaryKey  = 'und_id';

    protected $fillable = [
        'und_email', 'und_kode', 'und_exp', 'und_status',  'und_user', 'acara_id', 'und_nama', 'und_kuota_no'
    ];
}
