<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpRkjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('follow_up_rkjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rkj_id')->nullable()->comment('ini connect ke rkj table');
            
            $table->text('dugaan_penyebab')->comment('column yang  diisi oleh RnD')->nullable();        
            $table->text('hasil_analisa')->comment('column yang  diisi oleh RnD')->nullable();
            
            $table->enum('status_produk', ['0', '1','2'])->nullable()->comment('0 = reject , 1 = release , 2 = relase partial ');
            $table->date('tanggal_status_produk')->nullable();
            $table->enum('status_follow_up_rkj', ['0', '1'])->nullable()->comment('0 = on progress , 1 = close ');
            
            $table->char('nomor_rkp', 30)->nullable()->comment('diinput oleh tim QA');
            $table->text('hasil_investigasi')->nullable()->comment('diisi oleh tim QA');
            $table->date('tanggal_loi')->nullable()->comment('diisi oleh tim QA');
            $table->enum('status_case', ['0', '1'])->nullable()->comment('0 = On progress , 1 = Done');
            
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
        Schema::connection('transaction_data')->dropIfExists('follow_up_rkjs');
    }
}
