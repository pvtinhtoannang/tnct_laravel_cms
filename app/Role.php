<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'description'];

    /**
     * Relattionship to User table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Permission', 'role_permission', 'role_id', 'permission_id');
    }

    public function getAllRole()
    {
        return self::get();
    }

    public function getRoleByID($id)
    {
        return self::find($id);
    }

    public function updatePermissionForRole($idRole, $idPermission = [])
    {
        return self::find($idRole)->permission()->sync($idPermission);
    }


    public function getPermissionByRole($id)
    {
        return self::find($id)->permission;
    }

}
