<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaKimiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('analisa_kimias', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->bigInteger('cpp_head_id')->comment('connected to cpphead table');
            $table->bigInteger('ppq_id')->comment('connected to ppq table')->nullable();
            $table->double('ts_awal_1', 5, 2)->nullable();
            $table->double('ts_awal_2', 5, 2)->nullable();
            $table->double('ts_tengah_1', 5, 2)->nullable();
            $table->double('ts_tengah_2', 5, 2)->nullable();
            $table->double('ts_akhir_1', 5, 2)->nullable();
            $table->double('ts_akhir_2', 5, 2)->nullable();
            $table->double('ts_awal_avg', 6, 3)->nullable();
            $table->double('ts_tengah_avg', 6, 3)->nullable();
            $table->double('ts_akhir_avg', 6, 3)->nullable();
            
            $table->double('ph_awal', 5, 2)->nullable();
            $table->double('ph_tengah', 5, 2)->nullable();
            $table->double('ph_akhir', 5, 2)->nullable();

            $table->char('visko_awal', 5)->nullable();
            $table->char('visko_tengah', 5)->nullable();
            $table->char('visko_akhir', 5)->nullable();

            $table->enum('sensori_awal', ['OK', '#OK'])->nullable();
            $table->enum('sensori_tengah', ['OK', '#OK'])->nullable();
            $table->enum('sensori_akhir', ['OK', '#OK'])->nullable();
            
            $table->dateTime('jam_filling_awal')->nullable();
            $table->dateTime('jam_filling_tengah')->nullable();
            $table->dateTime('jam_filling_akhir')->nullable();
            
            $table->double('ts_oven_awal', 5, 2)->nullable();
            $table->double('ts_oven_tengah', 5, 2)->nullable();
            $table->double('ts_oven_akhir', 5, 2)->nullable();
            
            $table->char('kode_batch_standar', 7)->nullable();


            $table->boolean('progress_status')->nullable();
            $table->boolean('analisa_kimia_status')->nullable();

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
        Schema::connection('transaction_data')->dropIfExists('analisa_kimias');
    }
}
