<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWoNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('wo_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plan_id')->comment('connected to plan table');
            $table->bigInteger('product_id')->comment('connected to product table');
            $table->bigInteger('rpd_filling_head_id')->nullable()->comment('connected to rpd filling head table');
            $table->bigInteger('cpp_head_id')->nullable()->comment('connected to cpp head table');
/*            $table->char('nomor_psr')->nullable();
            $table->integer('jumlah_psr')->nullable();*/
            $table->char('wo_number');
            $table->date('production_plan_date');
            $table->date('production_realisation_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->date('fillpack_date')->nullable();
            $table->char('plan_batch_size')->nullable();
            $table->char('actual_batch_size')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('explanation_1')->nullable();
            $table->text('explanation_2')->nullable();
            $table->text('explanation_3')->nullable();
            $table->char('formula_revision',100)->nullable();
            $table->enum('wo_status', ['0', '1','2', '3', '4', '5', '6'])->default('0')->comment('	0 = Pending ( WIP Mixing ), 1 = On Progress Mixing , 2 = WIP Fillpack , 3 = In Progress Fillpack , 4 = Done Fillpack ( Waiting For Close ) , 5 = Closed, 6 = Canceled');
            $table->enum('upload_status', ['0', '1'])->comment('0 = Draft, 1 = close');
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
        Schema::connection('transaction_data')->dropIfExists('wo_numbers');
    }
}
