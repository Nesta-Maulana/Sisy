<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpdFillingDetailPisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('rpd_filling_detail_pis', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->bigInteger('rpd_filling_head_id')->comment('Connected to rpd filling head table');
            $table->bigInteger('wo_number_id')->comment('Connected to Wo Number table');
            $table->bigInteger('filling_machine_id')->comment('connected to filling machine head');
            $table->bigInteger('filling_sampel_code_id')->comment('connected to filling sampel code table');
            $table->date('filling_date');
            $table->time('filling_time');
            $table->double('berat_kanan', 6, 2);
            $table->double('berat_kiri', 6, 2);
            $table->double('overlap', 4, 2)->nullable();
            $table->char('ls_sa_proportion',5)->nullable();
            $table->integer('volume_kanan')->nullable();
            $table->integer('volume_kiri')->nullable();
            $table->enum('airgap', ['OK', '#OK','-'])->nullable();
            $table->char('ts_accurate_kanan', 50)->nullable();
            $table->char('ts_accurate_kiri', 50)->nullable();
            $table->char('ls_accurate', 50)->nullable();
            $table->char('sa_accurate', 50)->nullable();
            $table->char('surface_check', 50)->nullable();
            $table->enum('pinching', ['OK', '#OK','-'])->nullable();
            $table->enum('strip_folding', ['OK', '#OK','-'])->nullable();
            $table->enum('konduktivity_kanan', ['OK', '#OK','-'])->nullable();
            $table->enum('konduktivity_kiri', ['OK', '#OK','-'])->nullable();
            $table->enum('design_kanan', ['OK', '#OK','-'])->nullable();
            $table->enum('design_kiri', ['OK', '#OK','-'])->nullable();
            $table->enum('dye_test', ['OK', '#OK','-'])->nullable();
            $table->enum('residu_h2o2', ['OK', '#OK','-'])->nullable();
            $table->enum('prod_code_and_no_md', ['OK', '#OK','-'])->nullable();
            $table->text('correction')->nullable();
            $table->enum('dissolving_test', ['OK', '#OK','-'])->nullable();
            $table->enum('status_akhir', ['OK', '#OK'])->nullable();
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
        Schema::connection('transaction_data')->dropIfExists('rpd_filling_detail_pis');
    }
}
