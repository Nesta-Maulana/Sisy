<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsrsTable extends Migration
{
    public function up()
    {
        Schema::connection('transaction_data')->create('psrs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wo_number_id')->comment('connected to wo_number table');
            $table->char('psr_number');
            $table->char('psr_qty');
            $table->text('note')->nullable();
            $table->enum('psr_status', ['0', '1','2', '3'])->default('0')->comment('  0 = draft psr, 1 = ready to print, 2 = On Progress Penyelia, 3 = Closed By penyelia ');
            $table->bigInteger('created_by')->comment('connected to user table');
            $table->bigInteger('updated_by')->comment('connected to user table')->nullable();
            $table->bigInteger('deleted_by')->comment('connected to user table')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

   public function down()
    {
        Schema::connection('transaction_data')->dropIfExists('psrs');
    }
}
