<?php

namespace App\Rules;

use App\Models\Loan;
use Illuminate\Contracts\Validation\Rule;

class ArrearCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $exist = Loan::where('client_id', $value)->where('is_paid', 0)->exists();
        if($exist){
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
        return 'Klien ini masih memiliki tunggakan.';
    }
}