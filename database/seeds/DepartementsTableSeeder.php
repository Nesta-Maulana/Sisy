<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Departement;

class DepartementsTableSeeder extends Seeder
{
    public function run()
    {
    	Departement::Create([
    		'departement'	=>	'FQC',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    	Departement::Create([
    		'departement'	=>	'FSA',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    	Departement::Create([
    		'departement'	=>	'FRC',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    	Departement::Create([
    		'departement'	=>	'FEC',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    	Departement::Create([
    		'departement'	=>	'FGS',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    	Departement::Create([
    		'departement'	=>	'FPD',
			'is_active'		=>	'1',
			'created_by'	=>	'1'
    	]);
    }
}
