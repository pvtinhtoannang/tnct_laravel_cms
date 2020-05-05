<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Permission extends Model
{

    protected $fillable = ['name', 'display_name', 'group_id'];

    /**
     * Relationship to Role Table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_permission', 'permission_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'permission_user', 'user_id', 'permission_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissionWithPaginate($paginate = 15)
    {
        return self::paginate($paginate);
    }

    /**
     * @return mixed
     */
    public function getAllPermission()
    {
        return self::get();
    }

    public function createPermission($name, $display_name, $group_id)
    {
        return $this->create(['name' => $name, 'display_name' => $display_name, 'group_id' => $group_id]);
    }

    public function getPermissionByID($id)
    {
        return self::find($id);
    }

    public function updatePermissionByID($request_name, $request_display_name, $request_group_id, $id)
    {
        return self::find($id)->update(['name' => $request_name, 'display_name' => $request_display_name, 'group_id' => $request_group_id]);
    }


}
