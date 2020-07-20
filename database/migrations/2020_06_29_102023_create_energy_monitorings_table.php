<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyMonitoringsTable extends Migration
{
    public function up()
    {
        Schema::connection('transaction_data')->create('energy_monitorings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('flowmeter_id')->comment('connected to flowmeter table');
            $table->double('monitoring_value')->comment('angka meterannya');
            $table->date('monitoring_date')->comment('ini untuk panduan tanggal pengamatannya kapan');
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::connection('transaction_data')->dropIfExists('energy_monitorings');
    }
}
