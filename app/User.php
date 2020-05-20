<?php

namespace App;

use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $role;

    public function __construct(array $attributes = [])
    {
        $this->role = new Role();
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider_name', 'provider_id', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $table = 'users';

    /**
     * Relationship to Role Table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_user', 'user_id', 'permission_id');
    }

    public function postsCourses()
    {
        return $this->belongsToMany('App\Post', 'permission_post', 'user_id', 'post_id')->withPivot('date_expires');
    }


    public function authorizeRoles($permission_name)
    {

        $roles_name = [];
        $roles = $this->getNameRole();
        if (!empty($roles)) {
            foreach ($roles as $key => $role) {
                $roles_name[$key] = $role['name'];
            }
        }
        return $this->checkPermission($permission_name) || abort(401, 'Bạn không có quyền truy cập hành động này!');

    }

    /**
     * Check multiple roles
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('roles.name', $roles)->first();
    }

    /**
     * Check one role
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function checkPermission($permission)
    {
        $permissions = self::find(Auth::user()->id)->permissions()->where('permissions.name', $permission)->first();
        if (empty($permissions)) {
            $role_user = $this->getNameRole();
            $role_id = $role_user[0]->id;
            $role = $this->role->where('id', $role_id)->first();
            $permission_arr = $role->permission;
            foreach ($permission_arr as $key => $value) {
                if ($value['name'] == $permission) {
                    $permissions[$key] = $value['name'];
                } else {
                    $permissions = null;
                }
            }
        }
        return $permissions;
    }

    /*
     * Đăng ký post cho user
     * **/
    public function registerPostForUser($user_id, $post_id)
    {
        $date_expires_data = Option::where('option_name', 'date_expires')->first();
        if (!empty($date_expires_data)) {
            $date_expires = strtotime(Carbon::now()->addDays((int)$date_expires_data->option_value));
        } else {
            $date_expires = strtotime(Carbon::now()->addDays(30));
        }
        return $this->find($user_id)->postsCourses()->attach($post_id, ['date_expires' => $date_expires]);
    }


    /*
     * kiểm tra truy cập của post cho user
     * **/

    public function checkPostForUser($user_id, $post_id)
    {
        $dateNow = strtotime(Date::now());
        $postCourses = $this->find($user_id)->postsCourses()->where('post_id', $post_id)->first();
        if ($postCourses !== null) {
            if ($dateNow > $postCourses->pivot->date_expires) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }


    /**
     * @param $user_id
     * @param $post_id
     * cách dùng
     * $this->user->checkPermissionForPost(Auth::user()->id, 2);
     */
    public function checkPermissionForPost($user_id, $post_id)
    {
        $permissions = self::find(Auth::user()->id)->postsCourses()->get();
        $date_now = strtotime(Carbon::now());
        foreach ($permissions as $permission) {
            if ($permission->ID !== $post_id) {
                abort(401, 'Bạn không có quyền truy cập hành động này!');
            }
            if ((int)$permission->pivot->date_expires < (int)$date_now) {
                abort(401, 'Quyền truy cập hành động này đã hết hạn!');
            } else {
                abort(401, 'Bạn không có quyền truy cập hành động này!');
            }
        }


    }

    public function getNameRole()
    {
        return self::find(Auth::user()->id)->roles()->get();
    }

    public function getPermission()
    {
        return self::find(Auth::user()->id)->permissions()->get();
    }


    /**
     * @param $newPassword
     * @param int $user
     * @param string $email
     * @return bool|\Exception
     */
    public function updatePassword($newPassword, $user = 0, $email = '')
    {
        try {
            if (!empty($newPassword)) {
                if (!empty($email) || !User::where('email', $email)->exists()) {
                    return User::where('email', $email)->update(['password' => Hash::make($newPassword)]);
                } elseif ($user != 0) {
                    return User::find($user)->update(['password' => Hash::make($newPassword)]);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param $email
     * @param $newEmail
     * @return bool
     */
    public function changeEmail($email, $newEmail)
    {
        if (!empty($email) || !User::where('email', $email)->exists()) {
            $user = self::where('email', $email)->update('email', $newEmail);
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmailExists($email)
    {
        if (User::where('email', $email)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateInformation($name, $email, $id)
    {
        return self::find($id)->update(['name' => $name, 'email' => $email]);
    }

    public function getAllUser()
    {
        return self::orderBy('name', 'ASC')->get();
    }

    public function getPermissionByUser($user_id)
    {
        return self::find($user_id)->permissions()->get();
    }

    public function updatePermissionForUser($id, $permission = [])
    {
        return self::find($id)->permissions()->sync($permission);
    }

    public function addPermissionForUser($id, $idPermission = [])
    {
        return self::find($id)->permissions()->sync($idPermission);
    }

    public function getUserbyID($id)
    {
        return self::find($id);
    }

    public function addNewUser($name, $email, $password, $role_id)
    {
        $user = self::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $user->roles()->sync($role_id);
    }

    /**
     * @param $user_id
     * @param array $role_id
     * @return mixed
     */
    public function updateRoleByUserID($user_id, $role_id = [])
    {
        return self::find($user_id)->roles()->sync($role_id);
    }

    public static function registerUser($name, $email, $password)
    {
        $user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $subscriber = Role::find(5);
        $user->roles()->attach($subscriber);
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return true;
        } else {
            return false;
        }
    }
}
