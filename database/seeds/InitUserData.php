<?php

use Illuminate\Database\Seeder;

class InitUserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bs_user')->insert([
        	'username' => 'Liguanh'
        ]);
        DB::table('bs_user')->insert([
        	'username' => 'Liguanh1'
        ]);
        DB::table('bs_user')->insert([
        	'username' => 'Liguanh2'
        ]);
    }
}
