<?php

namespace App\Rules;

use App\Models\Loan;
use Illuminate\Contracts\Validation\Rule;

class GreatherThanZeroCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $amount = (float)preg_replace('/[Rp. ]/', '', $value);
        if($amount < Loan::MIN_AMOUNT){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jumlah pinjaman tidak boleh kurang dari <strong>'. idr(Loan::MIN_AMOUNT) .'</strong>.';
    }
}