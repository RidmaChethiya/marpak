<?php

namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Prints extends Model
{
    protected $table = 'ns_products_print';
    protected $fillable = [
        'page_size_id',
        'label_width',
        'label_height',
        'page_orientation_id',
        'label_date',
        'label_start_id',
        'label_end_id'
    ];
    
    public function checkDuplicate($date, $start, $end) {
        return DB::table('ns_products_print')
                    ->join('ns_products_print_details','ns_products_print_details.print_id','=','ns_products_print.id')
                    ->where('ns_products_print.label_date', $date)
                    ->where(
                        function($query) use ($start,$end) {
                          return $query
                            ->where('ns_products_print_details.code_id', $start)
                            ->orWhere('ns_products_print_details.code_id', $end);
                        })->get();
    }

    public function getPdfDetails($id){
        return DB::table('ns_products_print')
                    ->join('ns_products_print_details','ns_products_print_details.print_id','=','ns_products_print.id')
                    ->join('ns_products','ns_products.id','=','ns_products_print_details.code_id')
                    ->join('ns_products_attributes','ns_products_attributes.id','=','ns_products_print_details.attribute_id')
                    ->join('ns_products_colors','ns_products_colors.id','=','ns_products_attributes.color_id')
                    ->join('ns_products_sizes','ns_products_sizes.id','=','ns_products_attributes.size_id')
                    ->select('ns_products_print.label_width', 'ns_products_print.label_height',
                            'ns_products_print.label_date', 'ns_products.name as code_name', 
                            'ns_products_colors.name as color_name', 'ns_products_sizes.name as size_name')
                    ->where('ns_products_print.id', $id)
                    ->orderBy('ns_products.name', 'ASC')
                    ->orderBy('ns_products_colors.name', 'ASC')
                    ->orderBy('ns_products_sizes.name', 'ASC')->get();
    }
}
