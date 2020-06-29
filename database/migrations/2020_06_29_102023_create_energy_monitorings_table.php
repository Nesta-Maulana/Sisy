<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyMonitoringsTable extends Migration
{
    public function up()
    {
        Schema::create('energy_monitorings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('energy_monitorings');
    }
}
