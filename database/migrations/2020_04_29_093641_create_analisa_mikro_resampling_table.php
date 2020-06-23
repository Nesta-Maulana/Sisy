<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaMikroResamplingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('analisa_mikro_resampling', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('analisa_mikro_id')->nullable()->comment('connected to analisa mikro table');
            $table->bigInteger('ppq_id')->nullable()->comment('connected to analisa mikro table');
            $table->date('tanggal_analisa')->nullable();
            
            $table->bigInteger('suhu_preinkubasi')->nullable();
            $table->boolean('progress_status')->nullable();
            $table->enum('analisa_mikro_status', ['0', '1'])->nullable()->comment('0 = #OK, 1 = OK');
            
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
        Schema::connection('transaction_data')->dropIfExists('analisa_mikro_resampling');
    }
}
