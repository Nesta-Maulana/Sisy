<?php

use Illuminate\Database\Seeder;
use App\Models\Master\MenuPermission;
class MenuPermissionTableSeeder extends Seeder
{
    public function run()
    {
    	MenuPermission::create([
    		'user_id'		=> '1',
    		'menu_id'		=> '1',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '2',
    		'menu_id'		=> '1',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '1',
    		'menu_id'		=> '2',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '2',
    		'menu_id'		=> '2',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '1',
    		'menu_id'		=> '3',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '2',
    		'menu_id'		=> '3',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '1',
    		'menu_id'		=> '4',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '2',
    		'menu_id'		=> '4',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '1',
    		'menu_id'		=> '5',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);

    	MenuPermission::create([
    		'user_id'		=> '2',
    		'menu_id'		=> '5',
    		'view'			=> '1',
    		'create'		=> '1',
    		'edit'			=> '1',
    		'delete'		=> '1',
    		'created_by'	=> '1'
    	]);
    }
}
