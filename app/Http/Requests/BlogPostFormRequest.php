<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostFormRequest extends FormRequest
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
            'title' => 'required|min:10|max:255',
            'slug' => 'max:255',
            'category_id' => 'required|integer|exists:blog_categories,id',
            //'user_id' => 'required|integer|exists:users,id',
            'content_html' => 'string|max:1500',
            'content_raw' => 'string|max:1500',
            'excerpt' => 'string|max:120',
        ];
    }
}
