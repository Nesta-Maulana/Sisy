<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCppDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('cpp_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cpp_head_id')->comment('connected to cpp_heads table');
            $table->bigInteger('wo_number_id')->comment('connected to wo_numbers table');
            $table->bigInteger('filling_machine_id')->comment('connected to filling_machine table');
            $table->char('lot_number',10)->comment('logic lot number TC 23 10 A . T => Tahun , C => Mesin , 23 => tanggal , 10 => Bulan , A => Urutan proses produksi');
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
        Schema::connection('transaction_data')->dropIfExists('cpp_details');
    }
}
