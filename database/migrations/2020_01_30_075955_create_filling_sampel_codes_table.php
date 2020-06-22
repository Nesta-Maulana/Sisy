<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillingSampelCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('filling_sampel_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('filling_sampel_code');
            $table->char('filling_sampel_event');
            $table->bigInteger('product_type_id')->comment('connected to product type table');
            $table->bigInteger('filling_machine_id')->comment('connected to filling machine table');
            $table->integer('pi');
            $table->integer('mikro30');
            $table->integer('mikro55');
            $table->integer('dissolve');
            $table->integer('standar');
            $table->integer('retain');
            $table->integer('wo');
            $table->integer('ts_ph');
            $table->integer('jumlah');
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
        Schema::connection('master_data')->dropIfExists('filling_sampel_codes');
    }
}
