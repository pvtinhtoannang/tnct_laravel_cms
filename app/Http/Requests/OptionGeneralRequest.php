<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionGeneralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'option_name' => 'required|unique:options',
            'option_value' => 'required',
            'option_type' => 'required',
            'option_label' => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'option_name.required' => 'Slug không được để trống',
            'option_name.unique' => 'Slug này đã tồn tại',
            'option_value.required' => 'Giá trị không được để trống',
            'option_label.required' => 'Tiêu đề không được để trống',
        ];
        return $messages;
    }
}
