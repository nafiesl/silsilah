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
            'nickname'    => 'sometimes|required|string|max:255',
            'name'        => 'sometimes|required|string|max:255',
            'gender_id'   => 'sometimes|required|numeric',
            'dob'         => 'nullable|date|date_format:Y-m-d',
            'yob'         => 'nullable|date_format:Y',
            'dod'         => 'nullable|date|date_format:Y-m-d',
            'yod'         => 'nullable|date_format:Y',
            'phone'       => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'email'       => 'nullable|string|max:255',
            'password'    => 'nullable|min:6|max:15',
            'birth_order' => 'nullable|numeric|min:1',

            'cemetery_location_name'      => 'nullable|string|max:255',
            'cemetery_location_address'   => 'nullable|string|max:255',
            'cemetery_location_latitude'  => 'required_with:cemetery_location_longitude|nullable|string|max:255',
            'cemetery_location_longitude' => 'required_with:cemetery_location_latitude|nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'password.current_password'  => trans('passwords.old_password'),
            'new_password.same_password' => trans('passwords.same_password'),
        ];
    }

    public function validated()
    {
        $formData = parent::validated();

        $formData['yod'] = $this->getYod($formData);
        $formData['yob'] = $this->getYob($formData);

        if (isset($formData['password']) && $formData['password']) {
            $formData['password'] = bcrypt($formData['password']);
        } else {
            unset($formData['password']);
        }

        return $formData;
    }

    private function getYob($formData)
    {
        if (isset($formData['yob'])) {
            return $formData['yob'];
        }

        if (isset($formData['dob']) && $formData['dob']) {
            return substr($formData['dob'], 0, 4);
        }

        return;
    }

    private function getYod($formData)
    {
        if (isset($formData['yod'])) {
            return $formData['yod'];
        }

        if (isset($formData['dod']) && $formData['dod']) {
            return substr($formData['dod'], 0, 4);
        }

        return;
    }
}
