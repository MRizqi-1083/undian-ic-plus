<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    protected $table = "tbl_fd_user";
    protected $primaryKey  = 'person_id';
    const CREATED_AT = 'person_register_date';
    const UPDATED_AT = 'person_edit_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_name', 'person_email', 'person_phone', 'person_status',  'person_register_by', 'person_edit_date', 'person_edit_by', 'person_photo', 'person_role', 'person_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'person_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
}
