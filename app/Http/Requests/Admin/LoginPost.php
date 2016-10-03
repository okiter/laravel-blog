<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginPost extends FormRequest
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
        //
        if($this->getMethod()!="POST"){
            return [];
        }
        return [
            'username' => 'required',
            'password' => 'required',
            'code' => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            "username.required"=>'用户名必填！',
            "password.required"=>'密码必填！',
            "code.required"=>'验证码必填！',
            "code.captcha"=>'验证码不正确！'
        ];
    }


}
