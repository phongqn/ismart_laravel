<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            ['name' => 'Admin', 'display_name' => 'Quản trị hệ thống'],
            ['name' => 'Guest', 'display_name' => 'Khách hàng'],
            ['name' => 'Developer', 'display_name' => 'Phát triển hệ thống'],
            ['name' => 'Content', 'display_name' => 'Chỉnh sửa nội dung']
        ]);
    }
}
