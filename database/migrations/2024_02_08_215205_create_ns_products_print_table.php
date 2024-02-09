<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNsProductsPrintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ns_products_print', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_size_id');
            $table->nteger('label_width');
            $table->nteger('label_height');
            $table->unsignedBigInteger('page_orientation_id');
            $table->date('label_date');
            $table->unsignedBigInteger('label_start_id');
            $table->unsignedBigInteger('label_end_id');
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
        Schema::dropIfExists('ns_products_print');
    }
}
