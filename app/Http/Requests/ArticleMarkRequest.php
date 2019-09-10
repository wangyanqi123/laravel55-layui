<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleMarkRequest extends FormRequest
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
            'title' => 'required|string|max:200|min:2',
            'test-editormd-markdown-doc'   => 'required|string',
        ];
    }
    public function attributes()
    {
        return [
            'title' => '标题',
            'test-editormd-markdown-doc'   => '内容',
        ];
    }

}
