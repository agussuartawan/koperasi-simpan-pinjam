<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'code' => ['required', 'max:20', 'unique:payments,code'],
            'client_id' => ['required'],
            'loan_id' => ['required'],
            'date' => [
                'required',
                'date'
            ],
            'mulct' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode tidak boleh kosong!',
            'code.max' => 'Kode tidak boleh lebih dari 20 karakter!',
            'code.unique' => 'Kode sudah digunakan!',
            'client_id.required' => 'Klien tidak boleh kosong!',
            'loan_id.required' => 'Mohon pilih hutang klien!',
            'date.required' => 'Tanggal tidak boleh kosong!',
            'date.date' => 'Format tanggal tidak sesuai!',
            'mulct.required' => 'Denda tidak boleh kosong!',
        ];
    }
}
