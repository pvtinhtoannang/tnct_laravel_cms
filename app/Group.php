<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];
    protected $table = 'groups';

    public function permission()
    {
        return $this->hasMany('App\Permission');
    }

    public function getAllGroup()
    {
        return $this->get();
    }

    public function addNewGroup($name)
    {
        return self::create(['name'=>$name]);
    }
}
