<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpPpqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('transaction_data')->create('follow_up_ppqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ppq_id');
            $table->text('jumlah_metode_sampling')->comment('column yang diinput oleh params Qc Release')->nullable();
            $table->text('hasil_analisa')->comment('column yang diinput qc release jika status PI | diinput oleh qc tahanan as hasil evaluasi')->nullable();
            
            $table->enum('status_produk', ['0', '1','2'])->nullable()->comment('0 = reject , 1 = release , 2 = relase partial | diinput oleh qc release or qc tahanan || status_produk');
            $table->date('tanggal_status_ppq')->nullable();
            $table->char('nomor_lbd', 30)->comment('column yang diinput qc release jika status PI')->nullable();
            
            $table->text('root_cause')->nullable()->comment('ini diinput oleh tim engineering');
            $table->enum('kategori_case', ['0', '1'])->nullable()->comment('0 = case lama , 1 = case baru | diinput oleh tim engineering');
            $table->enum('status_case', ['0', '1'])->nullable()->comment('0 = on progress , 1 = close | diinput oleh tim engineering');

            $table->enum('status_follow_up_ppq', ['0', '1'])->nullable()->comment('0 = on progress , 1 = close ');
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
        Schema::connection('transaction_data')->dropIfExists('follow_up_ppqs');
    }
}
