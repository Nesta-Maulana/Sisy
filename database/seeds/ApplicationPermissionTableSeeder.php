<?php

use Illuminate\Database\Seeder;
use App\Models\Master\ApplicationPermission;
class ApplicationPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	ApplicationPermission::create([
    		'application_id'	=> '1',
    		'user_id'			=> '1',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '1',
    		'user_id'			=> '2',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '2',
    		'user_id'			=> '1',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '2',
    		'user_id'			=> '2',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '3',
    		'user_id'			=> '1',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '3',
    		'user_id'			=> '2',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '4',
    		'user_id'			=> '1',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '4',
    		'user_id'			=> '2',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '5',
    		'user_id'			=> '1',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);

    	ApplicationPermission::create([
    		'application_id'	=> '5',
    		'user_id'			=> '2',
    		'is_active'			=> '1',
    		'created_by'			=> '1'
    	]);
    }
}
