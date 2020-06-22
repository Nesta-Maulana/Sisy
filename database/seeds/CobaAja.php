<?php

use Illuminate\Database\Seeder;

class CobaAja extends Seeder
{
    public function run()
    {
        DB::connection('master_data')->unprepared(file_get_contents(__DIR__.'/data_support/master_data.sql'));
        DB::connection('transaction_data')->unprepared(file_get_contents(__DIR__.'/data_support/transaction_data.sql'));
    }
}

