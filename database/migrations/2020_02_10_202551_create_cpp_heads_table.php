<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCppHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('cpp_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->comment('connected to product table');
            $table->bigInteger('analisa_kimia_id')->comment('connected to analisa kimia table')->nullable();
            $table->bigInteger('analisa_mikro_id')->comment('connected to analisa mikro table')->nullable();
            $table->date('packing_date');
            $table->enum('cpp_status', ['0', '1'])->comment('0 => on progress, 1 => done');
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('transaction_data')->dropIfExists('cpp_heads');
    }
}
