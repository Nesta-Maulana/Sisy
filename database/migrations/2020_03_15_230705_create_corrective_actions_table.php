<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectiveActionsTable extends Migration
{
    public function up()
    {
        Schema::connection('transaction_data')->create('corrective_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('follow_up_ppq_id')->nullable()->comment('connected to table follow up ppq');
            $table->bigInteger('follow_up_rkj_id')->nullable()->comment('connected to table follow up rkj');
            
            $table->text('corrective_action')->nullable()->comment('ini diinput oleh qc tahanan dan engineering');
            $table->date('due_date_corrective_action')->nullable()->comment('ini diinput oleh qc tahanan dan engineering');
            $table->char('pic_corrective_action', 100)->nullable()->comment('diinput oleh qc tahanan dan enginerring');
            $table->enum('status_corrective_action', ['0', '1'])->nullable()->comment('0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring');
            $table->text('verifikasi_corrective_action')->nullable()->comment('ini diinput oleh qc tahanan dan engineering');
            
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::connection('transaction_data')->dropIfExists('corrective_actions');
    }
}
