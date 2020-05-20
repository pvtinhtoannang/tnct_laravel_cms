<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormMeta;
use Illuminate\Http\Request;

class FormController extends Controller
{
    private $form, $form_meta;

    public function __construct()
    {
        $this->form = new Form();
        $this->form_meta = new FormMeta();
    }

    public function getFormData($id)
    {
        $data = $this->form->getAllDataForm($id);
        return view('admin.forms.form', ['data' => $data]);
    }

    public function addDataForm(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $company_name = $request->company_name;
        $position = $request->position;
        $address = $request->address;
        $course = $request->course;
        $content = $request->content_form;
        if ($this->form_meta->addDataForm($name, $email, $phone, $company_name, $position, $address, $course, $content, $id)) {
            return true;
        } else {
            return false;
        }
    }
}
