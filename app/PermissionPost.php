<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionPost extends Model
{
    protected $fillable = ['post_id', 'user_id', 'date_expires', 'activity'];
    protected $table = 'permission_post';

    public function getPermissionPostActivity($user_id, $post_id){
        return self::where('user_id', $user_id)->where('post_id', $post_id)->first()->activity;
    }
}
