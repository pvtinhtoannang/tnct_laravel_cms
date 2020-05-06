<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Date();
        $date = $date::now();
        $group_id = DB::table('groups')->where('name', '=', 'Bài viết')->first();
        DB::table('permissions')->insert([
            'name' => 'add_post',
            'display_name' => 'Thêm mới bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_post',
            'display_name' => 'Chỉnh sửa bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);


        DB::table('permissions')->insert([
            'name' => 'delete_post',
            'display_name' => 'Xoá bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Trang')->first();
        DB::table('permissions')->insert([
            'name' => 'add_page',
            'display_name' => 'Thêm trang',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Trang')->first();
        DB::table('permissions')->insert([
            'name' => 'edit_page',
            'display_name' => 'Chỉnh sửa trang',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Trang')->first();
        DB::table('permissions')->insert([
            'name' => 'delete_page',
            'display_name' => 'Xoá trang',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Cài đặt')->first();
        DB::table('permissions')->insert([
            'name' => 'permission',
            'display_name' => 'Quản lý truy cập',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('permissions')->insert([
            'name' => 'option_general',
            'display_name' => 'Cài đặt tổng quan',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);


    }
}
