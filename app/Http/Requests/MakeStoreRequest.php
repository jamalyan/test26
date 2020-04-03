<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeStoreRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:64|unique:car_makes,name',
        ];

        if ($this->route('make')) {
            $rules['name'] .= ',' . $this->route('make')->id;
        }

        return $rules;
    }
}
