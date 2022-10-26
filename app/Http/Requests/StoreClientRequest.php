<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'nik' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'client_type_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.max' => 'NIK tidak boleh melebihi 255 digit!',
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama tidak boleh melebihi 255 huruf!',
            'phone.required' => 'No telp tidak boleh kosong!',
            'gender.required' => 'Jenis kelamin tidak boleh kosong!',
            'address.required' => 'Alamat masuk tidak boleh kosong!',
            'client_type_id.required' => 'Tipe tidak boleh kosong!'
        ];
    }
}
