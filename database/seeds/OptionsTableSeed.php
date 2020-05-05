<?php

use Illuminate\Database\Seeder;
use App\Option;
class OptionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $option = new Option();
        $option->option_name = 'blogname';
        $option->option_value = 'Công Ty TNHH DỊCH VỤ CÔNG NGHỆ TOÀN NĂNG - CHI NHÁNH CẦN THƠ';
        $option->option_type = 'text';
        $option->option_label = 'Tên website';
        $option->save();

        $option = new Option();
        $option->option_name = 'blogdescription';
        $option->option_value = 'Devloped by Toan Nang Can Tho';
        $option->option_type = 'text';
        $option->option_label = 'Khẩu hiệu';
        $option->save();

        $option = new Option();
        $option->option_name = 'siteurl';
        $option->option_value = 'http://khoahocketoan.local/';
        $option->option_type = 'url';
        $option->option_label = 'Địa chỉ Website (URL)';
        $option->save();

        $option = new Option();
        $option->option_name = 'home';
        $option->option_value = 'http://khoahocketoan.local/';
        $option->option_type = 'url';
        $option->option_label = 'Địa chỉ trang chủ (URL)';
        $option->save();

        $option = new Option();
        $option->option_name = 'new_admin_email';
        $option->option_value = 'tiennguyen0110.tn@gmail.com';
        $option->option_type = 'email';
        $option->option_label = 'Email quản trị';
        $option->save();

    }
}
