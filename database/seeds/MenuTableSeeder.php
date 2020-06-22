<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Menu;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Menu::create([
    		'parent_id'			=> '0',
    		'application_id'	=> '1',
    		'menu_name'			=> 'Home',
    		'menu_icon'			=> 'fa-home',
    		'menu_route'		=> 'show_home_master_app',
    		'menu_position'		=> '0',
    		'is_active'			=> '1',
    		'created_by'		=> '1'
    	]);

    	Menu::create([
    		'parent_id'			=> '0',
    		'application_id'	=> '1',
    		'menu_name'			=> 'Pengaturan Aplikasi',
    		'menu_icon'			=> 'fa-gears',
    		'menu_route'		=> '-',
    		'menu_position'		=> '1',
    		'is_active'			=> '1',
    		'created_by'		=> '1'
    	]);

    	Menu::create([
    		'parent_id'			=> '2',
    		'application_id'	=> '1',
    		'menu_name'			=> 'Kelola Menu',
    		'menu_icon'			=> 'fa-bars',
    		'menu_route'		=> 'show_kelola_menu',
    		'menu_position'		=> '0',
    		'is_active'			=> '1',
    		'created_by'		=> '1'
    	]);

    	Menu::create([
    		'parent_id'			=> '0',
    		'application_id'	=> '2',
    		'menu_name'			=> 'Home',
    		'menu_icon'			=> 'fa-home',
    		'menu_route'		=> 'show_home_rollie',
    		'menu_position'		=> '0',
    		'is_active'			=> '1',
    		'created_by'		=> '1'
    	]);

    	Menu::create([
    		'parent_id'			=> '0',
    		'application_id'	=> '4',
    		'menu_name'			=> 'Home',
    		'menu_icon'			=> 'fa-home',
    		'menu_route'		=> 'show_home_emon',
    		'menu_position'		=> '0',
    		'is_active'			=> '1',
    		'created_by'		=> '1'
    	]);
    	

    }
}
