<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'client_id' => ['required'],
            'term_id' => ['required'],
            'date' => ['required', 'date'],
            'amount' => ['required'],
            'bank_interest' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Klien tidak boleh kosong!',
            'date.required' => 'Tanggal tidak boleh kosong!',
            'date.date' => 'Format tanggal tidak sesuai!',
            'amount.required' => 'Jumlah pinjaman tidak boleh kosong!',
            'bank_interest.required' => 'Bunga tidak boleh kosong!'
        ];
    }
}
