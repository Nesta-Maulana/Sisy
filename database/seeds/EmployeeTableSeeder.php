<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Employee;
class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Employee::create(
    		[
    			'fullname' 			=> 'Nesta Maulana',
    			'email' 			=> 'nestamaulana165@gmail.com',
    			'departement_id' 	=> '1',
    			'is_active'			=> '1',
    			'created_by'		=> '1'
    		]
    	);

    	Employee::create(
    		[
    			'fullname' 			=> 'Administrator',
    			'email' 			=> 'nesta.maulana@nutrifood.co.id',
    			'departement_id' 	=> '1',
    			'is_active'			=> '1',
    			'created_by'		=> '1'
    		]
    	);
    }
}
