<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstWitel extends Model
{
    use HasFactory;

    protected $table = 'mst_witel';

    protected $fillable = [
        'code', 'name', 'desc', 'active'
    ];

 
}
