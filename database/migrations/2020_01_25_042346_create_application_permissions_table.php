<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('application_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('application_id')->comment('Connect to applications table');
            $table->bigInteger('user_id')->comment('Connect to user table');
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
        Schema::connection('master_data')->dropIfExists('application_permissions');
    }
}
