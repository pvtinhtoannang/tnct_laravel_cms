<?php

use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'label' => 'Trang chủ',
            'link' => '/',
            'parent_id' => null,
            'sort' => 0,
            'positions_menu_id' => 1
        ]);
    }
}
