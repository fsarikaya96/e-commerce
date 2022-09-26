<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * Failed api custom response
     * @param Validator $validator
     * @return object
     */
    public $validator = null;

    protected function failedValidation(Validator $validator): object
    {
        return $this->validator = $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'             => 'required|string',
            'slug'             => 'nullable|unique:categories,slug',
            'description'      => 'required',
            'image'            => 'nullable|mimes:jpg,jpeg,png',
            'meta_title'       => 'nullable|string',
            'meta_keyword'     => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }
}
