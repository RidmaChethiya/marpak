<?php

namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'ns_products_attributes';
    protected $fillable = [
        'color_id',
        'size_id'
    ];

    public function getAttributeList() {
        return DB::table('ns_products_attributes')
                    ->join('ns_products_colors','ns_products_colors.id','=','ns_products_attributes.color_id')
                    ->join('ns_products_sizes','ns_products_sizes.id','=','ns_products_attributes.size_id')
                    ->select('ns_products_attributes.id',
                            'ns_products_attributes.color_id','ns_products_colors.name as color_name',
                            'ns_products_attributes.size_id','ns_products_sizes.name as size_name')
                    ->orderBy('ns_products_attributes.id', 'DESC')
                    ->paginate(10);
    }

    public function checkDuplicate($color_id, $size_id, $id=null, $type=null) {
        $query = DB::table('ns_products_attributes')
                    ->where('color_id', $color_id) 
                    ->where('size_id', $size_id);
        if($type == 1)
            $query = $query->where('id', '!=' , $id);

        return $query->first();
    }

    public function checkAttribute($type, $id) {
        $query = DB::table('ns_products_attributes');
        if($type == 1)
            $query = $query->where('color_id', $id) ;
        else if($type == 2)
            $query = $query->where('size_id', $id) ;

        return $query->first();
    }
}
