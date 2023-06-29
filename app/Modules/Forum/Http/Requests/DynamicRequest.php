<?php

namespace App\Modules\Forum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DynamicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'dynamic_title'       => 'required|min:2',
                        'dynamic_content'        => 'required|min:3',
                        'topic_id' => 'required|numeric',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
    }

    public function messages()
    {
        return [
            'dynamic_title.min' => '标题必须至少两个字符',
            'dynamic_content.min' => '文章内容必须至少三个字符',
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
