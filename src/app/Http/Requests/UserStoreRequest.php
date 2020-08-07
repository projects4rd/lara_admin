<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name' => 'bail|required|min:2',
            'last_name'  => 'bail|required|min:2',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|confirmed|min:8',
            'slug'       => 'required|alpha_dash|min:5|max:255|unique:users,slug',
            'roles'      => 'required|min:1',
            'avatar'     => 'sometimes|image',
            'phone'      => 'min:10|max:10',
            'mobile'     => 'min:10|max:10',
            'bio'        => 'min:5'
        ];
    }
}
