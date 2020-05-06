<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
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
            'parent' => 0,
            'sort' => 0,
            'positions_menu_id' => 1
        ]);

        DB::table('menus')->insert([
            'label' => 'Trang chủ',
            'link' => '/',
            'parent' => 0,
            'sort' => 0,
            'positions_menu_id' => 2
        ]);
    }
}
