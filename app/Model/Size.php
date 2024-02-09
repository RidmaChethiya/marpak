<?php

namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'ns_products_sizes';
    protected $fillable = [
        'name'
    ];

    public function getSizeList($type, $name=null, $id=null) { 
        $query = DB::table('ns_products_sizes');
        if($type == 1)
            $query = $query->orderBy('id', 'DESC')->paginate(10);
        else if ($type == 2)
            $query = $query->where('name', $name)->first();
        else if ($type == 3)
            $query = $query->where('name', $name)->where('id', '!=' , $id)->first();

        return $query;
    }
}
