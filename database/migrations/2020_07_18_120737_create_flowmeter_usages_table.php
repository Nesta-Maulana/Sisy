<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowmeterUsagesTable extends Migration
{
    public function up()
    {
        Schema::connection('master_data')->create('flowmeter_usages', function (Blueprint $table) 
        {
            $table->id();
            $table->bigInteger('flowmeter_workcenter_id')->comment('connected to flowmeter workcenter');
            $table->bigInteger('flowmeter_formula_id')->comment('connected to flowmeter formula untuk menentukan rumus yang dipakai');
            $table->char('flowmeter_name',100)->comment('ini untuk nama pada penggunaan bisa saja berbeda dengan yang ada di table usage monitoring.');
            $table->char('flowmeter_code',30)->comment('Panduan untuk rumus flowmeter');
            $table->boolean('is_active')->comment('0 = inactive ; 1 = active');
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
        Schema::connection('master_data')->dropIfExists('flowmeter_usages');
    }
}
