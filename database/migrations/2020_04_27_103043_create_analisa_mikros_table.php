<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaMikrosTable extends Migration
{
    public function up()
    {
        Schema::connection('transaction_data')->create('analisa_mikro', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->bigInteger('cpp_head_id')->nullable()->comment('connected to cpp head table');
            $table->date('tanggal_analisa')->nullable();
            
            $table->boolean('progress_status')->nullable();
            
            $table->boolean('progress_status_30')->nullable();
            $table->boolean('progress_status_55')->nullable();
            
            $table->boolean('verifikasi_qc_release')->nullable();
            $table->enum('analisa_mikro_status', ['0', '1'])->nullable()->comment('0 = #OK, 1 = OK');
            
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::connection('transaction_data')->dropIfExists('analisa_mikro');
    }
}
