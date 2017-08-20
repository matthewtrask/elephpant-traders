<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
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

    public function getElephpant()
    {
        return $this->get('elephpant');
    }

    public function getDesireLevel()
    {
        return $this->get('desireLevel');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'elephpant' => 'required|string',
            'desireLevel' => 'required|int',
        ];
    }
}
