<?php

namespace App\Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment_id' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'comment_id.required' => '请指定评论！',
            'comment_id.gt' => '请指定有效的评论！',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
