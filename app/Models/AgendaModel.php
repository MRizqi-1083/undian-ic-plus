<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_itenary';
    const CREATED_AT = 'itenary_create';
    const UPDATED_AT = 'itenary_edit';
    protected $primaryKey  = 'itenary_id';

    protected $fillable = [
        'acara_id', 'itenary_name', 'itenary_mulai', 'itenary_selesai',  'itenary_status', 'itenary_create', 'itenary_by', 'itenary_edit', 'itenary_editby'
    ];
}
