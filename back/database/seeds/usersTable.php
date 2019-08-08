<?php

use Illuminate\Database\Seeder;

class usersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'name' => str_random(10),
	        'identification' => 123,
	        'birthDay' => '1991-04-09',
	        'direcction' => 'Cr 51B # 87 53',
	        'email' => str_random(10).'@gmail.com',
	        'telephone' => '2127140',
	        'celphone' => '3015849167',
	        'profile' => 1,
	        'user' => 'damedinae',        
	        'password' => bcrypt('secret'),
	        'status' => 1, 
        ]);    	
       
    }
}
