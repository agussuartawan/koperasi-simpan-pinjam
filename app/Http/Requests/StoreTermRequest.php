<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTermRequest extends FormRequest
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
            'term_day' => ['required'],
            'description' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'term_day.required' => 'Lama pinjaman tidak boleh kosong!',
            'description.required' => 'Keterangan tidak boleh kosong!',
        ];
    }
}
