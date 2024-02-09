<?php

namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PrintDetails extends Model
{
    protected $table = 'ns_products_print_details';
    protected $fillable = [
        'print_id',
        'code_id',
        'attribute_id'
    ];

    public function checkPrintDetail($type, $id) {
        $query = DB::table('ns_products_print_details');
        if($type == 1)
            $query = $query->where('code_id', $id) ;
        else if($type == 2)
            $query = $query->where('attribute_id', $id) ;

        return $query->first();
    }
}
