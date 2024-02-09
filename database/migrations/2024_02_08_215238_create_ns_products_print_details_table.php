<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNsProductsPrintDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ns_products_print_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('print_id');
            $table->unsignedBigInteger('code_id');
            $table->unsignedBigInteger('attribute_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ns_products_print_details');
    }
}
