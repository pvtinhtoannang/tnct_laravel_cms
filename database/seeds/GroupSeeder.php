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
    }
}
