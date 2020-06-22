<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpdFillingDetailAtEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('rpd_filling_detail_at_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rpd_filling_head_id')->comment('Connected to rpd filling head table');
            $table->bigInteger('wo_number_id')->comment('Connected to Wo Number table');
            $table->bigInteger('filling_machine_id')->comment('connected to filling machine head');
            $table->bigInteger('filling_sampel_code_id')->comment('connected to filling sampel code table');
            $table->bigInteger('verifier_id')->comment('connected to user  table')->nullable();
            $table->bigInteger('palet_id')->comment('connected to palet table')->nullable();
            $table->date('filling_date');
            $table->time('filling_time');
            $table->enum('ls_sa_sealing_quality', ['OK', '#OK','-'])->nullable();
            $table->char('ls_sa_proportion',5)->nullable();
            $table->double('sideway_sealing_alignment', 4, 2)->nullable();
            $table->double('overlap', 5, 2)->nullable();
            $table->double('package_length', 6, 2)->nullable();
            $table->enum('paper_splice_sealing_quality', ['OK', '#OK','-'])->nullable();
            $table->char('no_kk',50)->nullable();
            $table->char('no_md',50)->nullable();
            $table->enum('ls_sa_sealing_quality_strip', ['OK', '#OK','-'])->nullable();
            $table->enum('ls_short_stop_quality', ['OK', '#OK','-'])->nullable();
            $table->enum('sa_short_stop_quality', ['OK', '#OK','-'])->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status_akhir', ['OK', '#OK','-'])->nullable();
            $table->enum('verifikasi', ['0', '1'])->nullable();
            $table->text('keterangan_verifikasi')->nullable();
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
        Schema::connection('transaction_data')->dropIfExists('rpd_filling_detail_at_events');
    }
}
