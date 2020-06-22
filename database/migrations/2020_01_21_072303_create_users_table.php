<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master_data')->create('users', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->comment('connected to employee table');
            $table->char('username',100);
            $table->text('password');
            $table->boolean('verified')->comment('0 = unverified , 1 = verified');
            $table->boolean('verified_by_admin')->comment('0 = unverified , 1 = verified');
            $table->boolean('is_active')->comment('0 = inactive , 1 = active');
            $table->date('last_update_password')->comment('for update password after 3 months');
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
        Schema::connection('master_data')->dropIfExists('users');
    }
}
