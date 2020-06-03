<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'Bài viết',
        ]);
        DB::table('groups')->insert([
            'name' => 'Trang',
        ]);

        DB::table('groups')->insert([
            'name' => 'Thư viện',
        ]);

        DB::table('groups')->insert([
            'name' => 'Khoá học',
        ]);

        DB::table('groups')->insert([
            'name' => 'Cài đặt',
        ]);

        DB::table('groups')->insert([
            'name' => 'Đơn hàng',
        ]);

        DB::table('groups')->insert([
            'name' => 'Menu',
        ]);
        DB::table('groups')->insert([
            'name' => 'Slider',
        ]);
        DB::table('groups')->insert([
            'name' => 'Form Liên hệ',
        ]);
    }
}
