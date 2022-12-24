<?php

namespace App\Http\Requests;

use App\Rules\ArrearCheck;
use App\Rules\MaxAmountCheck;
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
            'client_id' => ['required', new ArrearCheck()],
            'term_id' => ['required'],
            'amount' => ['required', new MaxAmountCheck()],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Klien tidak boleh kosong!',
            'amount.required' => 'Jumlah pinjaman tidak boleh kosong!',
        ];
    }
}