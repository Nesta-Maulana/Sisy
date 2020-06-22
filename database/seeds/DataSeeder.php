<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('master_data')->unprepared(file_get_contents(__DIR__.'/data_support/master_data.sql'));
        DB::connection('transaction_data')->unprepared(file_get_contents(__DIR__.'/data_support/transaction_data.sql'));
    }
}
