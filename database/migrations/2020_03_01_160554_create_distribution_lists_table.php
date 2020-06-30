<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('distribution_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->comment('connected to employee table');
            $table->boolean('ppq_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('ppq_mail_cc')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_nfi_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_nfi_mail_cc')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_wrp_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_wrp_mail_cc')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_hb_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('rkj_hb_mail_cc')->comment('0 = inactive , 1 = active');
            $table->boolean('sortasi_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('sortasi_mail_cc')->comment('0 = inactive , 1 = active');
            $table->boolean('psr_mail_to')->comment('0 = inactive , 1 = active');
            $table->boolean('psr_mail_cc')->comment('0 = inactive , 1 = active');
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
        Schema::connection('master_data')->dropIfExists('distribution_lists');
    }
}
