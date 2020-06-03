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
        DB::table('forms')->insert([
            'name' => 'Form đăng ký'
        ]);

        DB::table('forms')->insert([
            'name' => 'Form liên hệ'
        ]);
    }
}
