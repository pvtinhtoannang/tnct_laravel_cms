<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert([
            'name' => 'Chưa được phân loại',
            'slug' => 'khong-phan-loai',
            'term_group' => 0,
        ]);
    }
}
