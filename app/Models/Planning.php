<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'tematik', 
        'witel', 
        'sto', 
        'sitename', 
        'port_odp', 
        'total', 
        'value_capex_perport', 
        'mitra', 
        'status_project', 
        'start_date',
        'end_date'
    ];
}
