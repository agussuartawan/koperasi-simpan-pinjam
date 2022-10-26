<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawalRequest extends FormRequest
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
            'date' => ['required', 'string', 'max:255'],
            'amount' => ['required'],
            'description' => []
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Klien tidak boleh kosong!',
            'date.required' => 'Tanggal tidak boleh kosong!',
            'amount.required' => 'Jumlah tidak boleh kosong!'
        ];
    }
}
