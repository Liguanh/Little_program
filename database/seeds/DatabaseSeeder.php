<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(GoodsAttrSeeder::class);
         $this->call(GoodsTypeSeeder::class);
         $this->call(InitAdminUser::class);
         $this->call(InitPermissions::class);
         $this->call(RegionSeeder::class);
    }
}
