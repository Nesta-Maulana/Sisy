<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('ppqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rpd_filling_detail_pi_id')->comment('connected to table rpd filling detail pi untuk patokan trigger pembuatan PPQ pada event OK setelah #OK')->nullable();
            $table->bigInteger('cpp_head_id')->comment('connected to table cpphead')->nullable();
            $table->bigInteger('kategori_ppq_id')->comment('connected to table kategori_ppq')->nullable();
            $table->char('nomor_ppq','30');
            $table->date('ppq_date');
            $table->datetime('jam_awal_ppq');
            $table->datetime('jam_akhir_ppq');
            $table->integer('jumlah_pack');
            $table->text('alasan');
            $table->text('detail_titik_ppq');
            // $table->enum('jenis_ppq',['0','1','2','3'])->comment('0 = Kimia , 1 = Mikro , 2 = Sortasi Gudang , 3 = Package Integrity');
            /*$table->enum('kategori_ppq',['0', '1', '2', '3', '4', '5', '6', '7'])->comment('0 = Man , 1 = machine , 2 = method , 3 = material , 4= enviroment , 5 = sortasi , 6 = miss handling , 7 = dan lain lain');*/
            $table->enum('status_akhir',['0', '1', '2', '3', '4', '5'])->comment('0 = new , 1 = on progress , 2 = done,3 = on progress rkj, 4 = Done RKJ , 5, Draft PPQ ');
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
        Schema::connection('transaction_data')->dropIfExists('ppqs');
    }
}
