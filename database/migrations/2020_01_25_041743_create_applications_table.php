<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('application_name');
            $table->char('application_description',150);
            $table->char('application_link');
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
        Schema::connection('master_data')->dropIfExists('applications');
    }
}
