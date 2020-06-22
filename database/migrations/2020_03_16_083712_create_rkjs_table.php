<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('rkjs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('ppq_id')->nullable()->comment('connect to ppq_table');
            
            $table->char('nomor_rkj','30');
            $table->date('rkj_date');
            $table->enum('status_akhir',['0', '1', '2'])->comment('0 = new , 1 = on progress , 2 = done');
            
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
        Schema::connection('transaction_data')->dropIfExists('rkjs');
    }
}
