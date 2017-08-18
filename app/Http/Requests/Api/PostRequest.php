<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

    public function getTitle()
    {
        return $this->get('title');
    }

    public function getDescription()
    {
        return $this->get('description');
    }

    public function getImageUrl()
    {
        return $this->get('image');
    }

    public function getUserId()
    {
        return $this->get('userId');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'userId' => 'required|int',
        ];
    }
}
