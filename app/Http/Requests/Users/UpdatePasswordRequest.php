<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password'  => 'min:6|max:15|current_password',
            'new_password'  => 'min:6|max:15|same_password|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.current_password' => trans('passwords.old_password'),
            'new_password.same_password' => trans('passwords.same_password'),
        ];
    }
}
