<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Group;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    protected $permission, $role, $group, $user;

    public function __construct()
    {
        $this->permission = new Permission();
        $this->role = new Role();
        $this->group = new Group();
        $this->user = new User();
    }

    /**
     * Hàm này kiểm tra xem mỗi user có quyền gì? Nếu chưa có quyền gì thì thêm quyền mới cho user quyền theo role, còn có rồi thì có thể cập nhật quyền mới
     * @param $user_id
     * @return mixed
     */
    public function updatePermissionForUser($user_id, $arr_permission = [])
    {
        $role = $this->user->getUserbyID($user_id)->roles[0]->id;
        $permission_by_user = $this->user->getPermissionByUser($user_id);
        $permission_by_role = $this->role->getRoleByID($role)->permission;
        if (empty($arr_permission)) {
            foreach ($permission_by_role as $key => $value) {
                $arr_permission[$key] = $value->id;
            }
        }

        if (empty($permission_by_user)) {
            return $this->user->addPermissionForUser($user_id, $arr_permission);
        } else {
            return $this->user->updatePermissionForUser($user_id, $arr_permission);
        }
    }


    /*
     * Hàm này dùng lấy ra giao diện và truyền dữ liệu cơ bản vào view quản lý truy cập
     *
     * **/
    public function getPermission()
    {
        $this->user->authorizeRoles('permission');
        $getAllPermissionWithPaginate = $this->permission->getAllPermission();
        $getAllRole = $this->role->getAllRole();
        $getAllGroup = $this->group->getAllGroup();
        $getAllUser = $this->user->getAllUser();

        return view('admin.settings.permissions',
            [
                'getAllPermissionWithPaginate' => $getAllPermissionWithPaginate,
                'getAllRole' => $getAllRole,
                'getAllGroup' => $getAllGroup,
                'getAllUser' => $getAllUser
            ]);
    }

    /*
     * Hàm này gíup thêm 1 quyền mới vào 1 group nào đó
     * Method: POST
     * **/
    public function addPermission(Request $request)
    {
        if (!empty($request->name) && !empty($request->display_name) && !empty($request->group_id)) {
            if ($this->permission->createPermission($request->name, $request->display_name, $request->group_id)) {
                return redirect()->back()->with('messages', 'Thêm quyền mới thành công!');
            }
        } else {
            return redirect()->back()->withInput()->with('messages', 'Thêm quyền mới thất bại');
        }
    }

    /*
     *  Hàm này giúp lấy ra quyền truy cập thông qua ID
     * **/
    public function getPermissionByID($id)
    {
        if (!empty($id)) {
            return $this->permission->getPermissionByID($id);
        } else {
            return false;
        }

    }

    /*
     *  Hàm này giúp cập nhật một quyền nào đó thông qua ID
     * Method: POST
     * **/
    public function updatePermissionByID(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $display_name = $request->display_name;
        $group_id = $request->group_id;
        if (!empty($id) && !empty($name) && !empty($display_name) && !empty($group_id)) {
            if ($this->permission->updatePermissionByID($name, $display_name, $group_id, $id)) {
                return redirect()->back()->with('messages', 'Thêm quyền mới thành công!');
            }
        } else {
            return redirect()->back()->withInput()->with('messages', 'Cập nhật thất bại');
        }
    }

    /*
     * Hàm này cập nhật quyền truy cập cho từng Role
     * đầu vào là role và các quyền
     * **/
    public function updatePermissionForRole(Request $request)
    {
        $permission_id = $request->permission_for_role;
        $role = $request->role;
        if (!empty($permission_id)) {
            $this->role->updatePermissionForRole($role, $permission_id);
        }
        return redirect()->route('GET_PERMISSION_SETTINGS');
    }


    /*
     * Function Ajax
     * **/
    public function getPermissionByUser($user_id)
    {
        return $this->user->getPermissionByUser($user_id);
    }

    /*
     * Function Ajax
     * **/
    public function getPermissionByRole($role_id)
    {
        return $this->role->getPermissionByRole($role_id);
    }

    public function updatePermissionForUserByIDUser(Request $request)
    {
        $user_id = $request->user;
        $admin_add_user_permission = $request->admin_add_user_permission;
        if ($this->updatePermissionForUser($user_id, $admin_add_user_permission)) {
            return redirect()->back()->with('messages', 'Thêm quyền mới cho người dùng!');
        } else {
            return redirect()->back()->withInput()->with('messages', 'Cập nhật thất bại');
        }
    }

    public function addNewGroup(Request $request)
    {
        if (!empty($request->name)) {
            if ($this->group->addNewGroup($request->name)) {
                return redirect()->back()->with('messages', 'Thêm nhóm mới thành công!');
            } else {
                return redirect()->back()->with('messages', 'Thêm nhóm mới thất bại!');
            }
        } else {
            return redirect()->back()->with('messages', 'Thêm nhóm mới thất bại!');
        }
    }

}
