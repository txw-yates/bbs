<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'title' => 'required|min:2',
                    'body'  => 'required|min:3',
                    'category_id' => 'required|numeric'
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [

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
            'title' => '标题至少两个字符',
            'body' => '内容至少3个字符'
        ];
    }
}
