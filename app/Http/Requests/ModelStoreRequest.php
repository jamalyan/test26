<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelStoreRequest extends FormRequest
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
        $id = $this->route('model') ? $this->route('model')->id : 'NULL';

        $rules = [
            'name' => 'required|string|max:64|unique:car_models,name,' . $id . ',id,make_id,' . $this->request->get('make_id'),
            'make_id' => 'required|exists:car_makes,id',
        ];

        return $rules;
    }
}
