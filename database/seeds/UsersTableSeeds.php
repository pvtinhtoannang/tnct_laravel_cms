<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class UsersTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = [1, 2, 3, 4, 5, 6, 7, 8];
        $user = new User();
        $user->name = 'Văn Tính';
        $user->email = 'pvtinh.toannang@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();
        $administrator = Role::find(1);
        $user->roles()->attach($administrator);
        $user->permissions()->attach($permission);

        $user = new User();
        $user->name = 'Minh Nhựt';
        $user->email = 'minhnhut.toannang@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();
        $administrator = Role::find(1);
        $user->roles()->attach($administrator);
        $user->permissions()->attach($permission);
    }
}
