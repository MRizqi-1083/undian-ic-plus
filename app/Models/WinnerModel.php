<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fd_winner';
    protected $primaryKey  = 'winner_id';
}
