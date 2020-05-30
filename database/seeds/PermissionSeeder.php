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
        DB::table('permissions')->insert([
            'name' => 'add_category_post',
            'display_name' => 'Thêm chuyên mục bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_category_post',
            'display_name' => 'Sửa chuyên mục bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_category_post',
            'display_name' => 'Xoá chuyên mục bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'add_tag_post',
            'display_name' => 'Thêm thẻ bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_tag_post',
            'display_name' => 'Sửa thẻ bài viết',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_tag_post',
            'display_name' => 'Xoá thẻ bài viết',
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


        $group_id = DB::table('groups')->where('name', '=', 'Khoá học')->first();
        DB::table('permissions')->insert([
            'name' => 'add_course',
            'display_name' => 'Thêm khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_course',
            'display_name' => 'Sửa khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_course',
            'display_name' => 'Xoá khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'add_course_cat',
            'display_name' => 'Thêm chuyên mục khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_course_cat',
            'display_name' => 'Chỉnh sửa chuyên mục khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_course_cat',
            'display_name' => 'Xoá chuyên mục khoá học',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Đơn hàng')->first();
        DB::table('permissions')->insert([
            'name' => 'view_orders',
            'display_name' => 'Xem đơn hàng',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'update_orders',
            'display_name' => 'Cập nhật đơn hàng',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Menu')->first();
        DB::table('permissions')->insert([
            'name' => 'view_menu',
            'display_name' => 'Xem menu',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'add_menu',
            'display_name' => 'Thêm menu',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'update_menu',
            'display_name' => 'Sửa menu',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_menu',
            'display_name' => 'Xoá menu',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $group_id = DB::table('groups')->where('name', '=', 'Slider')->first();
        DB::table('permissions')->insert([
            'name' => 'view_slider',
            'display_name' => 'Xem slider',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'add_slider',
            'display_name' => 'Thêm slider',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'update_slider',
            'display_name' => 'Sửa slider',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete_slider',
            'display_name' => 'Xoá slider',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        $group_id = DB::table('groups')->where('name', '=', 'Form Liên hệ')->first();

        DB::table('permissions')->insert([
            'name' => 'view_form',
            'display_name' => 'Xem liên hệ',
            'group_id' => $group_id->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
