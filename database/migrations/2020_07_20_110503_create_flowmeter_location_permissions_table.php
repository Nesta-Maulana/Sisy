<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowmeterLocationPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('flowmeter_location_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('flowmeter_location_id')->comment('connected to flowmeter location table');
            $table->bigInteger('user_id')->comment('connected to user id table');
            $table->boolean('is_allow')->comment('0 = denied ; 1 = allowed');
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
        Schema::connection('master_data')->dropIfExists('flowmeter_location_permissions');
    }
}
