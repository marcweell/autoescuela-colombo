<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class Currency extends Model{
    protected $fillable = [
        'name',
        'name_plural',
        'code',
        'symbol',
        'symbol_native',
        'decimal_digits',
        'active',
    ];

    protected $table = 'currency'; 
}
