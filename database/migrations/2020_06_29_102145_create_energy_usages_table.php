<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyUsagesTable extends Migration
{
    public function up()
    {
        Schema::connection('transaction_data')->create('energy_usages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('flowmeter_usage_id')->comment('connected to flowmeter usage table');
            $table->bigInteger('flowmeter_formula_id')->comment('connected to flowmeter table');
            $table->double('usage_value')->comment('angka penggunaan berdasar rumus yang diatas');
            $table->date('usage_date')->comment('ini untuk panduan tanggal penggunaannya kapan');
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
        Schema::connection('transaction_data')->dropIfExists('energy_usages');
    }
}
