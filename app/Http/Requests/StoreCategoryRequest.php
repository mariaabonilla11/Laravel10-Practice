<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            #'slug' => Str::slug($this->title)
            'slug' => str($this->title)->slug()
        ]);
    }

    static public function myRules()
    {
        return [
            //
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500|unique:categories",
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->myRules();
    }
}
