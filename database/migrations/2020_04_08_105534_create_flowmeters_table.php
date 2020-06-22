<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowmetersTable extends Migration
{
    public function up()
    {
        Schema::connection('master_data')->create('flowmeters', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->bigInteger('flowmeter_workcenter_id')->comment('connected to flowmeter workcenter');
            $table->bigInteger('flowmeter_unit_id')->comment('connected to flowmeter unit');
            $table->bigInteger('flowmeter_location_id')->comment('connected to flowmeter location');
            $table->char('flowmeters_name', 50)->comment('ini untuk nama flowmetersnya');
            $table->double('spek_min')->nullable();
            $table->double('spek_max')->nullable();
            $table->enum('recording_schedule', ['0', '1','2','3'])->comment('0 => perhari, 1 => pershift , 2 => perjam , 3 => lainnya');
            $table->boolean('is_active')->comment('0 = inactive ; 1 = active');
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down()
    {
        Schema::connection('master_data')->dropIfExists('flowmeters');
    }
}