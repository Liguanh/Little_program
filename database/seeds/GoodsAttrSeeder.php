<?php

use Illuminate\Database\Seeder;

class GoodsAttrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $database = file_get_contents(base_path('database/seeds')."/goods_attr.sql");

        DB::connection()->getPdo()->exec($database);
    }
}
