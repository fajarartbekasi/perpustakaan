<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nis'           => 'required',
            'name'          => 'required',
            'email'         => 'required',
            'no_handphone'  => 'required',
            'alamat'        => 'required',
            'password'      => 'required',
        ];
    }
    public function formAnggota()
    {
        return [
            'nis'           => $this->nis,
            'name'          => $this->name,
            'email'         => $this->email,
            'no_handphone'  => $this->no_handphone,
            'alamat'        => $this->alamat,
        ];
    }
}
