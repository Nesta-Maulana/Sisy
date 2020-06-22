<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subbrand_id')->comment('connected to table subbrand');
            $table->bigInteger('product_type_id')->comment('connected to product type table');
            $table->bigInteger('filling_machine_group_head_id')->comment('connected to filling machine head');
            $table->char('product_name');
            $table->char('oracle_code',30);
            $table->double('spek_ts_min', 8, 2);
            $table->double('spek_ts_max', 8, 2);
            $table->double('spek_ph_min', 8, 2);
            $table->double('spek_ph_max', 8, 2);
            $table->integer('sla')->comment('dalam hari');
            $table->integer('waktu_analisa_mikro')->comment('dalam hari');
            $table->integer('inkubasi')->comment('dalam hari')->nullable();
            $table->char('trial_code', 50)->comment('ini digunakan apabila ada nomor wo trial');
            $table->integer('expired_range')->comment('dalam satuan bulan');
            $table->boolean('is_active')->comment('0 = inactive ; 1 = active');
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
        Schema::connection('master_data')->dropIfExists('products');
    }
}
