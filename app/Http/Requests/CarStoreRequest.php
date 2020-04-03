<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'make_id' => 'required|exists:car_makes,id',
            'model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer|min:1885|max:' . date('Y'),
            'mileage' => 'required|numeric|max:1000000',
            'color' => 'required|in:' . implode(',', getAllColorNames()),
            'price' => 'required|numeric|max:1000000',
        ];
    }
}
