<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreventiveActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('preventive_actions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('follow_up_ppq_id')->nullable()->comment('connected to table follow up ppq');
            $table->bigInteger('follow_up_rkj_id')->nullable()->comment('connected to table follow up rkj');
            
            $table->text('preventive_action')->nullable()->comment('diisi oleh tim eng atau qc tahanan');
            $table->date('due_date_preventive_action')->nullable()->comment('ini diinput oleh qc tahanan dan engineering');
            $table->char('pic_preventive_action', 100)->nullable()->comment('diinput oleh qc tahanan dan enginerring dan QA');
            $table->enum('status_preventive_action', ['0', '1'])->nullable()->comment('0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring');
            
            $table->text('verifikasi_preventive_action')->nullable()->comment('diisi oleh tim eng atau qc tahanan');
            
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
        Schema::connection('transaction_data')->dropIfExists('preventive_actions');
    }
}
