<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranOdp extends Model
{
    use HasFactory;

    protected $table = 'tran_odp';

    protected $fillable = [
        'project_id', 'jenis_odp', 'nama_odp'
    ];
}
