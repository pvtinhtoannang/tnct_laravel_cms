<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'password' => 'min:8',
        ];
    }
    public function messages()
    {
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email này đã tồn tại',
            'email.email' => 'Email nhập vào không đúng định dạng',
            'password.min' => 'Mật khẩu quá ngắn',
        ];
        return $messages;
    }
}
