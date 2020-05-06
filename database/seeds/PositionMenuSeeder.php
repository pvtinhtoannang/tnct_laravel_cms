<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PositionMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions_menu')->insert([
            'name' => 'primary_menu',
            'display_name' => 'Menu chính',
        ]);

        DB::table('positions_menu')->insert([
            'name' => 'footer_menu',
            'display_name' => 'Menu footer',
        ]);

    }
}
