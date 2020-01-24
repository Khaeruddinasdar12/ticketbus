<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'alamat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name field tidak boleh kosong',
            'username.required' => 'username field tidak boleh kosong',
            'password.required' => 'password field tidak boleh kosong',
            'email.required' => 'email field tidak boleh kosong',
            'role.required' => 'role field tidak boleh kosong',
            'alamat.required' => 'alamat field tidak boleh kosong',
            'username.unique' => 'username sudah ada',
            'email.email' => 'email field harus format email',
            'alamat.unique' => 'email sudah ada'
        ];
    }
}
