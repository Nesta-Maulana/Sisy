<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('menu_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('connected to user table');
            $table->bigInteger('menu_id')->comment('connected to menu table');
            $table->boolean('view')->comment('0 = denied, 1 = allowed');
            $table->boolean('create')->comment('0 = denied, 1 = allowed');
            $table->boolean('edit')->comment('0 = denied, 1 = allowed');
            $table->boolean('delete')->comment('0 = denied, 1 = allowed');
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
        Schema::connection('master_data')->dropIfExists('menu_permissions');
    }
}
