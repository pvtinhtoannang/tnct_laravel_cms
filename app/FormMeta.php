<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormMeta extends Model
{
    protected $table = 'form_meta';
    protected $fillable = ['name', 'phone', 'email', 'company_name', 'position', 'address', 'course', 'form_id'];

    public function form()
    {
        return $this->belongsTo('App\Form');
    }

    public function addDataForm($name, $email, $phone, $company_name = '', $position = '', $address = '', $course = '', $content = '', $form_id)
    {
        return self::create(['name' => $name, 'email' => $email, 'phone' => $phone, 'company_name' => $company_name, 'position' => $position, 'address' => $address, 'course' => $course, 'content' => $content, 'form_id'=>$form_id]);
    }

}
