<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_acara';
    const CREATED_AT = 'acara_create_date';
    const UPDATED_AT = 'acara_edit_date';
    protected $primaryKey  = 'acara_id';

    protected $fillable = [
        'acara_nama', 'acara_mulai', 'acara_selesai',  'acara_mulai_checkin', 'acara_selesai_checkin', 'acara_lokasi', 'acara_koordinat', 'acara_banner', 'acara_deskripsi', 'acara_max_kuota_per_peserta', 'acara_status', 'acara_alamat_lokasi', 'acara_pic', 'acara_whatsapp_pic', 'acara_create_by'
    ];
}
