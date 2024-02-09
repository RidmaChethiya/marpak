<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Print extends Model
{
    protected $table = 'ns_products';
    protected $fillable = [
        'name'
    ];
}
