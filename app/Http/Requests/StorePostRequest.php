<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|min:5|unique:posts',
            'body' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống!',
            'body.required' => 'Nội dung không được để trống!',
            'title.unique'=> 'Slug đã tồn tại, Vui lòng nhập tiêu đề khác!',
        ];
    }
}
