<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     *
     * @param Validator $validator
     *
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
        $slug = $this->request->get("slug");

        $rules = [
            'name'             => 'required|string',
//            'slug'             => ['nullable', Rule::unique('categories')->ignore($slug, 'slug')],
            'slug'             => 'nullable|unique:categories,slug,'.$this->id,
            'description'      => 'required',
            'image'            => 'nullable|mimes:jpeg,png,jpg',
            'meta_title'       => 'nullable|string',
            'meta_keyword'     => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['slug'] = ['required','unique:categories,slug,'.$this->id];
        }
        return $rules;
    }
}
