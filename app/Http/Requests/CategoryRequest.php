<?php

namespace App\Http\Requests;

use App\Models\Category;
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // return route(attribute) from request
        $id = $this->route('category');
        return Category::rules($id);
    }

    public function messages(){
        return [
            'required' => 'The :attribute field is required',
            'name.unique' => 'The :attribute field exists',
        ];
    }
}
