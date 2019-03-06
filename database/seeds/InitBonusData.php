<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitBonusData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stu_bonus')->insert([
        	'total_amount' => 100,
        	'left_amount'  => 100,
        	'nums'         => 5,
        	'left_nums'    => 5,
        	'status'		=>'1',
        ]);

    }
}
