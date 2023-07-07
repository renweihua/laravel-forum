<?php

namespace App\Modules\Topic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicIdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'topic_id.required' => '请指定话题',
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
