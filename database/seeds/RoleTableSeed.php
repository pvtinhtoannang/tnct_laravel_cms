<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [1, 2, 3, 4, 5, 6, 7, 8];

        $role_employee = new Role();
        $role_employee->name = 'administrator';
        $role_employee->description = 'Administrator';
        $role_employee->save();
        $role_employee->permission()->attach($permission);

        $role_employee = new Role();
        $role_employee->name = 'editor';
        $role_employee->description = 'Editor';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'author';
        $role_manager->description = 'Author';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'contributor';
        $role_manager->description = 'Contributor';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'subscriber';
        $role_manager->description = 'Subscriber';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'customer';
        $role_manager->description = 'Customer';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'shop_manager';
        $role_manager->description = 'Shop Manager';
        $role_manager->save();

        $role_manager = new Role();
        $role_manager->name = 'seo_manager';
        $role_manager->description = 'SEO Manager';
        $role_manager->save();


        $role_manager = new Role();
        $role_manager->name = 'seo_editor';
        $role_manager->description = 'SEO Editor';
        $role_manager->save();

    }
}
