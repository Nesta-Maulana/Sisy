<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowmeterLocationsTable extends Migration
{
    public function up()
    {
        Schema::connection('master_data')->create('flowmeter_locations', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->char('flowmeter_location', 30);
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
        Schema::connection('master_data')->dropIfExists('flowmeter_locations');
    }
}
