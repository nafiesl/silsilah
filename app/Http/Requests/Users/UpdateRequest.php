<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(
            'edit', $this->route('user')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname'  => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'gender_id' => 'required|numeric',
            'dob'       => 'nullable|date|date_format:Y-m-d',
            'dod'       => 'nullable|date|date_format:Y-m-d',
            'yod'       => 'nullable|date_format:Y',
            'phone'     => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
            'email'     => 'nullable|string|max:255',
            'password'  => 'nullable|min:6|max:15',
        ];
    }
}
