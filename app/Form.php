<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    protected $fillable = ['name'];

    public function formMeta()
    {
        return $this->hasMany('App\FormMeta');
    }

    public function getAllDataForm($id)
    {
        return $this::find($id);
    }
}
