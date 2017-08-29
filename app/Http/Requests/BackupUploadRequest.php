<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackupUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'backup_file' => 'required|sql_gz',
        ];
    }

    public function messages()
    {
        return [
            'backup_file.sql_gz' => 'Invalid file type, must be <strong>.gz</strong> file',
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->addImplicitExtension('sql_gz', function ($attribute, $value, $parameters) {
            if ($value) {
                return $value->getClientOriginalExtension() == 'gz';
            }

            return false;
        });

        return $validator;
    }
}
