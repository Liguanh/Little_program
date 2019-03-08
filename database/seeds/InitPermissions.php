<?php

use Illuminate\Database\Seeder;

class InitPermissions extends Seeder
{
    /**
     * Run the database seeds.
     * 初始化权限表
     * @return void
     */
    public function run()
    {
    	DB::table('permissions')->insert([
        	'fid' => 0,
        	'name' => '首页',
        	'url'  => 'admin.home',
        	'is_menu' => '1'
        ]);
        //插入系统设置
        DB::table('permissions')->insert([
        	'fid' => 0,
        	'name' => '系统设置',
        	'url'  => '#',
        	'is_menu' => '1'
        ]);
         //插入权限列表
        DB::table('permissions')->insert([
        	'fid' => 2,
        	'name' => '权限列表',
        	'url'  => 'admin.permission.list',
        	'is_menu' => '1'
        ]);
        //插入权限添加页面
        DB::table('permissions')->insert([
        	'fid' => 2,
        	'name' => '权限添加',
        	'url'  => 'admin.permission.create',
        	'is_menu' => '1'
        ]);

        //插入执行权限添加
        DB::table('permissions')->insert([
        	'fid' => 2,
        	'name' => '执行权限添加',
        	'url'  => 'admin.permission.doCreate',
        	'is_menu' => '2'
        ]);
    }
}
