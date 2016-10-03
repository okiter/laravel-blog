<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PassRequest extends FormRequest
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
        if($this->getMethod()!='POST'){
            return [];
        }

        return [
            "old_password"=>'required',
            "password"=>'required|confirmed',
            "password_confirmation"=>'required',
        ];
    }


    public function messages()
    {
       return [
           'old_password.required'=>'原密码必填!',
           'password.required'=>'密码必填!',
           'password.confirmed'=>'密码和确认密码不一致!',
           'password_confirmation.required'=>'确认密码不能为空!',
       ];
    }
}
