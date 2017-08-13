<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

    public function getName()
    {
        return $this->get('name');
    }

    public function getEmail()
    {
        return $this->get('email');
    }

    public function getTwitter()
    {
        return $this->get('twitter');
    }

    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|unique:users',
            'name' => 'required|string',
            'twitter' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
