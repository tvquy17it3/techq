<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:5|max:250',
            'body' => 'required|min:5|max:20000',
            'category_id'=>'required',
            'thumbnail'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống!',
            'body.required' => 'Nội dung không được để trống!',
            'category_id.required' => 'Danh mục không được để trống!',
            'thumbnail.required' => 'Ảnh thumbnail không được để trống!'
        ];
    }
}