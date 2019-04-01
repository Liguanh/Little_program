<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 地区填充
     * @return void
     */
    public function run()
    {
        //
        $database = file_get_contents(base_path('database/seeds')."/region.sql");

        //dd($database);

        DB::connection()->getPdo()->exec($database);
    }
}
