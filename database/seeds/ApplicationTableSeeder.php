<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Application;
class ApplicationTableSeeder extends Seeder
{
    public function run()
    {
    	Application::create([
    		'application_name'			=> 'Master Apps',
    		'application_description'	=> 'Aplikasi untuk mengelola seluruh data-data dari aplikasi yang terdapat pada Sentul integrated system',
    		'application_link'			=> 'master-apps',
    		'is_active'					=> '1',
    		'created_by'				=> '1'
    	]);
    	Application::create([
    		'application_name'			=> 'Rollie',
    		'application_description'	=> 'Aplikasi untuk mengelola seluruh data-data penunjang release produk di plant sentul',
    		'application_link'			=> 'rollie',
    		'is_active'					=> '1',
    		'created_by'				=> '1'
    	]);
    	Application::create([
    		'application_name'			=> 'Rollie - Admin Panel',
    		'application_description'	=> 'Aplikasi untuk mengelola seluruh data-data yang terdapat pada aplikasi Rollie',
    		'application_link'			=> 'rollie-admin-panel',
    		'is_active'					=> '1',
    		'created_by'				=> '1'
    	]);
    	Application::create([
    		'application_name'			=> 'Energy Monitoring',
    		'application_description'	=> 'Aplikasi untuk mengelola seluruh data-data penggunaan energy di PT Nutrifood Indonesia Plant Sentul',
    		'application_link'			=> 'emon',
    		'is_active'					=> '1',
    		'created_by'				=> '1'
    	]);
    	Application::create([
    		'application_name'			=> 'Energy Monitoring - Admin Panel',
    		'application_description'	=> 'Aplikasi untuk mengelola seluruh data-data yang terdapat pada aplikasi Emon',
    		'application_link'			=> 'emon-admin-panel',
    		'is_active'					=> '1',
    		'created_by'				=> '1'
    	]);
    }
}
