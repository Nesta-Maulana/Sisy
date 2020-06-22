<?php

use Illuminate\Database\Seeder;
use App\Models\Master\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$password 			= Hash::make('sentulappuser');
    	$password_admin 	= Hash::make('adminsentulapp');
    	User::Create([
    		'employee_id' 			=> '1',
    		'username' 				=> 'nesta_nm',
    		'password' 				=> $password,
    		'verified' 				=> '1',
    		'verified_by_admin' 	=> '1',
    		'is_active' 			=> '1',
    		'last_update_password'	=> date('Y-m-d'),
    		'created_by' 			=> '1',
    	]);

    	User::Create([
    		'employee_id' 			=> '2',
    		'username' 				=> 'administrator',
    		'password' 				=> $password_admin,
    		'verified' 				=> '1',
    		'verified_by_admin' 	=> '1',
    		'is_active' 			=> '1',
    		'last_update_password'	=> date('Y-m-d'),
    		'created_by' 			=> '1',
    	]);
    }
}
