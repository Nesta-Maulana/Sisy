<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('palets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cpp_detail_id')->comment('connected to cpp detail tabel');
            $table->char('palet',10);
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->smallInteger('jumlah_box')->nullable();
            $table->smallInteger('jumlah_pack')->nullable();
            $table->enum('analisa_mikro_status', ['0', '1', '2', '3'])->nullable();
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
        Schema::connection('transaction_data')->dropIfExists('palets');
    }
}