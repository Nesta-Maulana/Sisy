<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaMikroDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('analisa_mikro_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('analisa_mikro_id')->nullable()->comment('connected to analisa mikro table');
            $table->bigInteger('analisa_mikro_resampling_id')->nullable()->comment('connected to analisa mikro table');
            $table->bigInteger('filling_machine_id')->comment('connected to filling machine table');
            $table->bigInteger('ppq_id')->nullable()->comment('connected to ppq table');

            $table->char('kode_sampel',7)->comment('ini ngambil dari column filling sampel code ngambil dari table rpd filling produk');
            $table->dateTime('jam_filling')->comment('ini defaultnya ambil dari jam filling sampel dari rpd filling');
            $table->enum('suhu_preinkubasi', ['30', '55'])->comment('ini untuk pembeda suhu 30 derajat atau 55 derajat dalam kategori susu dan non susu');

            $table->bigInteger('tpc')->nullable()->comment('diinput oleh tim lab mikro');
            $table->bigInteger('yeast')->nullable()->comment('diinput oleh tim lab mikro');
            $table->bigInteger('mold')->nullable()->comment('diinput oleh tim lab mikro');

            $table->double('ph', 5, 2)->nullable()->comment('ini diinput oleh tim petugas qc release');
            $table->enum('status', ['0', '1'])->nullable()->comment('0 = #ok , 1 = OK ');

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
        Schema::connection('transaction_data')->dropIfExists('analisa_mikro_details');
    }
}
